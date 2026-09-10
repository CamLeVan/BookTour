<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tour;

class TourController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect('/')->with('error', 'Unauthorized access.');
            }
            return $next($request);
        });
    }
    public function index()
    {
        return view('admin.tours.index');
    }
    public function create()
    {
        return view('admin.tours.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:2048',
            'gallery.*' => 'image|max:2048',
            // các validation khác...
        ]);

        // Upload ảnh chính
        $imagePath = $request->file('image')->store('tours', 'public');

        // Upload gallery
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('tours/gallery', 'public');
            }
        }

        $tour = Tour::create([
            'image' => $imagePath,
            'gallery' => $galleryPaths,
            // các field khác...
        ]);

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour created successfully');
    }

    // Other methods...
}
