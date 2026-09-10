<?php

namespace App\Services;

use App\Models\PendingBooking;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Services\VietQRService;
class BookingService
{
    /**
     * @var VietQRService
     */
    protected $vietQRService;

    /**
     * Khởi tạo service với dependency
     */
    public function __construct(VietQRService $vietQRService)
    {
        $this->vietQRService = $vietQRService;
    }

    /**
     * Tạo pending booking mới
     * 
     * @param array $data Dữ liệu booking
     * @return PendingBooking
     */
    public function createPendingBooking(array $data): PendingBooking
    {
        return DB::transaction(function () use ($data) {
            // Tính tổng tiền
            $totalAmount = $this->calculateTotalAmount($data);

            // Tạo mã tham chiếu unique
            $referenceCode = $this->generateReferenceCode();

            // Tạo pending booking
            $pendingBooking = PendingBooking::create([
                'user_id' => auth()->id(),
                'tour_id' => $data['tour_id'],
                'booking_date' => $data['booking_date'],
                'adults' => $data['adults'],
                'children' => $data['children'] ?? 0,
                'total_amount' => $totalAmount,
                'reference_code' => $referenceCode,
                'notes' => $data['notes'] ?? null,
                'expires_at' => $this->calculateExpiryTime()
            ]);

            return $pendingBooking;
        });
    }

    /**
     * Tính tổng tiền tour
     */
    protected function calculateTotalAmount(array $data): float
    {
        $tour = Tour::findOrFail($data['tour_id']);
        
        $adultTotal = $data['adults'] * $tour->price;
        $childTotal = ($data['children'] ?? 0) * $tour->price * 0.5;
        
        return $adultTotal + $childTotal;
    }

    /**
     * Tạo mã tham chiếu unique
     */
    protected function generateReferenceCode(): string
    {
        return 'TOUR' . Str::upper(Str::random(8));
    }

    /**
     * Tính thời gian hết hạn
     */
    protected function calculateExpiryTime(): \Carbon\Carbon
    {
        return now()->addMinutes(config('payment.expire_after', 60));
    }

    /**
     * Tạo mã QR cho thanh toán
     */
    public function generatePaymentQR(PendingBooking $pendingBooking): string
    {
        return $this->vietQRService->generateQR(
            $pendingBooking->total_amount,
            $pendingBooking->reference_code
        );
    }

    /**
     * Xác nhận booking sau khi thanh toán thành công
     * 
     * @param PendingBooking $pendingBooking
     * @param string $transactionId Mã giao dịch từ ngân hàng
     * @return Booking
     */
    public function confirmBooking(PendingBooking $pendingBooking, string $transactionId): Booking
    {
        return DB::transaction(function () use ($pendingBooking, $transactionId) {
            // Tạo booking chính thức
            $booking = $this->createConfirmedBooking($pendingBooking);

            // Tạo payment record
            $this->createPaymentRecord($booking, $pendingBooking, $transactionId);

            // Cập nhật trạng thái pending booking
            $pendingBooking->update(['status' => 'completed']);

            return $booking;
        });
    }

    /**
     * Tạo booking chính thức
     */
    protected function createConfirmedBooking(PendingBooking $pendingBooking): Booking
    {
        return Booking::create([
            'user_id' => $pendingBooking->user_id,
            'tour_id' => $pendingBooking->tour_id,
            'booking_date' => $pendingBooking->booking_date,
            'adults' => $pendingBooking->adults,
            'children' => $pendingBooking->children,
            'total_price' => $pendingBooking->total_amount,
            'status' => 'confirmed',
            'notes' => $pendingBooking->notes
        ]);
    }

    /**
     * Tạo payment record
     */
    protected function createPaymentRecord(
        Booking $booking, 
        PendingBooking $pendingBooking, 
        string $transactionId
    ): Payment {
        return Payment::create([
            'booking_id' => $booking->id,
            'amount' => $pendingBooking->total_amount,
            'transaction_id' => $transactionId,
            'payment_method' => 'vietqr',
            'status' => 'completed',
            'paid_at' => now()
        ]);
    }
}