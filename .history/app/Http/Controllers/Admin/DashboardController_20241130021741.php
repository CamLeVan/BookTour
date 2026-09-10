<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy top 4 tour được đặt nhiều nhất
        $topTours = Tour::withCount(['bookings' => function($query) {
                $query->where('payment_status', 'paid');
            }])
            ->withSum(['bookings' => function($query) {
                $query->where('payment_status', 'paid');
            }], 'total_amount')
            ->orderBy('bookings_count', 'desc')
            ->take(4)  // Thay đổi từ 3 thành 4
            ->get();

        return view('admin.dashboard');
    }
}
