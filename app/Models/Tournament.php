<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'title', 
        'date_range', 
        'format', 
        'status', 
        'prize_details', 
        'registration_link'
    ];
}
