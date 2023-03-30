<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['country'];


    /**
     * Relation to Adress model
     * 
     * @return
     */
    public function adresses(){
        return $this->hasMany(Adress::class,'country_id','id');
    }
}
