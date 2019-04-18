<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth

{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty(\Auth::user())){
            return redirect('admin/login');
        }
       /* if(\Auth::user()->user_type!='super-admin'){
            $id = \Auth::user()->id;
            $get_user_menu=_arefy(\DB::table('users_menu')->where(
            ['status' => 'active','menu_section' => 'sidebar',])->orderBy('menu_order','ASC')->get()->toArray());
            $visible_menu=_arefy(\DB::table('get_menu_visibility')->where(
            ['user_id' => $id])->first());

            if(!empty($get_user_menu)):
                foreach($get_user_menu as $menu):
           //dd(in_array($menu['id'],json_decode($visible_menu['menu_visibility'])));
                    if(!in_array($menu['id'],json_decode($visible_menu['menu_visibility']))):
                         return redirect('admin/home');
                    endif;
                endforeach;
            endif;
        }*/
        return $next($request);
    }
}
