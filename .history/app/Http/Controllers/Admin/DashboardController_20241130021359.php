<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy top 3 tour được đặt nhiều nhất
        $topTours = Tour::withCount('bookings')
            ->withSum('bookings', 'total_amount')
            ->orderBy('bookings_count', 'desc')
            ->take(3)
            ->get();

        // Thống kê doanh thu
        $statistics = [
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_amount'),
            'total_bookings' => Booking::count(),
            'total_customers' => User::where('role', 'user')->count(),
            'repeat_customers' => User::where('role', 'user')
                ->whereHas('bookings', function($q) {
                    $q->where('payment_status', 'paid');
                }, '>', 1)
                ->count()
        ];

        return view('admin.dashboard', compact('topTours', 'statistics'));
    }
}
