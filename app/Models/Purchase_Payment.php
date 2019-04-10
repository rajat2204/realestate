<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase_Payment extends Model
{
    protected $table = 'purchase_payment';
   	protected $fillable = ['amount','purchase_id','date','payment_type','remarks','status','created_at','updated_at'];

   	public static function checkdate1()
    {


       $test =  \DB::raw('SELECT *
        FROM purchase_payment
        WHERE MONTH(date) = MONTH(CURRENT_DATE())
        AND YEAR(date) = YEAR(CURRENT_DATE())')->get();
       DD($test);
        // \DB::table('purchase')->select([
        //     DB::raw('YEAR(SalesDate) [Year]'),
        // ])->where()->get();
    } 
}
