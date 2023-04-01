<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'website_url',
        'owner',
        'bookable',
    ];

     /**
      * Relation to Adress model
      *
      * @return object
      */
      public function addresses(){
        return $this->hasMany(Address::class, 'venue_id','id');
    }

}
