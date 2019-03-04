<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contactus';
    protected $fillable = ['name','email','subject','number','message','status','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_leads = \DB::table('contactus');
        if(!empty($data)){
            $table_leads->where('id','=',$userID);
            $isUpdated = $table_leads->update($data); 
        }
        return (bool)$isUpdated;
    }

    public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }
}
