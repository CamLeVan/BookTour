<?php

namespace App\Http\Controllers\Spadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Debug để xem user
        dd([
            'user' => Auth::user(),
            'role' => Auth::user()->role,
            'authenticated' => Auth::check()
        ]);
        
        return view('spadmin.dashboard');
    }
}
