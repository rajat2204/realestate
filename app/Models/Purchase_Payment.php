<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase_Payment extends Model
{
    protected $table = 'purchase_payment';
   	protected $fillable = ['amount','purchase_id','date','payment_type','remarks','status','created_at','updated_at'];
}
