<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deals_Payment extends Model
{
    protected $table = 'deal_payment';
    protected $fillable = ['deal_id','name','amount','date','status','created_at','updated_at'];
}
