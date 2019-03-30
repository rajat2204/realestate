<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $table = 'unit';
    protected $fillable = ['name','status','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_units = \DB::table('unit');
        if(!empty($data)){
            $table_units->where('id','=',$userID);
            $isUpdated = $table_units->update($data); 
        }
        return (bool)$isUpdated;
    }
}
