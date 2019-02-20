<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $table = 'sliders';
    protected $fillable = ['image','title','slug','description','position','mobile','location','latitude','longitude','status','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_slider = \DB::table('sliders');
        if(!empty($data)){
            $table_slider->where('id','=',$userID);
            $isUpdated = $table_slider->update($data); 
        }
        return (bool)$isUpdated;
    }
}
