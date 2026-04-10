<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // 1. The Whitelist: Tell Laravel it is safe to save data to these columns
    protected $fillable = [
        'user_id',
        'court_name',
        'booking_date',
        'start_time',
        'end_time',
        'status',
    ];

    // 2. The Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}