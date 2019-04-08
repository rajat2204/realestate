<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Make_Payment extends Model
{
    protected $table = 'deal_payment';
   	protected $fillable = ['deal_id','payment_plan_id','name','payment_type','amount','tax_id','tax_percent_id','taxable_amount','date','remarks','late_amount','cheque_no','bank_name','payable_amount','status','created_at','updated_at'];

   	public function invoice(){
        return $this->hasMany('App\Models\Deals_Payment','id','payment_plan_id');
    }
    public function tax_name(){
        return $this->hasOne('App\Models\Tax','id','tax_id');
    }
    public function tax_percent(){
        return $this->hasOne('App\Models\Tax_Percent','id','tax_percent_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-asc',$limit=''){
        $table_invoice = self::select($keys)
        ->with([
            'invoice' => function($q){
                $q->select('id','name');
            },
            'tax_name' => function($q){
                $q->select('id','name');
            },
            'tax_percent' => function($q){
                $q->select('id','percentage');
            },
        ]);
        if($where){
            $table_invoice->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_invoice->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_invoice->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_invoice->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_invoice->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_invoice->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_invoice->get()->first();
        }else if($fetch === 'count'){
            return $table_invoice->get()->count();
        }else{
            return $table_invoice->limit($limit)->get();
        }
    }
}
