<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Review;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class HomeController extends Controller
{
    private const FAKE_POSTS = [
        [
            'image' => 'frontend/img/blog/1.jpg',
            'date' => ['month' => 'Th12', 'day' => '02'],
            'category' => 'Du lịch',
            'title' => 'Kinh nghiệm du lịch Hạ Long tự túc 2024',
            'url' => '#'
        ],
        [
            'image' => 'frontend/img/blog/2.jpg', 
            'date' => ['month' => 'Th12', 'day' => '05'],
            'category' => 'Ẩm thực',
            'title' => 'Top 10 món ăn không thể bỏ qua khi du lịch Đà Nẵng',
            'url' => '#'
        ],
        [
            'image' => 'frontend/img/blog/3.jpg',
            'date' => ['month' => 'Th12', 'day' => '08'],
            'category' => 'Du lịch',
            'title' => 'Kinh nghiệm du lịch Sapa mùa đông',
            'url' => '#'
        ],
        [
            'image' => 'frontend/img/blog/4.jpg',
            'date' => ['month' => 'Th12', 'day' => '10'],
            'category' => 'Cẩm nang',
            'title' => 'Những điều cần chuẩn bị cho chuyến du lịch',
            'url' => '#'
        ]
    ];

    public function index()
    {
        return view('frontend.home.index', [
            'tours' => Tour::where('status', 'active')->latest()->limit(6)->get(),
            'destinations' => Destination::where('status', 'active')->get(),
            'testimonials' => Review::where('status', 'approved')->latest()->limit(3)->get(),
            'posts' => self::FAKE_POSTS,
            'totalBookings' => Booking::count(),
            'totalTours' => Tour::where('status', 'active')->count(),
            'totalCustomers' => User::count(),
            'totalDestinations' => Destination::where('status', 'active')->count()
        ]);
    }
}