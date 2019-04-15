<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = 'client';
   	protected $fillable = ['user_id','name','email','phone','password','father_name','address','latitude','longitude','district','state','pincode','nationality','pan','dob','occupation','photo','id_proof','address_proof','status','created_at','updated_at'];

    public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

    public static function changeDetail($userID,$data){
        $isUpdated = false;
        $table_client = \DB::table('client');
        if(!empty($data)){
            $table_client->where('user_id','=',$userID);
            $isUpdated = $table_client->update($data); 
        }
        return (bool)$isUpdated;
    }

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_client = \DB::table('client');
        if(!empty($data)){
            $table_client->where('id','=',$userID);
            $isUpdated = $table_client->update($data); 
        }
        return (bool)$isUpdated;
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_clients = self::select($keys);
        if($where){
            $table_clients->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_clients->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_clients->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_clients->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_clients->paginate(1);
            return json_decode(json_encode($list ), true );
            
        }else if($fetch === 'obj'){
            return $table_clients->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_clients->get()->first();
        }else if($fetch === 'count'){
            return $table_clients->get()->count();
        }else{
            return $table_clients->limit($limit)->get();
        }
    }
}
