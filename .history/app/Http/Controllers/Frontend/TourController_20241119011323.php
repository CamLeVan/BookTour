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

    public function show(Tour $tour)
    {
        return view('frontend.tours.show', [
            'tour' => $tour->load(['reviews', 'images']),
            'relatedTours' => Tour::where('id', '!=', $tour->id)
                                 ->where('destination_id', $tour->destination_id)
                                 ->limit(3)
                                 ->get()
        ]);
    }
}
