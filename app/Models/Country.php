<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['country'];
    public $timestamps = false;

    /**
     * Relation to Adress model
     * 
     * @return
     */
    public function addresses(){
        return $this->hasMany(Address::class,'country_id','id');
    }
}
