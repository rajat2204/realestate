<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImages extends Model
{
    protected $table = 'project_images';
   	protected $fillable = ['project_id','images','status','created_at','updated_at'];
}
