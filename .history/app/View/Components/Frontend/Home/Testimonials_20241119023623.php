<?php

namespace App\View\Components\Frontend\Home;

use Illuminate\View\Component;
use App\Models\Review;

class Testimonials extends Component
{
    public $testimonials;

    public function __construct()
    {
        $this->testimonials = Review::with(['user', 'tour'])
            ->where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();
    }

    public function render()
    {
        return view('components.frontend.home.testimonials');
    }
} 