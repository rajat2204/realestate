<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';
    protected $fillable = ['project_id','expense_category_id','vendor_id','invoice_no','invoice_date','quantity','remarks','status','created_at','updated_at'];

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_inventory = \DB::table('inventory');
        if(!empty($data)){
            $table_inventory->where('id','=',$userID);
            $isUpdated = $table_inventory->update($data); 
        }
        return (bool)$isUpdated;
    }

    public function project(){
        return $this->hasOne('App\Models\Project','id','project_id');
    }

    public function expensecategory(){
        return $this->hasOne('App\Models\ExpenseCategory','id','expense_category_id');
    }

    public function vendor(){
        return $this->hasOne('App\Models\Vendor','id','vendor_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_inventories = self::select($keys)
        ->with([
            'project' => function($q){
                $q->select('id','name');
            },
            'expensecategory' => function($q){
                $q->select('id','name');
            },
            'vendor' => function($q){
                $q->select('id','name');
            },
        ]);
        if($where){
            $table_inventories->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_inventories->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_inventories->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_inventories->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_inventories->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_inventories->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_inventories->get()->first();
        }else if($fetch === 'count'){
            return $table_inventories->get()->count();
        }else{
            return $table_inventories->limit($limit)->get();
        }
    }
}
