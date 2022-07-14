<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExistingAccount extends Model
{
    //
    protected $fillable=[
        'acc_number',
        'national_id',
        'phone_number',
        'email'
    ];
}
