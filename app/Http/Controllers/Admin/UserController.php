<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Users;
use App\Models\User_level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(Request $request, Builder $builder){
        $data['view'] = 'admin.user.list';
        $where = 'status != "trashed"';
        $where .= 'AND user_type != "super-admin"';
        $user  = _arefy(Users::list('array',$where));
       
        if ($request->ajax()) {
            return DataTables::of($user)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';

                $html   .= '<a href="'.url(sprintf('admin/users/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/users/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/users/status/?id=%s&status=inactive',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['first_name'].' status from Active to Inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a>';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/users/status/?id=%s&status=active',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/active-user.png').'"
                        data-ask="Would you like to change '.$item['first_name'].' status from Inactive to Active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('first_name',function($item){
                return ucfirst($item['first_name']);
            })
            ->editColumn('username',function($item){
                if(!empty($item['username'])){
                  return $item['username'];
                }else{
                  return 'N/A';
                }
            })
            // ->editColumn('user_type',function($item){
            //     if ($item['user_type'] = 'super-admin') {
            //         return 'Admin';
            //     }
            // })
            ->editColumn('user_level_id',function($item){
                return ucfirst($item['userlevel']['level_name']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'first_name', 'name' => 'first_name','title' => 'Users Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'username', 'name' => 'username','title' => 'Username','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'user_level_id','name' => 'user_level_id','title' => 'User Type','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'User E-mail','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'phone', 'name' => 'phone','title' => 'User Mobile','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function userlevellist(Request $request, Builder $builder){
        $data['view'] = 'admin.user.userlevellist';
        
        $userLevel  = _arefy(User_level::where('status','!=','trashed')->get());
       
        if ($request->ajax()) {
            return DataTables::of($userLevel)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                // $html   .= '<a href="'.url(sprintf('admin/setpermission/%s',___encrypt($item['id']))).'"  title="Set Permissions"><i class="fa fa-lock"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/userlevel/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('level_name',function($item){
                return ucfirst($item['level_name']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'level_name', 'name' => 'level_name','title' => 'Level Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function setPermissionList(Request $request,$id)
    {
        $id = ___decrypt($id);
        $data['view'] = 'admin.user.setpermission';
        $data['userlevel'] = _arefy(User_level::where('id',$id)->first());
        return view('admin.home',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['view'] = 'admin.user.add';
        $data['userlevel'] = _arefy(User_level::where('status','!=','trashed')->get());
        $data['get_user_menu']=_arefy(\DB::table('users_menu')->where(
            ['status' => 'active','menu_section' => 'sidebar',])->orderBy('menu_order','ASC')->get()->toArray());
        return view('admin.home',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = new Validations($request);
        $validator  = $validation->createUser();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $user = new Users;
            $request['password']            = Hash::make($request['password']);
            $request['remember_token']      =str_random(60).$request['remember_token'];
            $user->fill($request->all());

            $user->save();
            $menu['menu_visibility'] = json_encode($request->menu);
            $menu['user_id'] = $user->id;
            \DB::table('get_menu_visibility')->insert($menu);
            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "User has been Added successfully.";
            $this->redirect = url('admin/users');
        }
         return $this->populateresponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['view'] = 'admin.user.edit';
        $id = ___decrypt($id);
        $data['userlevel'] = _arefy(User_level::where('status','!=','trashed')->get());
        $data['user'] = _arefy(Users::where('id',$id)->first());
        $data['get_user_menu']=_arefy(\DB::table('users_menu')->where(
            ['status' => 'active','menu_section' => 'sidebar',])->orderBy('menu_order','ASC')->get()->toArray());
        $data['menu']=_arefy(\DB::table('users_menu')->where(
            ['status' => 'active','menu_section' => 'sidebar',])->orderBy('menu_order','ASC')->get()->toArray());
        $data['visible_menu']=_arefy(\DB::table('get_menu_visibility')->where(
            ['user_id' => $id])->first());
        return view('admin.home',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = ___decrypt($id);
        $validation = new Validations($request);
        $validator  = $validation->createUser('edit');
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }
        else{
            $users = Users::findOrFail($id);
            $request['remember_token']      = str_random(60).$request['remember_token'];
            $data = $request->all();
            $users->update($data);

            $menu['menu_visibility'] = json_encode($request->menu);
            \DB::table('get_menu_visibility')->where('user_id',$id)->update($menu);
            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "User has been Updated successfully.";
            $this->redirect = url('admin/users');
        }
        return $this->populateresponse();
    }

    public function createUserLevel()
    {
        $data['view'] = 'admin.user.userleveladd';
        return view('admin.home',$data);
    }

    public function userLevel(Request $request)
    {
        $validation = new Validations($request);
        $validator  = $validation->createUserLevel();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $userLevel = new User_level;
            $userLevel->fill($request->all());

            $userLevel->save();
           
            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "User Level has been Added successfully.";
            $this->redirect = url('admin/userlevel');
        }
         return $this->populateresponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Users::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Users successfully.';
            }else{
                $this->message = 'Updated Users successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }

    public function changeStatusUserLevel(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = User_level::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Users Level successfully.';
            }else{
                $this->message = 'Updated Users Level successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }
}
