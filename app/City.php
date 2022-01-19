<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    function Country_info(){
        return $this->belongsTo(Country::class,'Country_id');
    }
}
