<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{


    public function treatmenttype(){

        return $this->belongsTo(Treatmenttype::class);
    }
}
