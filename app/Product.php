<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pricelists(){
        return $this->hasMany(Pricelist::class);
    }
    public  function imports(){
        return $this->belongsToMany(Import::class,'import_product','import_id','product_id')->withTimestamps()->withPivot('qty', 'landingPrice', 'mfd', 'expd');
    }
    public function tmpimports(){
        return $this->hasMany(Tmpimport::class);
    }
    public function histories(){
        return $this->hasMany(History::class,'product_id', 'id');
    }
}
