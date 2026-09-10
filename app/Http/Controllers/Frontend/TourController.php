<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\BookingCancelled;
use Illuminate\Support\Facades\Auth;



class TourController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $query = Tour::with(['destination', 'reviews'])
            ->where('status', 'active');

        // Tìm kiếm linh hoạt theo từ khóa
        if ($request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                // Tìm theo tên tour
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  // Hoặc theo mô tả
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  // Hoặc theo destination name
                  ->orWhereHas('destination', function($q) use ($searchTerm) {
                      $q->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // Lọc theo điểm đến
        if ($request->destination) {
            $query->where('destination_id', $request->destination);
        }
        // lọc theo giá tiền
        // Lọc theo khoảng giá
        if ($request->price_min || $request->price_max) {
            $priceMin = $request->price_min ?: 0; // Nếu không nhập giá tối thiểu, mặc định là 0
            $priceMax = $request->price_max ?: PHP_INT_MAX; // Nếu không nhập giá tối đa, mặc định là giá lớn nhất
            $query->whereBetween('price', [$priceMin, $priceMax]);
        }


        // Lọc theo thời gian linh hoạt hơn
        if ($request->duration) {
            [$min, $max] = explode('-', $request->duration);
            if ($max == '+') {
                $query->where('duration', '>=', $min);
            } else {
                // Cho phép sai số ±1 ngày
                $query->whereBetween('duration', [
                    max(1, intval($min) - 1), 
                    intval($max) + 1
                ]);
            }
        }

        // Sắp xếp kết quả
        $query->orderBy('created_at', 'desc');

        $tours = $query->paginate(9);

        return view('frontend.tours.index', [
            'tours' => $tours,
            'destinations' => Destination::all(),
            'testimonials' => Review::latest()->take(3)->get()
        ]);
    }

    public function show(Tour $tour)
    {
        return view('frontend.tours.show', [
            'tour' => $tour->load(['destination', 'reviews.user', 'schedules']),
            'relatedTours' => Tour::where('destination_id', $tour->destination_id)
                ->where('id', '!=', $tour->id)
                ->active()
                ->take(3)
                ->get()
        ]);
    }

    public function booking(Request $request, Tour $tour)
    {
        try {
            // Validate form đinhj dạng dữ liệu
            $validated = $request->validate([
                'booking_date' => ['required', 'date', 'after:' . now()->addDays(2)],
                'adults' => 'required|integer|min:1',
                'children' => 'nullable|integer|min:0',
                'notes' => 'nullable|string|max:500',
                'payment_method' => 'required|in:direct,bank'
            ]);

            // Tính tổng tiền
            $total_price = ($request->adults * $tour->price) +
                ($request->children * $tour->price * 0.5);

            // Tạo booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'tour_id' => $tour->id,
                'booking_date' => $request->booking_date,
                'adults' => $request->adults,
                'children' => $request->children,
                'total_price' => $total_price,
                'notes' => $request->notes,
                'status' => 'pending',
                'payment_status' => 'unpaid'
            ]);

            // Xử lý theo phương thức thanh toán
            if ($request->payment_method === 'direct') {
                // Thanh toán trực tiếp
                $booking->update([
                    'status' => 'confirmed',
                    'payment_status' => 'pending',
                    'payment_method' => 'direct',
                    'payment_id' => 'DIRECT_' . time()
                ]);

                // Gửi email xác nhận
                Mail::to($booking->user->email)->send(new BookingConfirmation($booking));

                return redirect()->route('frontend.bookings.success', $booking)
                    ->with('success', 'Đặt tour thành công! Vui lòng thanh toán trong vòng 24h.');
            } else {
                // Thanh toán qua ngân hàng
                $booking->update([
                    'payment_method' => 'bank'
                ]);

                return view('frontend.bookings.bank-transfer', [
                    'booking' => $booking,
                    'bankInfo' => [
                        'bank_name' => 'Vietcombank',
                        'account_number' => '0344574050',
                        'account_name' => 'CÔNG TY DU LỊCH HC_traveltravel',
                        'branch' => 'Chi nhánh Hà Nội',
                        'content' => 'TOUR' . $booking->id
                    ]
                ]);
            }

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function processPayment(Request $request, Booking $booking)
    {
        if ($request->status === 'success') {
            $booking->update([
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_method' => 'fake_payment',
                'payment_id' => 'FAKE_' . time(),
                'paid_at' => now()
            ]);

            try {
                Mail::to($booking->user->email)->send(new BookingConfirmation($booking));
            } catch (\Exception $e) {
                  }

            return redirect()->route('frontend.bookings.success', $booking)
                ->with('success', 'Đặt tour thành công!');
        }

        $booking->update(['status' => 'cancelled']);
        return redirect()->route('frontend.bookings.failed')
            ->with('error', 'Thanh toán không thành công!');
    }

    public function vnPayReturn(Request $request)
    {
        return redirect()->route('frontend.bookings.history')
            ->with('success', 'Thanh toán thành công!');
    }

    public function failed()
    {
        return view('frontend.bookings.failed')->with('error', 'Thanh toán thất bại.');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function category($category, Request $request)
    {
        $request->merge(['destination' => $category]);
        return $this->index($request);
    }
}
