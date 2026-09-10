<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::with(['destination', 'reviews'])
            ->where('status', 'active');
        
        // Filter by destination
        if ($request->destination) {
            $query->where('destination_id', $request->destination);
        }

        // Filter by duration
        if ($request->duration) {
            [$min, $max] = explode('-', $request->duration);
            if ($max == '+') {
                $query->where('duration', '>=', $min);
            } else {
                $query->whereBetween('duration', [$min, $max]);
            }
        }

        // Filter by price
        if ($request->price) {
            [$min, $max] = explode('-', $request->price);
            if ($max == '+') {
                $query->where('price', '>=', $min);
            } else {
                $query->whereBetween('price', [$min, $max]);
            }
        }

        $tours = $query->paginate(9);
        
        // Thêm testimonials
        $testimonials = Review::with(['user', 'tour'])
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.tours.index', [
            'tours' => $tours,
            'destinations' => Destination::all(),
            'testimonials' => $testimonials
        ]);
    }

    public function show(Tour $tour)
    {
        return view('frontend.tours.show', [
            'tour' => $tour->load(['destination', 'reviews.user', 'schedules']),
            'relatedTours' => Tour::where('destination_id', $tour->destination_id)
                ->where('id', '!=', $tour->id)
                ->active()
                ->take(3)
                ->get()
        ]);
    }
}
