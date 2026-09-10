<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingBooking extends Model
{
    protected $fillable = [
        'tour_id',
        'user_id',
        'reference_code',
        'booking_date',
        'adults',
        'children',
        'notes',
        'total_amount',
        'expires_at'
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'expires_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function isExpired()
    {
        return now()->gt($this->expires_at);
    }

    public function generateReferenceCode()
    {
        return 'TOUR' . strtoupper(uniqid());
    }
} 