<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Make_Payment extends Model
{
    protected $table = 'deal_payment';
   	protected $fillable = ['deal_id','name','payment_type','amount','tax_id','tax_percent_id','taxable_amount','date','remarks','late_amount','cheque_no','bank_name','payable_amount','status','created_at','updated_at'];
}
