<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'tax';
   	protected $fillable = ['name','percentage','status','created_at','updated_at'];

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_company = \DB::table('tax');
        if(!empty($data)){
            $table_company->where('id','=',$userID);
            $isUpdated = $table_company->update($data); 
        }
        return (bool)$isUpdated;
    }
}
