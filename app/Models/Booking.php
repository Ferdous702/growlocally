<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'business_name',
        'email',
        'phone',
        'service',
        'preferred_date',
        'preferred_time',
        'description',
        'status',
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];
}
