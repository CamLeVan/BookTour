<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Review;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use DatabaseTransactions;

    protected User $user;
    protected User $admin;
    protected Tour $tour;

    protected function setUp(): void
    {
        parent::setUp();

        $destination = Destination::create([
            'name' => 'Phú Quốc',
            'slug' => 'phu-quoc',
            'description' => 'Đảo ngọc Phú Quốc',
        ]);

        $this->tour = Tour::create([
            'name' => 'Tour Phú Quốc 4N3Đ',
            'slug' => 'tour-phu-quoc-4n3d',
            'destination_id' => $destination->id,
            'description' => 'Khám phá thiên đường biển đảo',
            'price' => 5000000,
            'duration' => 4,
            'max_people' => 20,
            'image' => 'default.jpg',
            'status' => 'active',
        ]);

        $this->user = User::factory()->create([
            'role' => 'user',
            'email' => 'user_' . uniqid() . '@example.com',
        ]);

        $this->admin = User::factory()->create([
            'role' => 'admin',
            'email' => 'admin_' . uniqid() . '@example.com',
        ]);
    }

    public function test_user_with_completed_booking_can_submit_review(): void
    {
        $booking = Booking::create([
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'booking_date' => now()->addDays(5),
            'adults' => 2,
            'children' => 0,
            'total_price' => 10000000,
            'total_amount' => 10000000,
            'status' => 'completed',
            'payment_status' => 'paid',
        ]);

        $response = $this->actingAs($this->user)->post(route('frontend.bookings.review.store', $booking), [
            'rating' => 5,
            'comment' => 'Chuyến đi Phú Quốc cực kỳ tuyệt vời và đáng nhớ!',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('reviews', [
            'booking_id' => $booking->id,
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'rating' => 5,
            'comment' => 'Chuyến đi Phú Quốc cực kỳ tuyệt vời và đáng nhớ!',
            'status' => 'approved',
        ]);
    }

    public function test_user_cannot_submit_review_for_non_completed_booking(): void
    {
        $booking = Booking::create([
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'booking_date' => now()->addDays(5),
            'adults' => 2,
            'children' => 0,
            'total_price' => 10000000,
            'total_amount' => 10000000,
            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);

        $response = $this->actingAs($this->user)->post(route('frontend.bookings.review.store', $booking), [
            'rating' => 5,
            'comment' => 'Chuyến đi chưa hoàn thành nhưng thử đánh giá!',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');

        $this->assertDatabaseMissing('reviews', [
            'booking_id' => $booking->id,
        ]);
    }

    public function test_user_cannot_submit_duplicate_review_for_same_booking(): void
    {
        $booking = Booking::create([
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'booking_date' => now()->addDays(5),
            'adults' => 2,
            'children' => 0,
            'total_price' => 10000000,
            'total_amount' => 10000000,
            'status' => 'completed',
            'payment_status' => 'paid',
        ]);

        Review::create([
            'booking_id' => $booking->id,
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'rating' => 5,
            'comment' => 'Đánh giá lần thứ 1',
            'status' => 'approved',
        ]);

        $response = $this->actingAs($this->user)->post(route('frontend.bookings.review.store', $booking), [
            'rating' => 4,
            'comment' => 'Cố tình gửi đánh giá lần 2 trùng lặp!',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');

        $this->assertEquals(1, Review::where('booking_id', $booking->id)->count());
    }

    public function test_validation_rules_for_review_submission(): void
    {
        $booking = Booking::create([
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'booking_date' => now()->addDays(5),
            'adults' => 1,
            'children' => 0,
            'total_price' => 5000000,
            'total_amount' => 5000000,
            'status' => 'completed',
            'payment_status' => 'paid',
        ]);

        $response = $this->actingAs($this->user)->post(route('frontend.bookings.review.store', $booking), [
            'rating' => 10,
            'comment' => 'Ngắn',
        ]);

        $response->assertSessionHasErrors(['rating', 'comment']);
    }

    public function test_admin_can_manage_reviews(): void
    {
        $booking = Booking::create([
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'booking_date' => now()->addDays(5),
            'adults' => 1,
            'children' => 0,
            'total_price' => 5000000,
            'total_amount' => 5000000,
            'status' => 'completed',
            'payment_status' => 'paid',
        ]);

        $review = Review::create([
            'booking_id' => $booking->id,
            'user_id' => $this->user->id,
            'tour_id' => $this->tour->id,
            'rating' => 4,
            'comment' => 'Tour tốt nhưng thời tiết hơi mưa.',
            'status' => 'approved',
        ]);

        // 1. Admin xem danh sách đánh giá
        $response = $this->actingAs($this->admin)->get(route('admin.reviews.index'));
        $response->assertOk();
        $response->assertSee('Tour tốt nhưng thời tiết hơi mưa.');

        // 2. Admin Ẩn đánh giá
        $response = $this->actingAs($this->admin)->post(route('admin.reviews.reject', $review));
        $response->assertRedirect();
        $this->assertEquals('rejected', $review->fresh()->status);

        // 3. Admin Duyệt lại đánh giá
        $response = $this->actingAs($this->admin)->post(route('admin.reviews.approve', $review));
        $response->assertRedirect();
        $this->assertEquals('approved', $review->fresh()->status);

        // 4. Admin Xóa đánh giá
        $response = $this->actingAs($this->admin)->delete(route('admin.reviews.destroy', $review));
        $response->assertRedirect();
        $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
    }
}
