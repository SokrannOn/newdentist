<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requestpro extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_requestpro')->withTimestamps()->withPivot('qty','user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
