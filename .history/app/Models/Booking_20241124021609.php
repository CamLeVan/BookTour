<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tour_id',
        'user_id',
        'booking_date',
        'adults',
        'children',
        'notes',
        'total_amount',
        'total_price',
        'status',
        'payment_status',
        'payment_method',
        'transaction_id'
    ];

    protected $casts = [
        'booking_date' => 'datetime'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}