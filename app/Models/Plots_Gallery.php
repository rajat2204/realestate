<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plots_Gallery extends Model
{
	protected $table = 'plot_gallery';
	protected $fillable = ['plot_id','images','created_at','updated_at'];
}
