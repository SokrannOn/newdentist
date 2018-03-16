<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatmentprocedure extends Model
{
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    public function treatment(){
        return $this->belongsTo(Treatment::class);
    }
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
}
