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
            ->when($request->destination, function($q) use ($request) {
                return $q->where('destination_id', $request->destination);
            })
            ->when($request->duration, function($q) use ($request) {
                [$min, $max] = explode('-', $request->duration);
                if ($max == '+') {
                    return $q->where('duration', '>=', $min);
                }
                return $q->whereBetween('duration', [$min, $max]);
            })
            ->when($request->price, function($q) use ($request) {
                [$min, $max] = explode('-', $request->price);
                if ($max == '+') {
                    return $q->where('price', '>=', $min);
                }
                return $q->whereBetween('price', [$min, $max]);
            });

        $tours = $query->paginate(9);
        $destinations = Destination::all();

        return view('frontend.tours.index', compact('tours', 'destinations'));
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
