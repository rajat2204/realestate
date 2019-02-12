<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plots extends Model
{
    protected $table = 'plots';
    protected $fillable = ['name','slug','featured_image','price','location','property_type','bedrooms','area','description','key_points','status','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_plot = \DB::table('plots');
        if(!empty($data)){
            $table_plot->where('id','=',$userID);
            $isUpdated = $table_plot->update($data); 
        }
        return (bool)$isUpdated;
    }
}
