<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        // Tạm thời return view không có data
        return view('frontend.home');
        
        // Sau này khi có model Tour rồi thì có thể uncomment đoạn code dưới
        /*
        $featuredTours = Tour::where('status', 'published')
            ->where('is_featured', true)
            ->take(6)
            ->get();
            
        return view('frontend.home', compact('featuredTours'));
        */
    }
}
