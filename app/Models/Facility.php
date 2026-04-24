<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
  protected $fillable = ['facility_name', 'address', 'contact_number', 'facility_image'];

    // A facility has many courts
    public function courts() {
        return $this->hasMany(Court::class);
    }
}
