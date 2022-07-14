<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;
class AccountHolder extends Model
{
    //
    protected $fillable =[
        'first_name','last_name','account_number','account_type','national_id','email','secret','country',
        'pin_code','one_time_password','spending_category','longitude','latitude','status','balance','phone_number'
    ];

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }
}

