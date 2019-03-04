<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_Gallery extends Model
{
	protected $table = 'property_gallery';
	protected $fillable = ['plot_id','images','created_at','updated_at'];

	public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_gallery = self::select($keys);
        if($where){
            $table_gallery->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_gallery->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_gallery->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_gallery->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_gallery->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_gallery->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_gallery->get()->first();
        }else if($fetch === 'count'){
            return $table_gallery->get()->count();
        }else{
            return $table_gallery->limit($limit)->get();
        }
    }
}
