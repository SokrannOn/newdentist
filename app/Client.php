<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function clienthises(){
        return $this->hasMany(Clienthis::class);
    }
    public function prescriptions(){
        return $this->hasMany(Prescription::class);
    }
}
