<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRequest;
use App\Models\Tour;
use App\Models\PendingBooking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
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

    public function store(Tour $tour)
    {
        $user = Auth::user();
        $bookingData = session('booking');
        
        Log::info('Booking Data:', ['data' => $bookingData]);
        
        if (!$bookingData) {
            return redirect()->route('frontend.tours.show', $tour);
        }

        try {
            DB::beginTransaction();
            
            // Tạo booking với dữ liệu chi tiết
            $booking = new Booking([
                'user_id' => $user->id,
                'tour_id' => $tour->id,
                'booking_date' => $bookingData['booking_date'],
                'adults' => $bookingData['adults'],
                'children' => $bookingData['children'],
                'notes' => $bookingData['notes'] ?? null,
                'total_price' => $bookingData['total_amount'],
                'total_amount' => $bookingData['total_amount'],
                'status' => 'pending',
                'payment_status' => 'unpaid'
            ]);

            $booking->save();

            DB::commit();

            // Gửi email xác nhận
            try {
                Mail::to($user->email)->send(new BookingConfirmation($booking));
            } catch (\Exception $e) {
                Log::error('Email Error: ' . $e->getMessage());
            }

            session()->forget('booking');

            return redirect()->route('frontend.bookings.payment', $booking);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking Error: ' . $e->getMessage());
            
            return back()->with('error', 'Có lỗi xảy ra khi đặt tour: ' . $e->getMessage());
        }
    }

    public function payment(Booking $booking)
    {
        $user = Auth::user();
        if ($booking->user_id !== $user->id) {
            abort(403);
        }

        return view('frontend.bookings.payment', compact('booking'));
    }

    public function processPayment(Booking $booking, Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'payment_method' => 'required|in:cash,transfer,card'
            ]);

            // Kiểm tra quyền truy cập
            if ($booking->user_id !== auth()->id()) {
                throw new \Exception('Unauthorized access');
            }

            // Kiểm tra trạng thái booking
            if ($booking->payment_status === 'paid') {
                throw new \Exception('Booking already paid');
            }

            DB::beginTransaction();

            // Cập nhật booking
            $booking->update([
                'payment_status' => 'paid',
                'status' => 'confirmed',
                'payment_method' => $request->payment_method,
                'transaction_id' => 'TXN_' . uniqid()
            ]);

            DB::commit();

            // Gửi email xác nhận
            try {
                Mail::to($booking->user->email)->send(new PaymentConfirmation($booking));
            } catch (\Exception $e) {
                Log::error('Payment Confirmation Email Error: ' . $e->getMessage());
                // Không throw exception vì email không quan trọng bằng việc thanh toán
            }

            return redirect()->route('frontend.bookings.success', $booking)
                ->with('success', 'Thanh toán thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Processing Error: ' . $e->getMessage());
            Log::error('Payment Processing Stack: ' . $e->getTraceAsString());
            
            return back()->with('error', 'Có lỗi xảy ra khi xử lý thanh toán: ' . $e->getMessage());
        }
    }

    public function success(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('frontend.bookings.success', compact('booking'));
    }

    public function review(Tour $tour)
    {
        $bookingData = session('booking');
        
        if (!$bookingData) {
            return redirect()->route('frontend.tours.show', $tour);
        }

        return view('frontend.bookings.review', compact('tour', 'bookingData'));
    }

    public function confirm(PendingBooking $pendingBooking)
    {
        return redirect()->route('frontend.bookings.payment', $pendingBooking);
    }

    public function history()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->latest()->paginate(10);
        return view('frontend.bookings.history', compact('bookings'));
    }
} 