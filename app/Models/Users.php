<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users_realestate';
    protected $fillable = ['first_name','last_name','user_level_id','username','email','phone_code','phone','password','user_type','remember_token','status','created_at','updated_at'];

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

    public function userlevel(){
        return $this->hasOne('App\Models\User_level','id','user_level_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_users = self::select($keys)
        ->with([
            'userlevel' => function($q){
                $q->select('id','level_name');
            },
        ]);
        if($where){
            $table_users->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_users->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_users->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_users->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_users->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_users->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_users->get()->first();
        }else if($fetch === 'count'){
            return $table_users->get()->count();
        }else{
            return $table_users->limit($limit)->get();
        }
    }
}
