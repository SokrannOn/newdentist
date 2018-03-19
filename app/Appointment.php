<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function treatmentprocedure(){
        return $this->hasOne(Treatmentprocedure::class);
    }
}
