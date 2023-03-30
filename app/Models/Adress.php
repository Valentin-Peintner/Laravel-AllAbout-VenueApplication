<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'city',
        'zip',
        'country_id',
        'e_locations_id',
    ];

     /**
     * Relation to User Model
     * 
     * @return
     */
    public function eventLocation(){
        return $this->belongsTo(EventLocation::class,'e_locations_id','id');
    }

     /**
     * Relation to Country Model
     * 
     * @return
     */
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
