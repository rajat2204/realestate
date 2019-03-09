<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense_Payment extends Model
{
    protected $table = 'expense_payment';
   	protected $fillable = ['expense_id','payment_type','amount','date','remarks','created_at','updated_at'];
}
