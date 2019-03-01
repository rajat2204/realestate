<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';
    protected $fillable = ['image','title','description','status','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_service = \DB::table('services');
        if(!empty($data)){
            $table_service->where('id','=',$userID);
            $isUpdated = $table_service->update($data); 
        }
        return (bool)$isUpdated;
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-asc',$limit=''){
        $table_service = self::select($keys);
        if($where){
            $table_service->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_service->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_service->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_service->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_service->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_service->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_service->get()->first();
        }else if($fetch === 'count'){
            return $table_service->get()->count();
        }else{
            return $table_service->limit($limit)->get();
        }
    }
}
