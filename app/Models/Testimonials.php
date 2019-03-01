<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    protected $table = 'testimonials';
	protected $fillable = ['name','image','description','status','created_at','updated_at'];

	public static function change($userID,$data){
        $isUpdated = false;
        $table_testimonials = \DB::table('testimonials');
        if(!empty($data)){
            $table_testimonials->where('id','=',$userID);
            $isUpdated = $table_testimonials->update($data); 
        }
        return (bool)$isUpdated;
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_testimonials = self::select($keys);
        if($where){
            $table_testimonials->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_testimonials->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_testimonials->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_testimonials->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_testimonials->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_testimonials->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_testimonials->get()->first();
        }else if($fetch === 'count'){
            return $table_testimonials->get()->count();
        }else{
            return $table_testimonials->limit($limit)->get();
        }
    }
}
