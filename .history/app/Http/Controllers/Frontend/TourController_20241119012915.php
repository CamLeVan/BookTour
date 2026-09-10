<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Review;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::with(['destination', 'reviews'])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc');
        
        // Apply filters if any
        if ($request->destination) {
            $query->where('destination_id', $request->destination);
        }

        if ($request->duration) {
            [$min, $max] = explode('-', $request->duration);
            if ($max == '+') {
                $query->where('duration', '>=', $min);
            } else {
                $query->whereBetween('duration', [$min, $max]);
            }
        }

        if ($request->price) {
            [$min, $max] = explode('-', $request->price);
            if ($max == '+') {
                $query->where('price', '>=', $min);
            } else {
                $query->whereBetween('price', [$min, $max]);
            }
        }

        // Paginate results
        $tours = $query->paginate(9);
        
        return view('frontend.tours.index', [
            'tours' => $tours,
            'testimonials' => Review::where('status', 'approved')
                ->orderBy('created_at', 'desc')
                ->take(3)
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
