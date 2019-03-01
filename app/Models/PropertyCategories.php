<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCategories extends Model
{
    protected $table = 'property_categories';
    protected $fillable = ['name','slug','status','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_category = \DB::table('property_categories');
        if(!empty($data)){
            $table_category->where('id','=',$userID);
            $isUpdated = $table_category->update($data); 
        }
        return (bool)$isUpdated;
    }
}
