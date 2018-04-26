<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{


    public function treatmenttype(){

        return $this->belongsTo(Treatmenttype::class);
    }
    public function plans(){
        return $this->belongsToMany(Plan::class)->withTimestamps()->withPivot('teeNo','qty','price','proUnit','amount','appointment_id');
    }
}
