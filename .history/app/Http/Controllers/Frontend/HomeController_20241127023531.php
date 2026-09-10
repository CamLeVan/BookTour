<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Review;
use App\Models\Booking;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.index', [
            'tours' => Tour::where('status', 'active')
                          ->latest()
                          ->limit(6)
                          ->get(),
            'destinations' => Destination::where('status', 'active')
                                       ->get(),
            'testimonials' => Review::where('status', 'approved')
                                  ->latest()
                                  ->limit(3)
                                  ->get(),
            'posts' => Post::with('category')
                          ->latest()
                          ->limit(4)
                          ->get(),
            'totalBookings' => Booking::count(),
            'totalTours' => Tour::where('status', 'active')->count(),
            'totalCustomers' => User::count(),
            'totalDestinations' => Destination::where('status', 'active')->count()
        ]);
    }
}