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
        
        if (!$bookingData) {
            return redirect()->route('frontend.tours.show', $tour);
        }

        try {
            DB::beginTransaction();
            
            // Tạo booking
            $booking = $tour->bookings()->create([
                'user_id' => $user->id,
                'booking_date' => $bookingData['booking_date'],
                'adults' => $bookingData['adults'],
                'children' => $bookingData['children'],
                'notes' => $bookingData['notes'],
                'total_amount' => $bookingData['total_amount'],
                'status' => 'pending',
                'payment_status' => 'unpaid'
            ]);

            // Lưu thông tin booking vào session để dùng cho thanh toán
            session(['payment_booking' => $booking->id]);

            DB::commit();

            // Gửi email xác nhận đặt tour
            Mail::to($user->email)->send(new BookingConfirmation($booking));

            // Chuyển đến trang thanh toán giả lập
            return redirect()->route('frontend.bookings.payment', $booking);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi đặt tour. Vui lòng thử lại.');
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
            // Giả lập thanh toán thành công và cập nhật database
            $booking->update([
                'payment_status' => 'paid',  // Đã thanh toán
                'status' => 'confirmed',     // Đã xác nhận
                'payment_method' => $request->payment_method,
                'transaction_id' => 'TXN_' . uniqid()
            ]);

            // Gửi email xác nhận
            Mail::to($booking->user->email)->send(new PaymentConfirmation($booking));

            return redirect()->route('frontend.bookings.success', $booking)
                ->with('success', 'Thanh toán thành công!');

        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi xử lý thanh toán.');
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