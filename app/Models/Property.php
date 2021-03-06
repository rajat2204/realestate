<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'property';
    protected $fillable = ['project_id','category_id','company_id','unit_id','name','agent_id','slug','featured_image','price','location','pincode','latitude','longitude','property_type','property_construct','property_purpose','bedrooms','bathroom','garage','area','possession','description','key_points','status','deals','featured','created_at','updated_at'];

    public static function change($userID,$data){
        $isUpdated = false;
        $table_plot = \DB::table('property');
        if(!empty($data)){
            $table_plot->where('id','=',$userID);
            $isUpdated = $table_plot->update($data); 
        }
        return (bool)$isUpdated;
    }

    public function agent(){
        return $this->hasOne('App\Models\Agents','id','agent_id');
    }

    public function category(){
        return $this->hasOne('App\Models\PropertyCategories','id','category_id');
    }

    public function company(){
        return $this->hasOne('App\Models\Company','id','company_id');
    }

    public function project(){
        return $this->hasOne('App\Models\Project','id','project_id');
    }

    public function units(){
        return $this->hasOne('App\Models\Units','id','unit_id');
    }

    public function propertyGallery(){
        return $this->hasMany('App\Models\Property_Gallery','plot_id','id');
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit='',$featured=''){
        $table_plots = self::select($keys)
        ->with([
            'agent' => function($q){
                $q->select('id','name','image','phone');
            },
            'category' => function($q){
                $q->select('id','name');
            },
            'company' => function($q){
                $q->select('id','name','image','description');
            },
            'project' => function($q){
                $q->select('id','name');
            },
            'units' => function($q){
                $q->select('id','name');
            },
            'propertyGallery' => function($q){
                $q->select('plot_id','images');
            },
        ]);
        if($where){
            $table_plots->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_plots->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_plots->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_plots->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_plots->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_plots->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_plots->get()->first();
        }else if($fetch === 'count'){
            return $table_plots->get()->count();
        }else{
            return $table_plots->limit($limit)->get();
        }
    }
}
