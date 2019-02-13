<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    protected $table = 'testimonials';
	protected $fillable = ['name','image','description','status','created_at','updated_at'];

	public static function change($userID,$data){
        $isUpdated = false;
        $table_testimonials = \DB::table('testimonials');
        if(!empty($data)){
            $table_testimonials->where('id','=',$userID);
            $isUpdated = $table_testimonials->update($data); 
        }
        return (bool)$isUpdated;
    }
}
