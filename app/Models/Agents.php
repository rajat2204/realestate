<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
   	protected $table = 'agent';
   	protected $fillable = ['name','image','designation','status','created_at','updated_at'];

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_agent = \DB::table('agent');
        if(!empty($data)){
            $table_agent->where('id','=',$userID);
            $isUpdated = $table_agent->update($data); 
        }
        return (bool)$isUpdated;
    }
}