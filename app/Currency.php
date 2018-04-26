<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    public function exchanges(){
        return $this->hasMany(Exchange::class);
    }
    public function doctorpayments(){
        return $this->hasMany(Doctorpayment::class);
    }

}
