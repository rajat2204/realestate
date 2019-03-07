<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';
    protected $fillable = ['project_id','category_id','vendor_id','invoice_no','invoice_date','amount','remarks','status','created_at','updated_at'];

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_expense = \DB::table('expense');
        if(!empty($data)){
            $table_expense->where('id','=',$userID);
            $isUpdated = $table_expense->update($data); 
        }
        return (bool)$isUpdated;
    }

    public function project(){
        return $this->hasOne('App\Models\Project','id','project_id');
    }

    public function expensecategory(){
        return $this->hasOne('App\Models\ExpenseCategory','id','category_id');
    }

    public function vendor(){
        return $this->hasOne('App\Models\Vendor','id','vendor_id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_expenses = self::select($keys)
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
            $table_expenses->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_expenses->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_expenses->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_expenses->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_expenses->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_expenses->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_expenses->get()->first();
        }else if($fetch === 'count'){
            return $table_expenses->get()->count();
        }else{
            return $table_expenses->limit($limit)->get();
        }
    }
}
