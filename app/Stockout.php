<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stockout extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('id','qty','expd');
    }
}
