<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendingBooking extends Model
{
    protected $fillable = [
        'user_id',
        'tour_id',
        'booking_date',
        'adults',
        'children',
        'total_amount',
        'reference_code',
        'status',
        'notes',
        'expires_at'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'expires_at' => 'datetime',
        'adults' => 'integer',
        'children' => 'integer',
        'total_amount' => 'decimal:2'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    public function isExpired(): bool
    {
        return $this->expires_at < now() || $this->status === 'expired';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
}
