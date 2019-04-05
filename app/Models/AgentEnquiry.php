<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentEnquiry extends Model
{
    protected $table = 'agent_enquiry';
    protected $fillable = ['agent_name','agent_contact','customer_name','customer_contact','email','message','interested','status','created_at','updated_at'];

    public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

    public static function change($userID,$data){
        $isUpdated = false;
        $table_agent_enquiry = \DB::table('agent_enquiry');
        if(!empty($data)){
            $table_agent_enquiry->where('id','=',$userID);
            $isUpdated = $table_agent_enquiry->update($data); 
        }
        return (bool)$isUpdated;
    }
}
