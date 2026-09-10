<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;  // Thêm dòng này
use App\Models\User;  
class BookingController extends Controller
{
    //
    public function history()
{
    $bookings = Auth::user()->bookings()->with(['tour', 'payment'])->latest()->get();
    return view('frontend.booking.history', compact('bookings'));
}
}
