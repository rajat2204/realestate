<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
   	protected $fillable = ['name','slug','image','description','status','created_at','updated_at'];

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_company = \DB::table('company');
        if(!empty($data)){
            $table_company->where('id','=',$userID);
            $isUpdated = $table_company->update($data); 
        }
        return (bool)$isUpdated;
    }
}
