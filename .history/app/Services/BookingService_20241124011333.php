<?php

namespace App\Services;

use App\Models\Tour;
use App\Models\PendingBooking;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BookingService
{
    public function createPendingBooking(Tour $tour, array $data): PendingBooking
    {
        if (!Auth::check()) {
            throw new \Exception('Vui lòng đăng nhập để đặt tour.');
        }

        $total = $this->calculateTotal($tour, $data['adults'], $data['children'] ?? 0);

        return PendingBooking::create([
            'tour_id' => $tour->id,
            'user_id' => Auth::id(),
            'reference_code' => 'BK' . strtoupper(Str::random(8)),
            'booking_date' => $data['booking_date'],
            'adults' => $data['adults'],
            'children' => $data['children'] ?? 0,
            'notes' => $data['notes'] ?? null,
            'total_amount' => $total,
            'expires_at' => now()->addHours(24),
        ]);
    }

    public function calculateTotal(Tour $tour, int $adults, int $children): float
    {
        // Người lớn: giá gốc
        $adultTotal = $adults * $tour->price;
        
        // Trẻ em: 50% giá người lớn
        $childrenTotal = $children * ($tour->price * 0.5);
        
        // Tổng = người lớn + trẻ em
        $total = $adultTotal + $childrenTotal;

        // // Debug
        // \Log::info('Calculating total:', [
        //     'tour_price' => $tour->price,
        //     'adults' => $adults,
        //     'children' => $children,
        //     'adult_total' => $adultTotal,
        //     'children_total' => $childrenTotal,
        //     'total' => $total
        // ]);

        return $total;
    }

    public function confirmBooking(PendingBooking $pendingBooking, string $transactionId)
    {
        // Create actual booking
        $booking = $pendingBooking->tour->bookings()->create([
            'user_id' => $pendingBooking->user_id,
            'booking_code' => $pendingBooking->booking_code,
            'booking_date' => $pendingBooking->booking_date,
            'adults' => $pendingBooking->adults,
            'children' => $pendingBooking->children,
            'total_amount' => $pendingBooking->total_amount,
            'notes' => $pendingBooking->notes,
            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);

        // Create payment record
        $booking->payment()->create([
            'amount' => $pendingBooking->total_amount,
            'transaction_id' => $transactionId,
            'status' => 'completed'
        ]);

        // Delete pending booking
        $pendingBooking->delete();

        return $booking;
    }
} 