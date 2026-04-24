<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // 1. The Whitelist: Tell Laravel it is safe to save data to these columns
    protected $fillable = [
        'reference_number',
          'user_id',
        'court_id',
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

    // Relationship: A booking belongs to a Court
    // This is the one missing in your error!
    public function court()
    {
        return $this->belongsTo(Court::class);
    }
}