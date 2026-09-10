<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tour;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'tour_id',
        'booking_date',
        'adults',
        'children', 
        'total_price',
        'notes',
        'status',
        'payment_status',
        'payment_method',
        'payment_id',
        'paid_at'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'paid_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}