<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\Destination;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FinancialWorkflowTest extends TestCase
{
    use DatabaseTransactions;

    protected User $user;
    protected Tour $tour;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::first() ?? User::factory()->create(['role' => 'user']);
        
        $destination = Destination::first() ?? Destination::create([
            'name' => 'Điểm đến mẫu',
            'slug' => 'diem-den-mau',
            'description' => 'Mô tả điểm đến mẫu',
        ]);

        $this->tour = Tour::first() ?? Tour::create([
            'name' => 'Tour thử nghiệm',
            'slug' => 'tour-thu-nghiem-' . uniqid(),
            'destination_id' => $destination->id,
            'description' => 'Mô tả tour thử nghiệm',
            'price' => 5000000,
            'duration' => 3,
            'max_people' => 15,
            'image' => 'default.jpg',
            'status' => 'active',
        ]);
    }

    public function test_booking_creation_with_30_percent_deposit_and_hold_slot()
    {
        $booking = Booking::create([
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'booking_date' => Carbon::now()->addDays(10)->format('Y-m-d H:i:s'),
            'adults' => 2,
            'children' => 0,
            'total_price' => 6000000,
            'total_amount' => 1800000, // 30% Deposit
            'discount_amount' => 0,
            'is_deposit' => true,
            'deposit_amount' => 1800000,
            'remaining_amount' => 4200000,
            'hold_expires_at' => Carbon::now()->addMinutes(15),
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ]);

        $this->assertEquals(1800000, $booking->deposit_amount);
        $this->assertEquals(4200000, $booking->remaining_amount);
        $this->assertFalse($booking->isHoldExpired());
    }

    public function test_hold_slot_expiration()
    {
        $booking = Booking::create([
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'booking_date' => Carbon::now()->addDays(5)->format('Y-m-d H:i:s'),
            'adults' => 1,
            'children' => 0,
            'total_price' => 3000000,
            'total_amount' => 3000000,
            'hold_expires_at' => Carbon::now()->subMinutes(1),
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ]);

        $this->assertTrue($booking->isHoldExpired());
    }

    public function test_cancellation_refund_policy_calculation()
    {
        // 1. Cancel > 7 days before tour start -> 100% refund
        $bookingFar = Booking::create([
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'booking_date' => Carbon::now()->addDays(10)->format('Y-m-d H:i:s'),
            'adults' => 1,
            'children' => 0,
            'total_price' => 4000000,
            'total_amount' => 4000000,
            'status' => 'confirmed',
            'payment_status' => 'paid'
        ]);

        $this->assertEquals(4000000, $bookingFar->calculateRefundAmount());

        // 2. Cancel 3-7 days before tour start -> 50% refund
        $bookingMid = Booking::create([
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'booking_date' => Carbon::now()->addDays(4)->format('Y-m-d H:i:s'),
            'adults' => 1,
            'children' => 0,
            'total_price' => 4000000,
            'total_amount' => 4000000,
            'status' => 'confirmed',
            'payment_status' => 'paid'
        ]);

        $this->assertEquals(2000000, $bookingMid->calculateRefundAmount());

        // 3. Cancel < 3 days before tour start -> 0% refund
        $bookingNear = Booking::create([
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'booking_date' => Carbon::now()->addDays(1)->format('Y-m-d H:i:s'),
            'adults' => 1,
            'children' => 0,
            'total_price' => 4000000,
            'total_amount' => 4000000,
            'status' => 'confirmed',
            'payment_status' => 'paid'
        ]);

        $this->assertEquals(0, $bookingNear->calculateRefundAmount());
    }
}
