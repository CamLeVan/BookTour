<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

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

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $posts = Post::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->paginate(6);
            
        return view('frontend.blog.index', [
            'posts' => $posts,
            'recentPosts' => Post::latest()->take(3)->get(),
            'categories' => Category::withCount('posts')->get(),
            'archives' => Post::selectRaw('YEAR(created_at) year, MONTH(created_at) month, COUNT(*) post_count')
                ->groupBy('year', 'month')
                ->orderByDesc('year')
                ->orderByDesc('month')
                ->get(),
            'tags' => Tag::withCount('posts')->get(),
            'query' => $query
        ]);
    }

    public function archive($year, $month)
    {
        $posts = Post::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->paginate(6);
            
        return view('frontend.blog.index', [
            'posts' => $posts,
            'recentPosts' => Post::latest()->take(3)->get(),
            'categories' => Category::withCount('posts')->get(),
            'archives' => Post::selectRaw('YEAR(created_at) year, MONTH(created_at) month, COUNT(*) post_count')
                ->groupBy('year', 'month')
                ->orderByDesc('year')
                ->orderByDesc('month')
                ->get(),
            'tags' => Tag::withCount('posts')->get()
        ]);
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.blog.show', [
            'post' => $post,
            'recentPosts' => Post::latest()->take(3)->get(),
            'categories' => Category::withCount('posts')->get(),
            'archives' => Post::selectRaw('YEAR(created_at) year, MONTH(created_at) month, COUNT(*) post_count')
                ->groupBy('year', 'month')
                ->orderByDesc('year')
                ->orderByDesc('month')
                ->get(),
            'tags' => Tag::withCount('posts')->get()
        ]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $posts = Post::with(['category', 'tags'])
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(6);

        return view('frontend.blog.index', [
            'posts' => $posts,
            'category' => $category,
            'recentPosts' => Post::latest()->take(3)->get(),
            'categories' => Category::withCount('posts')->get(),
            'archives' => Post::selectRaw('YEAR(created_at) year, MONTH(created_at) month, COUNT(*) post_count')
                ->groupBy('year', 'month')
                ->orderByDesc('year')
                ->orderByDesc('month')
                ->get(),
            'tags' => Tag::withCount('posts')->get()
        ]);
    }

    public function tag($slug) 
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        
        $posts = $tag->posts()
            ->with(['category', 'tags'])
            ->latest()
            ->paginate(6);

        return view('frontend.blog.index', [
            'posts' => $posts,
            'tag' => $tag,
            'recentPosts' => Post::latest()->take(3)->get(),
            'categories' => Category::withCount('posts')->get(),
            'archives' => Post::selectRaw('YEAR(created_at) year, MONTH(created_at) month, COUNT(*) post_count')
                ->groupBy('year', 'month')
                ->orderByDesc('year')
                ->orderByDesc('month')
                ->get(),
            'tags' => Tag::withCount('posts')->get()
        ]);
    }
}
