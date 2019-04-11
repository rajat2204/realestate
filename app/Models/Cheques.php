<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cheques extends Model
{
    protected $table = 'cheques';
    protected $fillable = ['client_id','property_id','deal_id','payment_plan_id','invoice_no','name','cheque_no','bank_name','status','amount','created_at','updated_at'];

    public function invoice(){
        return $this->hasMany('App\Models\Deals_Payment','id','payment_plan_id');
    }
    public function client(){
        return $this->hasOne('App\Models\Clients','id','client_id');
    }
    public function property(){
        return $this->hasOne('App\Models\Property','id','property_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-asc',$limit=''){
        $table_cheques = self::select($keys)
        ->with([
            'invoice' => function($q){
                $q->select('id','name');
            },
            'client' => function($q){
                $q->select('id','name','phone');
            },
            'property' => function($q){
                $q->select('id','name');
            },
        ]);
        if($where){
            $table_cheques->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_cheques->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_cheques->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_cheques->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_cheques->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_cheques->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_cheques->get()->first();
        }else if($fetch === 'count'){
            return $table_cheques->get()->count();
        }else{
            return $table_cheques->limit($limit)->get();
        }
    }
}
