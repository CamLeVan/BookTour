<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\BookingConfirmedEvent' => [
            'App\Listeners\SendBookingConfirmationNotification',
            'App\Listeners\UpdateTourAvailability',
        ],
        'App\Events\PaymentCompletedEvent' => [
            'App\Listeners\SendPaymentSuccessNotification',
            'App\Listeners\UpdateBookingStatus',
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
} 