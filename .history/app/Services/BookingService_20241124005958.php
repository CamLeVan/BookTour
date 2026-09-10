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

        return PendingBooking::create([
            'tour_id' => $tour->id,
            'user_id' => Auth::id(),
            'booking_code' => 'BK' . strtoupper(Str::random(8)),
            'booking_date' => $data['booking_date'],
            'adults' => $data['adults'],
            'children' => $data['children'] ?? 0,
            'notes' => $data['notes'] ?? null,
            'total_amount' => $this->calculateTotal($tour, $data['adults'], $data['children'] ?? 0),
            'expires_at' => now()->addHours(24),
        ]);
    }

    public function calculateTotal(Tour $tour, int $adults, int $children): float
    {
        return ($adults * $tour->price) + ($children * $tour->price * 0.5);
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