<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'tags'])
            ->latest()
            ->paginate(4);
            
        $recentPosts = Post::latest()->take(3)->get();
        $categories = Category::withCount('posts')->get();
        $archives = Post::selectRaw('YEAR(created_at) year, MONTH(created_at) month, COUNT(*) post_count')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();
        $tags = Tag::withCount('posts')->get();

        return view('frontend.blog.index', compact(
            'posts',
            'recentPosts', 
            'categories',
            'archives',
            'tags'
        ));
    }
}
