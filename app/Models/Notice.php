<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notice';
   	protected $fillable = ['text','slug','status','created_at','updated_at'];

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_notice = \DB::table('notice');
        if(!empty($data)){
            $table_notice->where('id','=',$userID);
            $isUpdated = $table_notice->update($data); 
        }
        return (bool)$isUpdated;
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_notice = self::select($keys);
        if($where){
            $table_notice->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_notice->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_notice->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_notice->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_notice->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_notice->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_notice->get()->first();
        }else if($fetch === 'count'){
            return $table_notice->get()->count();
        }else{
            return $table_notice->limit($limit)->get();
        }
    }
}
