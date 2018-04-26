<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctorpayment extends Model
{
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }
}
