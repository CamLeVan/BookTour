<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')
                    ->latest()
                    ->take(6)
                    ->get();

        return view('frontend.home', compact('posts'));
    }
}