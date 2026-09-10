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



class TourController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['booking', 'vnPayReturn']);
    }

    public function index(Request $request)
    {
        $query = Tour::with(['destination', 'reviews'])
            ->where('status', 'active');
        
        // Filter by destination
        if ($request->destination) {
            $query->where('destination_id', $request->destination);
        }

        // Filter by duration
        if ($request->duration) {
            [$min, $max] = explode('-', $request->duration);
            if ($max == '+') {
                $query->where('duration', '>=', $min);
            } else {
                $query->whereBetween('duration', [$min, $max]);
            }
        }

        // Filter by price
        if ($request->price) {
            [$min, $max] = explode('-', $request->price);
            if ($max == '+') {
                $query->where('price', '>=', $min);
            } else {
                $query->whereBetween('price', [$min, $max]);
            }
        }

        $tours = $query->paginate(9);
        
        // Thêm testimonials
        $testimonials = Review::with(['user', 'tour'])
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.tours.index', [
            'tours' => $tours,
            'destinations' => Destination::all(),
            'testimonials' => $testimonials
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
        $user = Auth::user();
        
        // Validate form
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => 'required|date|after:today',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'notes' => 'nullable|string'
        ]);

        // Lấy thông tin tour
        $tour = Tour::findOrFail($request->tour_id);

        // Tính tổng tiền
        $total_price = ($request->adults * $tour->price) + 
                       ($request->children * $tour->price * 0.5);

        // Tạo booking
        $booking = Booking::create([
            'user_id' => $user->id,
            'tour_id' => $tour->id,
            'booking_date' => $request->booking_date,
            'adults' => $request->adults,
            'children' => $request->children,
            'total_price' => $total_price,
            'notes' => $request->notes,
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ]);

        // Chuyển đến trang thanh toán VNPay
        return $this->processVnPayPayment($booking);
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
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }
        return view('frontend.bookings.success', compact('booking'));
    }

    public function failed()
    {
        return view('frontend.bookings.failed');
    }
}
