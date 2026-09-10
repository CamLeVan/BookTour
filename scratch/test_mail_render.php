<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
use App\Models\User;
use App\Models\Tour;
use App\Models\Destination;
use App\Mail\BookingConfirmation;
use App\Mail\BookingCancelled;
use App\Mail\PaymentConfirmation;
use App\Mail\RegistrationSuccessful;

try {
    config(['mail.default' => 'array']);

    $user = User::first() ?? User::factory()->create(['role' => 'user']);
    $destination = Destination::first() ?? Destination::create(['name' => 'Đà Nẵng', 'slug' => 'da-nang']);
    $tour = Tour::first() ?? Tour::create([
        'name' => 'Tour Đà Nẵng',
        'slug' => 'tour-da-nang-' . time(),
        'destination_id' => $destination->id,
        'description' => 'Mô tả tour',
        'price' => 3000000,
        'duration' => 3,
        'max_people' => 10,
        'image' => 'default.jpg',
        'status' => 'active',
    ]);

    $booking = Booking::first() ?? Booking::create([
        'user_id' => $user->id,
        'tour_id' => $tour->id,
        'booking_date' => now()->addDays(5),
        'adults' => 2,
        'children' => 1,
        'total_price' => 7500000,
        'total_amount' => 7500000,
        'status' => 'confirmed',
        'payment_status' => 'paid',
        'payment_method' => 'bank',
        'transaction_id' => 'TX123456',
    ]);

    echo "Testing BookingConfirmation Mailable...\n";
    Mail::to('test@example.com')->send(new BookingConfirmation($booking));
    echo " -> PASS!\n";

    echo "Testing BookingCancelled Mailable...\n";
    Mail::to('test@example.com')->send(new BookingCancelled($booking));
    echo " -> PASS!\n";

    echo "Testing PaymentConfirmation Mailable...\n";
    Mail::to('test@example.com')->send(new PaymentConfirmation($booking));
    echo " -> PASS!\n";

    echo "Testing RegistrationSuccessful Mailable...\n";
    Mail::to('test@example.com')->send(new RegistrationSuccessful($user));
    echo " -> PASS!\n";

    echo "\nALL 4 MAILABLES & TEMPLATES RENDER & SEND 100% SUCCESSFULLY!\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
