<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';
   	protected $fillable = ['name','slug','image','location','latitude','longitude','description','status','created_at','updated_at'];

   	public static function change($userID,$data){
        $isUpdated = false;
        $table_project = \DB::table('project');
        if(!empty($data)){
            $table_project->where('id','=',$userID);
            $isUpdated = $table_project->update($data); 
        }
        return (bool)$isUpdated;
    }

    public static function list($fetch='array',$where='',$keys=['*'],$order='id-desc',$limit=''){
        $table_projects = self::select($keys);
        if($where){
            $table_projects->whereRaw($where);
        }
                
        if(!empty($order)){
            $order = explode('-', $order);
            $table_projects->orderBy($order[0],$order[1]);
        }
        if (!empty($limit)) {
            $table_projects->limit($limit);
        }
        if($fetch === 'array'){
            $list = $table_projects->get();
            return json_decode(json_encode($list ), true );
        }
        elseif($fetch === 'paginate'){
            $list = $table_projects->paginate(1);
            return json_decode(json_encode($list ), true );
        }else if($fetch === 'obj'){
            return $table_projects->limit($limit)->get();                
        }else if($fetch === 'single'){
            return $table_projects->get()->first();
        }else if($fetch === 'count'){
            return $table_projects->get()->count();
        }else{
            return $table_projects->limit($limit)->get();
        }
    }
}
