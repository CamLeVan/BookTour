<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::latest()->take(6)->get();
        return view('frontend.home.index', compact('tours'));
    }
}