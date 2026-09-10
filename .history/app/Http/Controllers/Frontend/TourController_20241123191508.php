<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\BookingCancelled;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class TourController extends Controller
{
    public function __construct()
    {
        // Không cần middleware ở đây nữa vì đã move vào routes
        // $this->middleware('auth')->only(['booking', 'vnPayReturn']);
    }

    public function index(Request $request)
    {
        $query = Tour::with(['destination', 'reviews'])
            ->where('status', 'active');

        // Tìm kiếm linh hoạt theo từ khóa
        if ($request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                // Tìm theo tên tour
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  // Hoặc theo mô tả
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  // Hoặc theo destination name
                  ->orWhereHas('destination', function($q) use ($searchTerm) {
                      $q->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Lọc theo điểm đến
        if ($request->destination) {
            $query->where('destination_id', $request->destination);
        }

        // Lọc theo thời gian linh hoạt hơn
        if ($request->duration) {
            [$min, $max] = explode('-', $request->duration);
            if ($max == '+') {
                $query->where('duration', '>=', $min);
            } else {
                // Cho phép sai số ±1 ngày
                $query->whereBetween('duration', [
                    max(1, intval($min) - 1), 
                    intval($max) + 1
                ]);
            }
        }

        // Sắp xếp kết quả
        $query->orderBy('created_at', 'desc');

        $tours = $query->paginate(9);

        return view('frontend.tours.index', [
            'tours' => $tours,
            'destinations' => Destination::all(),
            'testimonials' => Review::latest()->take(3)->get()
        ]);
    }

    public function show(Tour $tour)
    {
        return view('frontend.tours.show', [
            'tour' => $tour->load(['destination', 'reviews.user', 'schedules']),
            'relatedTours' => Tour::where('destination_id', $tour->destination_id)
                ->where('id', '!=', $tour->id)
                ->active()
                ->take(3)
                ->get()
        ]);
    }

    public function booking(Request $request)
    {
        // Validate form
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => [
                'required',
                'date',
                'after:' . now()->addDays(2)
            ],
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:500'
        ]);

        // Lấy thông tin tour
        $tour = Tour::findOrFail($request->tour_id);

        // Check tour còn active không
        if ($tour->status !== 'active') {
            return back()->with('error', 'Tour này hiện không khả dụng');
        }

        // Tính tổng tiền
        $total_price = ($request->adults * $tour->price) +
            ($request->children * $tour->price * 0.5);

        try {
            // Kiểm tra user đã đăng nhập
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // Tạo booking
            $booking = Booking::create([
                'user_id' => Auth::id(), // Sử dụng Auth::id() thay vì auth()->id()
                'tour_id' => $tour->id,
                'booking_date' => $request->booking_date,
                'adults' => $request->adults,
                'children' => $request->children,
                'total_price' => $total_price,
                'notes' => $request->notes,
                'status' => 'pending',
                'payment_status' => 'unpaid'
            ]);

            // Chuyển đến thanh toán VNPay
            return $this->processVnPayPayment($booking);
        } catch (\Exception $e) {
            Log::error('Booking error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function vnPayReturn(Request $request)
    {
        $booking = Booking::with('user')->find($request->vnp_TxnRef);

        if ($request->vnp_ResponseCode == "00") {
            // Thanh toán thành công
            $booking->update([
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_method' => 'vnpay',
                'payment_id' => $request->vnp_TransactionNo,
                'paid_at' => now()
            ]);

            // Gửi email xác nhận đến email của user
            Mail::to($booking->user->email)->send(new BookingConfirmation($booking));

            return redirect()->route('frontend.bookings.success', $booking->id)
                ->with('success', 'Đặt tour và thanh toán thành công!');
        }

        // Thanh toán thất bại
        $booking->update(['status' => 'cancelled']);

        return redirect()->route('frontend.bookings.failed')
            ->with('error', 'Thanh toán không thành công! Vui lòng thử lại.');
    }

    private function processVnPayPayment(Booking $booking)
    {
        // Tạo URL thanh toán VNPay
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_ReturnUrl = route('frontend.bookings.vnpay.return');
        $vnp_TmnCode = config('services.vnpay.tmn_code');
        $vnp_HashSecret = config('services.vnpay.hash_secret');

        $vnp_TxnRef = $booking->id;
        $vnp_OrderInfo = "Thanh toan tour " . $booking->tour->name;
        $vnp_Amount = $booking->total_price * 100;

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Chuyển hướng đến trang thanh toán VNPay
        return redirect($vnp_Url);
    }

    public function success(Booking $booking)
    {
        // Kiểm tra user đã đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Kiểm tra quyền truy cập booking
        if ($booking->user_id !== Auth::id()) { // Sử dụng Auth::id()
            abort(403, 'Unauthorized access');
        }

        return view('frontend.bookings.success', compact('booking'));
    }

    public function failed()
    {
        return view('frontend.bookings.failed');
    }
}
