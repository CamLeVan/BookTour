<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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