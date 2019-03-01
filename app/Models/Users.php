<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users_realestate';
    protected $fillable = ['first_name','last_name','email','phone_code','phone','password','user_type','remember_token','status','created_at','updated_at'];

    public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }
}
