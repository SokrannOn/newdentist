<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    public function treatment(){
        return $this->belongsTo(Treatment::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('id','des','qty','price','amount');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
