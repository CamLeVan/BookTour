<?php

namespace App\Jobs;

use App\Models\PendingBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExpirePendingBookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pendingBooking;

    public function __construct(PendingBooking $pendingBooking)
    {
        $this->pendingBooking = $pendingBooking;
    }

    public function handle(): void
    {
        if ($this->pendingBooking->status === 'pending') {
            $this->pendingBooking->update(['status' => 'expired']);
        }
    }
} 