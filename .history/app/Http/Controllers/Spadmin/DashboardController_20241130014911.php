<?php

namespace App\Http\Controllers\Spadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy top 4 tour có số lượng đặt nhiều nhất
        $topTours = Tour::select('tours.*', 
                DB::raw('COUNT(bookings.id) as total_bookings'),
                DB::raw('SUM(bookings.total_amount) as total_revenue'))
            ->leftJoin('bookings', 'tours.id', '=', 'bookings.tour_id')
            ->where('bookings.status', 'confirmed')
            ->groupBy('tours.id')
            ->orderBy('total_bookings', 'desc')
            ->take(4)
            ->get();
        return view('spadmin.dashboard');
    }
}
