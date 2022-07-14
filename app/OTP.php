<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    //
    protected $fillable=[
        'account_number','otp',
    ];
}
