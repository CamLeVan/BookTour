<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'name',
        'duration',
        'price',
        'max_people',
        'location',
        'image'
    ];
}
