<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tour;
use App\Models\Destination;

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
        $tours = Tour::all();
        return view('admin.tours.index', compact('tours'));
    }
    public function create()
    {
        return view('admin.tours.create');
    }
    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        $destinations = Destination::all();

        return view('admin.tours.edit', compact('tour', 'destinations'));
    }
    public function store(Request $request)
    {
        try {
            $data = $request->except(['_token']);
            $data['user_id'] = Auth::id();
            if (empty($data['slug'])) {
                $data['slug'] = \Illuminate\Support\Str::slug($data['name'] ?? 'tour-' . time());
            }
            Tour::create($data);
            return redirect()->route('admin.tours.index')->with('success', 'Tour created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating tour: ' . $e->getMessage())->withInput();
        }
    }
}
