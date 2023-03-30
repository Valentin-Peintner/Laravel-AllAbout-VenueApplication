<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
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
      public function adresses(){
        return $this->hasMany(Adress::class, 'e_locations_id','id');
    }

}
