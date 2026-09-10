<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PendingBooking;
use App\Services\BookingService;
use App\Services\VietQRService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected BookingService $bookingService;
    protected VietQRService $vietQRService;

    public function __construct(
        BookingService $bookingService,
        VietQRService $vietQRService
    ) {
        $this->bookingService = $bookingService;
        $this->vietQRService = $vietQRService;
    }

    /**
     * Xử lý webhook từ VietQR/VCB
     */
    public function handleWebhook(Request $request)
    {
        Log::info('Payment Webhook Received', $request->all());

        try {
            // Validate transaction data
            if (!$this->vietQRService->validateTransaction($request->all())) {
                return response()->json(['error' => 'Invalid transaction data'], 400);
            }

            // Extract booking code từ nội dung chuyển khoản
            $bookingCode = $this->vietQRService->extractBookingCode(
                $request->input('description')
            );

            if (!$bookingCode) {
                return response()->json(['error' => 'Invalid booking code'], 400);
            }

            // Tìm pending booking
            $pendingBooking = PendingBooking::where('reference_code', $bookingCode)
                                          ->where('status', 'pending')
                                          ->first();

            if (!$pendingBooking) {
                return response()->json(['error' => 'Booking not found'], 404);
            }

            // Xác nhận booking
            $booking = $this->bookingService->confirmBooking(
                $pendingBooking,
                $request->input('transaction_id')
            );

            return response()->json(['success' => true, 'booking_id' => $booking->id]);

        } catch (\Exception $e) {
            Log::error('Payment Webhook Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    /**
     * Check trạng thái thanh toán (cho polling từ frontend)
     */
    public function checkStatus(PendingBooking $pendingBooking)
    {
        if ($pendingBooking->isCompleted()) {
            return response()->json([
                'status' => 'completed',
                'redirect_url' => route('frontend.bookings.success', $pendingBooking)
            ]);
        }

        if ($pendingBooking->isExpired()) {
            return response()->json([
                'status' => 'expired',
                'message' => 'Phiên thanh toán đã hết hạn'
            ]);
        }

        return response()->json(['status' => 'pending']);
    }

    public function simulatePayment(PendingBooking $pendingBooking)
    {
        try {
            // Giả lập thanh toán thành công
            $booking = $this->bookingService->confirmBooking(
                $pendingBooking,
                'MOCK_' . uniqid()  // Tạo mã giao dịch giả
            );

            return redirect()->route('frontend.bookings.success', $pendingBooking)
                            ->with('success', 'Thanh toán thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
} 