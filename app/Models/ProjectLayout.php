<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLayout extends Model
{
   	protected $table = 'project_layout';
   	protected $fillable = ['project_id','images','status','created_at','updated_at'];
}
