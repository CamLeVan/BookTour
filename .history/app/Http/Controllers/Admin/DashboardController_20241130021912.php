<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Lấy top 4 tour được đặt nhiều nhất
            $topTours = Tour::withCount(['bookings' => function($query) {
                    $query->where('payment_status', 'paid');
                }])
                ->withSum(['bookings' => function($query) {
                    $query->where('payment_status', 'paid');
                }], 'total_amount')
                ->orderBy('bookings_count', 'desc')
                ->take(4)
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

            // Debug information
            dd([
                'topTours' => $topTours->toArray(),
                'statistics' => $statistics,
                'route' => request()->route()->getName(),
                'controller' => class_basename($this)
            ]);

            return view('admin.dashboard', compact('topTours', 'statistics'));
        } catch (\Exception $e) {
            // Log error
            Log::error('Dashboard Error: ' . $e->getMessage());
            
            return view('admin.dashboard')->with('error', 'Có lỗi xảy ra khi tải dữ liệu');
        }
    }
}
