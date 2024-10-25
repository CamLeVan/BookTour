<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    //
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'schedule', 'available_slots', 'start_date', 'end_date', 'operator_id', 'status'];
}
