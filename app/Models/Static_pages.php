<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Static_pages extends Model
{
    protected $table = 'static_pages';
    protected $fillable = ['title','slug','image' ,'description','status','created_at','updated_at'];
}
