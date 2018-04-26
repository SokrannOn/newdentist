<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
   public function currency(){
       return $this->belongsTo(Currency::class);
   }
}
