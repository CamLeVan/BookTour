<?php

namespace App\Console\Commands;

use App\Models\PendingBooking;
use Illuminate\Console\Command;

class CleanupExpiredBookings extends Command
{
    protected $signature = 'bookings:cleanup';
    protected $description = 'Cleanup expired pending bookings';

    public function handle()
    {
        PendingBooking::where('status', 'pending')
            ->where('expires_at', '<', now())
            ->update(['status' => 'expired']);

        $this->info('Expired bookings cleaned up successfully.');
    }
} 