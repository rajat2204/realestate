<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiry';
    protected $fillable = ['slider_name','slider_contact','description','location','customer_name','customer_contact','email','message','status','created_at','updated_at'];

    public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }
}
