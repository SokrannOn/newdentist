<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    protected $table= "transections";
    protected $fillable = ['batchID', 'transectionDate', 'transectionCode', 'chartaccount_id', 'typeaccount_id', 'drAmt', 'crAmt', 'runningBalance', 'Postamount', 'currency', 'exchangeRate', 'user_id'];

    public function chartaccount(){
        return $this->belongsTo(Chartaccount::class);
    }
}
