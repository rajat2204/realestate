<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = 'client';
   	protected $fillable = ['name','email','phone','password','father_name','address','district','state','pincode','nationality','pan','dob','occupation','photo','id_proof','address_proof','status','created_at','updated_at'];
}
