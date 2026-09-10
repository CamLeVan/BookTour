<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use App\Models\Destination;
use App\Models\Review;

class AboutController extends Controller
{
    public function index()
    {
        return view('frontend.about.index', [
            'testimonials' => Review::where('status', 'approved')
                                  ->latest()
                                  ->limit(3)
                                  ->get(),
            'totalBookings' => Booking::count(),
            'totalTours' => Tour::where('status', 'active')->count(),
            'totalCustomers' => User::count(), 
            'totalDestinations' => Destination::where('status', 'active')->count()
        ]);
    }
}
