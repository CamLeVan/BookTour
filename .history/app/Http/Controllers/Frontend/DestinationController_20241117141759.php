<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::paginate(12);
        return view('frontend.destinations.index', compact('destinations'));
    }

    public function show(Destination $destination)
    {
        return view('frontend.destinations.show', compact('destination'));
    }
}