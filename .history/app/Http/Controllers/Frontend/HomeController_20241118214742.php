<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Review;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class HomeController extends Controller
{
    public function index()
{
    try {
        $data = [
            'tours' => Tour::active()->latest()->take(6)->get(),
            'destinations' => Destination::withCount('tours')
                ->active()
                ->take(6)
                ->get(),
            'testimonials' => Review::approved()
                ->with('user')
                ->latest()
                ->take(3)
                ->get(),
            // Thống kê cơ bản
            'totalBookings' => Booking::count() ?? 0,
            'totalTours' => Tour::active()->count() ?? 0,
            'totalCustomers' => User::count() ?? 0,
            'totalDestinations' => Destination::active()->count() ?? 0
        ];
    } catch (\Exception $e) {
        // Log error
        Log::error('Error loading home page data: ' . $e->getMessage());
        
        // Provide default data
        $data = [
            'tours' => collect([]),
            'destinations' => collect([]),
            'testimonials' => collect([]),
            'totalBookings' => 0,
            'totalTours' => 0,
            'totalCustomers' => 0,
            'totalDestinations' => 0
        ];
    }

    return view('frontend.home.index', $data);
}
}