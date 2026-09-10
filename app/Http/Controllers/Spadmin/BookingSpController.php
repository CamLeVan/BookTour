<?php

namespace App\Http\Controllers\Spadmin;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Controllers\Controller;

class BookingSpController extends Controller
{
    public function index()
    {
        return view('spadmin.bookings.index');
    }

    public function show(Booking $booking)
    {
        return view('spadmin.bookings.show', compact('booking'));
    }
}
