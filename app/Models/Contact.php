<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contactaddress';
    protected $fillable = ['address','email','phone','status','created_at','updated_at'];
}
