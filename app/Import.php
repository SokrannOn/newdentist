<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    public  function products(){
        return $this->belongsToMany(Product::class,'import_product','import_id','product_id')->withTimestamps()->withPivot('qty', 'landingPrice', 'mfd', 'expd');
    }

    public function supplier(){
        return $this->belongsTo(Supply::class,'supplier_id');
    }
    public function histories(){
        return $this->hasMany(History::class,'import_id','id');
    }
}
