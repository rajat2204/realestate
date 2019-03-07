<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLocationMap extends Model
{
    protected $table = 'project_location';
   	protected $fillable = ['project_id','images','status','created_at','updated_at'];
}