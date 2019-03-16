<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
	protected $table = 'deal';
	protected $fillable = ['client_id','project_id','property_id','plan_id','agent_id','invoice_no','unit_id','date','area','amount','balance','discount','payment_method','remarks','status','created_at','updated_at'];


    public static function change($userID,$data){
        $isUpdated = false;
        $table_deal = \DB::table('deal');
        if(!empty($data)){
            $table_deal->where('id','=',$userID);
            $isUpdated = $table_deal->update($data); 
        }
        return (bool)$isUpdated;
    }

    public function agent(){
        return $this->hasOne('App\Models\Agents','id','agent_id');
    }

    public function client(){
        return $this->hasOne('App\Models\Clients','id','client_id');
    }

    public function property(){
        return $this->hasOne('App\Models\Property','id','property_id');
    }

    public function project(){
        return $this->hasOne('App\Models\Project','id','project_id');
    }

    public function plan(){
        return $this->hasOne('App\Models\Plans','id','plan_id');
    }
    public function units(){
        return $this->hasOne('App\Models\Units','id','unit_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_deal = self::select($keys)
        ->with([
            'agent' => function($q){
                $q->select('id','name');
            },
            'project' => function($q){
                $q->select('id','name');
            },
            'client' => function($q){
                $q->select('id','name');
            },
            'property' => function($q){
                $q->select('id','name','property_construct');
            },
            'plan' => function($q){
                $q->select('id','name','installment');
            },
            'units' => function($q){
                $q->select('id','name');
            },
        ]);
        if($where){
            $table_deal->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_deal->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_deal->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_deal->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_deal->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_deal->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_deal->get()->first();
        }else if($fetch === 'count'){
            return $table_deal->get()->count();
        }else{
            return $table_deal->limit($limit)->get();
        }
    }
}