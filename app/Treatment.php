<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{


    public function treatmenttype(){

        return $this->belongsTo(Treatmenttype::class);
    }
<<<<<<< HEAD
    public function prescriptions(){

        return $this->hasMany(Prescription::class);
=======
    public function plans(){
        return $this->belongsToMany(Plan::class)->withTimestamps()->withPivot('teeNo','qty','price','proUnit','amount','appointment_id');
>>>>>>> e379c499e4e5418c423cfbcf98364ebfffc9e88c
    }
}
