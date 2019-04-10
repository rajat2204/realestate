<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory_balance extends Model
{
    protected $table = 'inventory_balance';
    protected $fillable = ['inventory_id','qty','date','remarks','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_inventory_entry = \DB::table('inventory_balance');
        if(!empty($data)){
            $table_inventory_entry->where('id','=',$userID);
            $isUpdated = $table_inventory_entry->update($data); 
        }
        return (bool)$isUpdated;
    }
}
