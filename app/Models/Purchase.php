<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';
   	protected $fillable = ['project_id','property_id','unit_id','seller_name','seller_address','seller_email','seller_mobile','area','price','balance','description','status','created_at','updated_at'];

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_purchase = \DB::table('purchase');
        if(!empty($data)){
            $table_purchase->where('id','=',$userID);
            $isUpdated = $table_purchase->update($data); 
        }
        return (bool)$isUpdated;
    }

    public function project(){
        return $this->hasOne('App\Models\Project','id','project_id');
    }

    public function property(){
        return $this->hasOne('App\Models\Property','id','property_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_purchase = self::select($keys)
        ->with([
            'project' => function($q){
                $q->select('id','name');
            },
            'property' => function($q){
                $q->select('id','name','featured_image');
            },
        ]);
        if($where){
            $table_purchase->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_purchase->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_purchase->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_purchase->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_purchase->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_purchase->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_purchase->get()->first();
        }else if($fetch === 'count'){
            return $table_purchase->get()->count();
        }else{
            return $table_purchase->limit($limit)->get();
        }
    }
}
