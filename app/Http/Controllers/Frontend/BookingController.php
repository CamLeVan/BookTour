<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRequest;
use App\Models\Tour;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\PaymentConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
        $this->middleware('auth');
    }

    public function create(Tour $tour)
    {
        return view('frontend.bookings.create', compact('tour'));
    }

    public function review(Tour $tour, Request $request)
    {
        $bookingData = session('booking');
        
        if (!$bookingData) {
            return redirect()->route('frontend.tours.show', $tour);
        }

        // Handle payment option (full vs deposit 30%)
        if ($request->has('payment_option')) {
            $bookingData['is_deposit'] = ($request->payment_option === 'deposit');
            session(['booking' => $bookingData]);
        }

        return view('frontend.bookings.review', compact('tour', 'bookingData'));
    }

    public function store(Request $request, Tour $tour)
    {
        $user = Auth::user();
        $bookingData = session('booking');
        
        Log::info('Booking Data:', ['data' => $bookingData]);
        
        if (!$bookingData) {
            return redirect()->route('frontend.tours.show', $tour);
        }

        try {
            DB::beginTransaction();
            
            $originalAmount = (float) ($bookingData['original_amount'] ?? $bookingData['total_amount']);
            $discountAmount = (float) ($bookingData['discount_amount'] ?? 0);
            $voucherId = $bookingData['voucher_id'] ?? null;
            $netTotal = max(0, $originalAmount - $discountAmount);

            $isDeposit = !empty($bookingData['is_deposit']);
            if ($isDeposit) {
                $depositAmount = round($netTotal * 0.30);
                $remainingAmount = max(0, $netTotal - $depositAmount);
                $totalAmount = $depositAmount;
            } else {
                $depositAmount = 0;
                $remainingAmount = 0;
                $totalAmount = $netTotal;
            }

            // Set 15-minute slot reservation expiration (Hold Slot TTL)
            $holdExpiresAt = \Carbon\Carbon::now()->addMinutes(15);

            // Tạo booking với dữ liệu chi tiết
            $booking = new Booking([
                'user_id' => $user->id,
                'tour_id' => $tour->id,
                'booking_date' => $bookingData['booking_date'],
                'adults' => $bookingData['adults'],
                'children' => $bookingData['children'],
                'notes' => $bookingData['notes'] ?? null,
                'total_price' => $originalAmount,
                'total_amount' => $totalAmount,
                'discount_amount' => $discountAmount,
                'voucher_id' => $voucherId,
                'is_deposit' => $isDeposit,
                'deposit_amount' => $depositAmount,
                'remaining_amount' => $remainingAmount,
                'hold_expires_at' => $holdExpiresAt,
                'status' => 'pending',
                'payment_status' => 'unpaid'
            ]);

            $booking->save();

            // Cập nhật số lượt đã dùng của Voucher nếu có
            if ($voucherId) {
                \App\Models\Voucher::where('id', $voucherId)->increment('used_count');
            }

            DB::commit();

            // Gửi email xác nhận
            try {
                Mail::to($user->email)->send(new BookingConfirmation($booking));
            } catch (\Exception $e) {
                Log::error('Booking Confirmation Email Error: ' . $e->getMessage());
            }

            session()->forget('booking');

            return redirect()->route('frontend.bookings.payment', $booking);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking Error: ' . $e->getMessage());
            
            return back()->with('error', 'Có lỗi xảy ra khi đặt tour: ' . $e->getMessage());
        }
    }

    public function applyVoucher(Request $request, Tour $tour)
    {
        $request->validate([
            'voucher_code' => 'required|string'
        ], [
            'voucher_code.required' => 'Vui lòng nhập mã giảm giá.'
        ]);

        $bookingData = session('booking');
        if (!$bookingData) {
            return back()->with('error', 'Phiên đặt tour đã hết hạn.');
        }

        $code = strtoupper(trim($request->voucher_code));
        $voucher = \App\Models\Voucher::where('code', $code)->first();

        if (!$voucher) {
            return back()->with('error', 'Mã giảm giá "' . $code . '" không hợp lệ hoặc không tồn tại.');
        }

        $originalAmount = (float) ($bookingData['original_amount'] ?? $bookingData['total_amount']);
        $validation = $voucher->validateForOrder($originalAmount);

        if (!$validation['valid']) {
            return back()->with('error', $validation['message']);
        }

        $discountAmount = $voucher->calculateDiscount($originalAmount);
        $finalAmount = max(0, $originalAmount - $discountAmount);

        $bookingData['original_amount'] = $originalAmount;
        $bookingData['discount_amount'] = $discountAmount;
        $bookingData['total_amount'] = $finalAmount;
        $bookingData['voucher_id'] = $voucher->id;
        $bookingData['voucher_code'] = $voucher->code;

        session(['booking' => $bookingData]);

        return back()->with('success', 'Áp dụng mã "' . $voucher->code . '" thành công! Bạn được giảm ' . number_format($discountAmount, 0, ',', '.') . 'đ');
    }

    public function removeVoucher(Tour $tour)
    {
        $bookingData = session('booking');
        if ($bookingData) {
            if (isset($bookingData['original_amount'])) {
                $bookingData['total_amount'] = $bookingData['original_amount'];
            }
            unset($bookingData['voucher_id'], $bookingData['voucher_code'], $bookingData['discount_amount']);
            session(['booking' => $bookingData]);
        }

        return back()->with('success', 'Đã hủy áp dụng mã giảm giá.');
    }

    public function payment(Booking $booking)
    {
        $user = Auth::user();
        if ($booking->user_id != $user->id) {
            abort(403);
        }

        return view('frontend.bookings.payment', compact('booking'));
    }

    public function processPayment(Booking $booking, Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'payment_method' => 'required|in:cash,transfer,card,vnpay'
            ]);

            // Kiểm tra quyền truy cập
            if ($booking->user_id != Auth::id()) {
                throw new \Exception('Unauthorized access');
            }

            // Kiểm tra xem đơn có bị hết hạn giữ chỗ không
            if ($booking->isHoldExpired()) {
                $booking->update(['status' => 'expired']);
                return redirect()->route('frontend.tours.show', $booking->tour_id)
                    ->with('error', 'Đơn đặt tour của bạn đã hết hạn 15 phút giữ chỗ. Vui lòng thực hiện đặt lại!');
            }

            // Kiểm tra trạng thái booking
            if ($booking->payment_status === 'paid') {
                throw new \Exception('Booking already paid');
            }

            DB::beginTransaction();

            $paymentStatus = $booking->is_deposit ? 'deposit_paid' : 'paid';

            // Cập nhật booking
            $booking->update([
                'payment_status' => $paymentStatus,
                'status' => 'confirmed',
                'payment_method' => $request->payment_method,
                'transaction_id' => 'TXN_' . strtoupper(uniqid()),
                'paid_at' => \Carbon\Carbon::now()
            ]);

            DB::commit();

            // Gửi email xác nhận
            try {
                Mail::to($booking->user->email)->send(new PaymentConfirmation($booking));
            } catch (\Exception $e) {
                Log::error('Payment Confirmation Email Error: ' . $e->getMessage());
            }

            $message = $booking->is_deposit 
                ? 'Thanh toán đặt cọc 30% (' . number_format($booking->deposit_amount, 0, ',', '.') . 'đ) thành công! Giữ chỗ thành công.'
                : 'Thanh toán 100% thành công!';

            return redirect()->route('frontend.bookings.success', $booking)
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Processing Error: ' . $e->getMessage());
            
            return back()->with('error', 'Có lỗi xảy ra khi xử lý thanh toán: ' . $e->getMessage());
        }
    }

    public function success(Booking $booking)
    {
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }

        return view('frontend.bookings.success', compact('booking'));
    }

    public function confirm(Booking $booking)
    {
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }
        return redirect()->route('frontend.bookings.payment', $booking);
    }

    public function history()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
                        ->latest()
                        ->paginate(10);
        return view('frontend.bookings.history', compact('bookings'));
    }

    /**
     * ⚡ SIMULATION ACTION: Fast-forward 15-minute slot expiration
     */
    public function simulateExpire(Booking $booking)
    {
        if ($booking->user_id != Auth::id() && Auth::user()->role !== 'admin' && Auth::user()->role !== 'spadmin') {
            abort(403);
        }

        $booking->update([
            'hold_expires_at' => \Carbon\Carbon::now()->subMinute(),
            'status' => 'expired'
        ]);

        return back()->with('success', '⚡ Giả lập đơn hàng hết 15 phút giữ chỗ thành công! Trạng thái chuyển sang Hết hạn (EXPIRED) và vị trí tour đã được nhả.');
    }

    /**
     * 💰 SIMULATION ACTION: Pay remaining 70% deposit balance
     */
    public function payRemaining(Booking $booking)
    {
        if ($booking->user_id != Auth::id() && Auth::user()->role !== 'admin' && Auth::user()->role !== 'spadmin') {
            abort(403);
        }

        $remaining = $booking->remaining_amount;
        $booking->update([
            'payment_status' => 'paid',
            'remaining_amount' => 0,
            'total_amount' => $booking->total_amount + $remaining,
            'paid_at' => \Carbon\Carbon::now()
        ]);

        return back()->with('success', '💰 Thanh toán 70% số tiền còn lại (' . number_format($remaining, 0, ',', '.') . 'đ) thành công! Đơn hàng đã hoàn tất 100%.');
    }

    /**
     * 🔄 SIMULATION ACTION: Customer requests cancellation & refund
     */
    public function requestRefund(Request $request, Booking $booking)
    {
        if ($booking->user_id != Auth::id() && Auth::user()->role !== 'admin' && Auth::user()->role !== 'spadmin') {
            abort(403);
        }

        $request->validate([
            'refund_reason' => 'required|string|max:500'
        ], [
            'refund_reason.required' => 'Vui lòng nhập lý do hủy tour / yêu cầu hoàn tiền.'
        ]);

        $refundAmount = $booking->calculateRefundAmount();

        $booking->update([
            'refund_status' => 'requested',
            'refund_amount' => $refundAmount,
            'refund_reason' => $request->refund_reason,
            'status' => 'cancelled'
        ]);

        $days = \Carbon\Carbon::now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($booking->booking_date)->startOfDay(), false);

        return back()->with('success', '🔄 Đã gửi yêu cầu hoàn tiền thành công! Hủy trước ngày đi ' . $days . ' ngày -> Số tiền dự kiến hoàn lại: ' . number_format($refundAmount, 0, ',', '.') . 'đ (' . ($days >= 7 ? '100%' : ($days >= 3 ? '50%' : '0%')) . ')');
    }
}