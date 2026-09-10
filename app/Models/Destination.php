<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status'
    ];

    /**
     * Scope a query to only include active destinations.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}