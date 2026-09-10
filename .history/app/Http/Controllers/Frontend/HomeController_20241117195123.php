<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $tours = Tour::latest()->take(6)->get();
        $testimonials = Testimonial::latest()->take(3)->get();
        
        return view('frontend.home.index', compact('tours', 'testimonials'));
    }
}