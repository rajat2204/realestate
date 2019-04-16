<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiry';
    protected $fillable = ['user_id','slider_name','slider_contact','description','location','customer_name','customer_contact','email','message','status','created_at','updated_at'];

    public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

    public static function change($userID,$data){
        $isUpdated = false;
        $table_enquiry = \DB::table('enquiry');
        if(!empty($data)){
            $table_enquiry->where('id','=',$userID);
            $isUpdated = $table_enquiry->update($data); 
        }
        return (bool)$isUpdated;
    }
}
