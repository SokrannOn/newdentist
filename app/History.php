<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';
    protected $fillable=['import_id','product_id','qty','landingPrice','mfd','expd'];

    public function import(){
        return $this->belongsTo(Import::class,'import_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
