<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function doctorpayments(){
        return $this->hasMany(Doctorpayment::class);
    }
}
