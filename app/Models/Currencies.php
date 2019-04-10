<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    protected $table = 'currency';
    protected $fillable = ['currency_name','image','status','created_at','updated_at'];

    public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

    public static function change($userID,$data){
        $isUpdated = false;
        $table_currency = \DB::table('currency');
        if(!empty($data)){
            $table_currency->where('id','=',$userID);
            $isUpdated = $table_currency->update($data); 
        }
        return (bool)$isUpdated;
    }
}
