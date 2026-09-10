<?php

namespace App\Http\Controllers\Spadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourSpController extends Controller
{
    public function index()
    {
        $tours = Tour::all();
        return view('spadmin.tours.tour-listSp', compact('tours'));
    }
    public function show(Tour $tour)
    {
        return view('spadmin.tours.show-tourSp', compact('tour'));
    }

    public function approve(Tour $tour)
    {
        $tour->update(['status_approval' => 'approved', 'status' => 'active']);
        return redirect()->back()->with('success', 'Tour approved successfully');
    }

    public function reject(Tour $tour)
    {
        $tour->update(['status_approval' => 'rejected', 'status' => 'inactive']);
        return redirect()->back()->with('success', 'Tour rejected successfully');
    }
}
