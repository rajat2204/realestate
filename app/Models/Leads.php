<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    protected $table = 'lead';
    protected $fillable = ['property_id','email','name','phone','available','address','followup','remarks','status','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_leads = \DB::table('lead');
        if(!empty($data)){
            $table_leads->where('id','=',$userID);
            $isUpdated = $table_leads->update($data); 
        }
        return (bool)$isUpdated;
    }

    public function property(){
        return $this->hasOne('App\Models\Property','id','property_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-asc',$limit=''){
        $table_leads = self::select($keys)
        ->with([
            'property' => function($q){
                $q->select('id','name');
            },
        ]);
        if($where){
            $table_leads->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_leads->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_leads->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_leads->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_leads->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_leads->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_leads->get()->first();
        }else if($fetch === 'count'){
            return $table_leads->get()->count();
        }else{
            return $table_leads->limit($limit)->get();
        }
    }
}
