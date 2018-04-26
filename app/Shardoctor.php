<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shardoctor extends Model
{
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    public function treatment(){
        return $this->belongsTo(Treatment::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
