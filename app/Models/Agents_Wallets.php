<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agents_Wallets extends Model
{
    protected $table = 'agents_wallet';
   	protected $fillable = ['agents_id	','name	','email','mobile','balance','action','remarks','status','created_at','updated_at'];

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_agent = \DB::table('agents_wallet');
        if(!empty($data)){
            $table_agent->where('id','=',$userID);
            $isUpdated = $table_agent->update($data); 
        }
        return (bool)$isUpdated;

}
