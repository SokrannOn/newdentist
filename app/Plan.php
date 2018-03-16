<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //

    public function treatments(){
        return $this->belongsToMany(Treatment::class)->withTimestamps()->withPivot('teeNo','qty','price','amount','appointment_id');
    }
    public function prescriptions(){
        return $this->hasMany(Prescription::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function Treatmentprocedures(){
        return $this->hasMany(Treatmentprocedure::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }

}
