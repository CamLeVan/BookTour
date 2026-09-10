<?php

namespace App\View\Components\Frontend\Tours;

use Illuminate\View\Component;
use App\Models\Review;

class CallToAction extends Component
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
        return view('components.frontend.tours.call-to-action');
    }
} 