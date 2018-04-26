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
        return $this->hasMany(History::class);
    }
    public function prescriptions(){
        return $this->belongsToMany(Prescription::class)->withTimestamps()->withPivot('id','des','qty','price','amount');
    }
    public function stockouts(){
        return $this->belongsToMany(Stockout::class)->withTimestamps()->withPivot('id','qty','expd');
    }
    public function tmprequestpro(){
        return $this->hasMany(Tmprequestpro::class,'product_id', 'id');
    }
    public function requestpros()
    {
        return $this->belongsToMany(Requestpro::class,'product_requestpro')->withTimestamps()->withPivot('qty','user_id');
    }
}
