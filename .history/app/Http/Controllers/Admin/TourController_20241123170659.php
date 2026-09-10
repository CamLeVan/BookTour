<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        dd($request->all());
    }

    // Other methods...
}
