<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    // 1. Allows these columns to be saved to the database
    protected $fillable = ['facility_id', 'court_name', 'surface_type', 'hourly_rate', 'status'];

    // A court belongs to a facility
    public function facility() {
        return $this->belongsTo(Facility::class);
    }

    // 2. Establish the Relationship (One Court has Many Bookings)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
