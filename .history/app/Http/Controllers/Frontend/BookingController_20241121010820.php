<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => 'required|date',
            'number_of_people' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        // Lấy thông tin tour
        $tour = Tour::findOrFail($request->tour_id);
        
        // Tính tổng tiền
        $total_price = $tour->price * $request->number_of_people;

        // Tạo booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'tour_id' => $request->tour_id,
            'booking_date' => $request->booking_date,
            'number_of_people' => $request->number_of_people,
            'total_price' => $total_price,
            'status' => 'pending',
            'notes' => $request->notes
        ]);

        return redirect()
            ->route('frontend.booking.history')
            ->with('success', 'Đặt tour thành công! Chúng tôi sẽ liên hệ với bạn sớm.');
    }

    public function history()
    {
        $bookings = Auth::user()->bookings()
            ->with(['tour', 'payment'])
            ->latest()
            ->get();

        return view('frontend.booking.history', compact('bookings'));
    }
} 