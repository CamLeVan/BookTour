<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Review;
use App\Models\Booking;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
{
    $data = [
        'tours' => Tour::active()->latest()->take(6)->get(),
        'destinations' => Destination::withCount('tours')->active()->take(6)->get(),
        'testimonials' => Review::approved()->with('user')->latest()->take(3)->get(),
        'totalBookings' => Booking::count(),
        'totalTours' => Tour::active()->count(),
        'totalCustomers' => User::count(),
        'totalDestinations' => Destination::active()->count()
    ];

    return view('frontend.home.index', $data);
}
}