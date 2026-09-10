<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRequest;
use App\Models\Tour;
use App\Models\PendingBooking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->middleware('auth');
        $this->bookingService = $bookingService;
    }

    /**
     * Hiển thị form đặt tour
     */
    public function create(Tour $tour)
    {
        return view('frontend.bookings.create', compact('tour'));
    }

    /**
     * Xử lý form đặt tour và chuyển đến trang xem lại
     */
    public function store(CreateBookingRequest $request, Tour $tour)
    {
        try {
            $pendingBooking = $this->bookingService->createPendingBooking(
                array_merge($request->validated(), ['tour_id' => $tour->id])
            );

            return redirect()->route('frontend.bookings.review', $pendingBooking)
                           ->with('success', 'Vui lòng xem lại thông tin đặt tour của bạn.');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    /**
     * Hiển thị trang xem lại thông tin booking
     */
    public function review(PendingBooking $pendingBooking)
    {
        if ($pendingBooking->isExpired()) {
            return redirect()->route('frontend.tours.show', $pendingBooking->tour)
                           ->with('error', 'Phiên đặt tour đã hết hạn.');
        }

        return view('frontend.bookings.review', compact('pendingBooking'));
    }

    /**
     * Xác nhận và chuyển đến trang thanh toán
     */
    public function confirm(PendingBooking $pendingBooking)
    {
        if (!$pendingBooking->isPending()) {
            return redirect()->route('frontend.tours.show', $pendingBooking->tour)
                           ->with('error', 'Booking này không thể thanh toán.');
        }

        try {
            $qrCode = $this->bookingService->generatePaymentQR($pendingBooking);
            
            return view('frontend.bookings.payment', [
                'pendingBooking' => $pendingBooking,
                'qrCode' => $qrCode
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể tạo mã QR, vui lòng thử lại.');
        }
    }

    /**
     * Hiển thị trang thành công
     */
    public function success(PendingBooking $pendingBooking)
    {
        if (!$pendingBooking->isCompleted()) {
            return redirect()->route('frontend.tours.show', $pendingBooking->tour);
        }

        return view('frontend.bookings.success', compact('pendingBooking'));
    }
} 