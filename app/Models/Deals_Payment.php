<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deals_Payment extends Model
{
    protected $table = 'deal_payment_plan';
    protected $fillable = ['deal_id','client_id','property_id','invoice_no','name','amount','date','status','payment_status','created_at','updated_at'];

    public function client(){
        return $this->hasOne('App\Models\Clients','id','client_id');
    }
    public function property(){
        return $this->hasOne('App\Models\Property','id','property_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit='',$featured=''){
        $table_plots = self::select($keys)
        ->with([
            'client' => function($q){
                $q->select('id','name','phone');
            },
            'property' => function($q){
                $q->select('id','name');
            },
        ]);
        if($where){
            $table_plots->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_plots->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_plots->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_plots->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_plots->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_plots->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_plots->get()->first();
        }else if($fetch === 'count'){
            return $table_plots->get()->count();
        }else{
            return $table_plots->limit($limit)->get();
        }
    }
}
