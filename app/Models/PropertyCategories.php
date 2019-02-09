<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCategories extends Model
{
    protected $table = 'property_categories';
    protected $fillable = ['name','slug','status','created_at','updated_at'];
}
