<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //

    function country_info(){
        return $this->belongsTo(Country::class,'country_id');
    }

    function city_info(){
        return $this->belongsTo(City::class,'city_id');
    }
}
