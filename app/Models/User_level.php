<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_level extends Model
{
    protected $table = 'user_level';
	protected $fillable = ['level_name','status','created_at','updated_at'];

	public static function change($userID,$data){
        $isUpdated = false;
        $table_users_level = \DB::table('user_level');
        if(!empty($data)){
            $table_users_level->where('id','=',$userID);
            $isUpdated = $table_users_level->update($data); 
        }
        return (bool)$isUpdated;
    }
}
