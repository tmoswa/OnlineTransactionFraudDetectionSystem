<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AccountHolder;

class Transaction extends Model
{
    //
    protected $fillable=[
        'account_number','otp','longitude','latitude','description','amount','transaction_date',
        'transaction_time','status','ip_address',
    ];

    public function accountholder(){
        return $this->belongsTo('App\AccountHolder');
    }
}

