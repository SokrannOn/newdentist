<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

}
