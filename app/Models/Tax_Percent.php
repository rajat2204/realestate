<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax_Percent extends Model
{
    protected $table = 'tax_percent';
   	protected $fillable = ['tax_id','percentage','status','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_tax_percent = \DB::table('tax_percent');
        if(!empty($data)){
            $table_tax_percent->where('id','=',$userID);
            $isUpdated = $table_tax_percent->update($data); 
        }
        return (bool)$isUpdated;
    }
    
   	public function taxname(){
        return $this->hasOne('App\Models\Tax','id','tax_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc'){
        $table_percent = self::select($keys)
        ->with([
            'taxname' => function($q){
                $q->select('id','name');
            },
        ]);
        if($where){
            $table_percent->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_percent->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_percent->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_percent->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_percent->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_percent->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_percent->get()->first();
        }else if($fetch === 'count'){
            return $table_percent->get()->count();
        }else{
            return $table_percent->limit($limit)->get();
        }
    }
}
