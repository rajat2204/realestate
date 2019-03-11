<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users_realestate';
    protected $fillable = ['first_name','last_name','username','email','phone_code','phone','password','user_type','remember_token','status','created_at','updated_at'];

    public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

    public static function change($userID,$data){
        $isUpdated = false;
        $table_users_realestate = \DB::table('users_realestate');
        if(!empty($data)){
            $table_users_realestate->where('id','=',$userID);
            $isUpdated = $table_users_realestate->update($data); 
        }
        return (bool)$isUpdated;
    }
}
