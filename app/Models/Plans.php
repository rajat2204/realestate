<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $table = 'plan';
   	protected $fillable = ['name','installment','status','created_at','updated_at'];

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_plan = \DB::table('plan');
        if(!empty($data)){
            $table_plan->where('id','=',$userID);
            $isUpdated = $table_plan->update($data); 
        }
        return (bool)$isUpdated;
    }
}
