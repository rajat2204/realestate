<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
  protected $table = 'vendor';
  protected $fillable = ['name','address','contact','licence_no','status','created_at','updated_at'];

  public static function change($userID,$data){
        $isUpdated = false;
        $table_vendor = \DB::table('vendor');
        if(!empty($data)){
            $table_vendor->where('id','=',$userID);
            $isUpdated = $table_vendor->update($data); 
        }
        return (bool)$isUpdated;
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit='',$featured=''){
        $table_vendors = self::select($keys);
        if($where){
            $table_vendors->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_vendors->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_vendors->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_vendors->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_vendors->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_vendors->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_vendors->get()->first();
        }else if($fetch === 'count'){
            return $table_vendors->get()->count();
        }else{
            return $table_vendors->limit($limit)->get();
        }
    }
}
