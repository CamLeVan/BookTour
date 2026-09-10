<?php

namespace App\Http\Controllers\Frontend;
use  \Illuminate\Support\Facades\Facade;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => 'required',
            'number_of_people' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        // Lấy thông tin tour
        $tour = Tour::findOrFail($request->tour_id);
        
        // Tính tổng tiền
        $total_price = $tour->price * $request->number_of_people;

        try {
            // Chuyển đổi định dạng ngày
            $date = str_replace('-', '/', $request->booking_date);
            $booking_date = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');

            // Tạo booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'tour_id' => $request->tour_id,
                'booking_date' => $booking_date,
                'number_of_people' => $request->number_of_people,
                'total_price' => $total_price,
                'status' => 'pending',
                'notes' => $request->notes
            ]);

            // Chuyển hướng đến trang lịch sử đặt tour
            return redirect()
                ->route('frontend.booking.history')
                ->with('success', 'Đặt tour thành công! Chúng tôi sẽ liên hệ với bạn sớm.');

        } catch (\Exception $e) {
            Log::error('Booking error: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra khi đặt tour. Vui lòng thử lại.');
        }
    }

    public function history()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
            ->with('tour')
            ->latest()
            ->get();

        return view('frontend.booking.history', compact('bookings'));
    }
} 