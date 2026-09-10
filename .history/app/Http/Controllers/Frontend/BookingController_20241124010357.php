<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookingRequest;
use App\Models\Tour;
use App\Models\PendingBooking;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function create(Tour $tour)
    {
        if (!$tour->is_available) {
            return redirect()->route('frontend.tours.show', $tour)
                           ->with('error', 'Tour này hiện không khả dụng.');
        }

        return view('frontend.bookings.create', compact('tour'));
    }

    public function store(CreateBookingRequest $request, Tour $tour)
    {
        try {
            $pendingBooking = $this->bookingService->createPendingBooking($tour, $request->validated());

            return redirect()->route('frontend.bookings.review', $pendingBooking)
                           ->with('success', 'Vui lòng xem lại thông tin đặt tour của bạn.');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function review(PendingBooking $pendingBooking)
    {
        return view('frontend.bookings.review', compact('pendingBooking'));
    }

    public function confirm(PendingBooking $pendingBooking)
    {
        return redirect()->route('frontend.bookings.payment', $pendingBooking);
    }

    public function success(PendingBooking $pendingBooking)
    {
        if (!session()->has('payment_completed')) {
            return redirect()->route('frontend.tours.index');
        }

        return view('frontend.bookings.success', compact('pendingBooking'));
    }
} 