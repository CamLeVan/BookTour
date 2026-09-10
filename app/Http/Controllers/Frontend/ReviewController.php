<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Booking $booking)
    {
        // 1. Kiểm tra quyền sở hữu đơn hàng
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền đánh giá đơn hàng này.');
        }

        // 2. Kiểm tra trạng thái đơn hàng (chỉ cho phép đánh giá tour đã hoàn thành)
        if ($booking->status !== 'completed') {
            return back()->with('error', 'Chỉ có thể gửi đánh giá cho những tour đã hoàn thành chuyến đi.');
        }

        // 3. Chống gửi đánh giá trùng
        if ($booking->review()->exists()) {
            return back()->with('error', 'Bạn đã gửi đánh giá cho chuyến đi này rồi.');
        }

        // 4. Validate dữ liệu
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ], [
            'rating.required' => 'Vui lòng chọn số sao đánh giá (1 - 5 sao).',
            'rating.min' => 'Điểm sao tối thiểu là 1.',
            'rating.max' => 'Điểm sao tối đa là 5.',
            'comment.required' => 'Vui lòng viết nội dung đánh giá của bạn.',
            'comment.min' => 'Nội dung đánh giá phải có ít nhất 5 ký tự.',
        ]);

        // 5. Lưu Đánh Giá
        Review::create([
            'user_id' => Auth::id(),
            'tour_id' => $booking->tour_id,
            'booking_id' => $booking->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'status' => 'approved',
        ]);

        return back()->with('success', '🌟 Cảm ơn bạn đã gửi đánh giá! Đánh giá ' . $validated['rating'] . '⭐ của bạn đã được ghi nhận.');
    }
}
