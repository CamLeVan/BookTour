<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;

class BookingController extends Controller
{
    public function history()
    {
        $user = Auth::user();
        dd($user);

        $bookings = $user->bookings()->with(['tour', 'payment'])->latest()->get();
        return view('frontend.booking.history', compact('bookings'));
    }
} 