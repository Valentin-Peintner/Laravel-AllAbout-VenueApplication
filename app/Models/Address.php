<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'city',
        'zip',
        'country_id',
        'venue_id',
    ];

    public $timestamps = false;

     /**
     * Relation to User Model
     * 
     * @return
     */
    public function venue(){
        return $this->belongsTo(Venue::class,'venue_id','id');
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
