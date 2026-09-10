<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Review;

class TourController extends Controller
{
    public function index()
    {
        return view('frontend.tours.index', [
            'tours' => Tour::with(['reviews'])
                         ->where('status', 'active')
                         ->latest()
                         ->get(),
            'testimonials' => Review::where('status', 'approved')
                                  ->latest()
                                  ->limit(3)
                                  ->get()
        ]);
    }
}
