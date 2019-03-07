<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $table = 'expense_category';
    protected $fillable = ['name','status','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_expense_category = \DB::table('expense_category');
        if(!empty($data)){
            $table_expense_category->where('id','=',$userID);
            $isUpdated = $table_expense_category->update($data);
        }
        return (bool)$isUpdated;
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_expense_categories = self::select($keys);
        if($where){
            $table_expense_categories->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_expense_categories->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_expense_categories->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_expense_categories->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_expense_categories->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_expense_categories->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_expense_categories->get()->first();
        }else if($fetch === 'count'){
            return $table_expense_categories->get()->count();
        }else{
            return $table_expense_categories->limit($limit)->get();
        }
    }
}
