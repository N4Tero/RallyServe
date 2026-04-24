<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'name',      // Make sure this is 'name', NOT 'title'
    'start_date',
    'end_date',
    'format',
    'description',
    ];
}
