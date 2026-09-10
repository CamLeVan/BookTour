<?php

namespace App\Http\Controllers\Spadmin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Kiểm tra xem có dữ liệu booking không
        $topTours = Tour::select(
            'tours.*',
            DB::raw('COUNT(bookings.id) as total_bookings'),
            DB::raw('SUM(COALESCE(bookings.total_amount, bookings.total_price, 0)) as total_revenue')
        )
            ->leftJoin('bookings', 'tours.id', '=', 'bookings.tour_id')
            ->where(function ($query) {
                $query->where('bookings.status', 'confirmed')
                    ->orWhereNull('bookings.status'); // Để lấy cả tours chưa có bookings
            })
            ->groupBy([
                'tours.id',
                'tours.name',
                'tours.image',
                'tours.price',
                'tours.destination_id',
                'tours.slug',
                'tours.description',
                'tours.duration',
                'tours.max_people',
                'tours.status',
                'tours.created_at',
                'tours.updated_at'
            ])
            ->orderBy('total_bookings', 'desc')
            ->take(4)
            ->get();

        // Debug
        // dd($topTours);

        return view('spadmin.dashboard', compact('topTours'));
    }
}
