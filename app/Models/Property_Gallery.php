<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_Gallery extends Model
{
	protected $table = 'property_gallery';
	protected $fillable = ['plot_id','images','created_at','updated_at'];
}
