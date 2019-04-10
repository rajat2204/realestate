<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_Enquiry extends Model
{
    protected $table = 'propertyenquiry';
	protected $fillable = ['property_id','name','email','mobile','status','created_at','updated_at'];

	public static function add($data){
        if(!empty($data)){
            return self::insertGetId($data);
        }else{
            return false;
        }   
    }

    public static function change($userID,$data){
        $isUpdated = false;
        $table_property_enquiry = \DB::table('propertyenquiry');
        if(!empty($data)){
            $table_property_enquiry->where('id','=',$userID);
            $isUpdated = $table_property_enquiry->update($data); 
        }
        return (bool)$isUpdated;
    }

    public function property(){
        return $this->hasOne('App\Models\Property','id','property_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit='',$featured=''){
        $table_property = self::select($keys)
        ->with([
            'property' => function($q){
                $q->select('id','name','featured_image','property_construct','location','price','property_purpose');
            },
        ]);
        if($where){
            $table_property->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_property->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_property->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_property->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_property->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_property->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_property->get()->first();
        }else if($fetch === 'count'){
            return $table_property->get()->count();
        }else{
            return $table_property->limit($limit)->get();
        }
    }
}
