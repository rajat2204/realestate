<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deals_Payment extends Model
{
    protected $table = 'deal_payment_plan';
    protected $fillable = ['deal_id','name','amount','date','status','created_at','updated_at'];
}
