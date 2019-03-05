<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class ProjectController extends Controller
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
        $data['view'] = 'admin.projects.list';

        $where = 'status != "trashed"';
        $projects  = _arefy(Project::list('array',$where));
       
        if ($request->ajax()) {
            return DataTables::of($projects)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/project/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);"  
                        data-url="'.url(sprintf('admin/project/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/project/status/?id=%s&status=inactive',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['name'].' status from Active to Inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a>';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/project/status/?id=%s&status=active',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/active-user.png').'"
                        data-ask="Would you like to change '.$item['name'].' status from Inactive to Active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('name',function($item){
                return ucfirst($item['name']);
            })
            ->editColumn('price',function($item){
                return 'Rs.'. ' ' .number_format($item['price']);
            })
            ->editColumn('image',function($item){
                $imageurl = asset("assets/img/Projects/".$item['image']);
                return '<img src="'.$imageurl.'" height="70px" width="100px">';
            })
            ->editColumn('description',function($item){
                return str_limit(strip_tags($item['description']),50);
            })
            ->editColumn('company_id',function($item){
                return ucfirst($item['company']['name']);
            })
            ->rawColumns(['image','action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'image', 'name' => 'image',"render"=> 'data','title' => 'Project Image','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'company_id', 'name' => 'company_id','title' => 'Company Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Project Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'slug', 'name' => 'slug','title' => 'Project Slug','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'location', 'name' => 'location','title' => 'Project Location','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'price', 'name' => 'price','title' => 'Project Price','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'description', 'name' => 'description','title' => 'Project Description','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['view'] = 'admin.projects.add';
        $data['company'] = _arefy(Company::where('status', '=', 'active')->get());
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
        $validator  = $validation->createProject();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $project = new Project();
            $project->fill($request->all());

            if ($file = $request->file('image')){
                $photo_name = time().$request->file('image')->getClientOriginalName();
                $file->move('assets/img/Projects',$photo_name);
                $project['image'] = $photo_name;
            }
            $project->save();

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Project has been Added successfully.";
            $this->redirect = url('admin/project');
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
        $data['view'] = 'admin.projects.edit';
        $id = ___decrypt($id);
        $where = 'id = '.$id;
        $data['project'] = _arefy(Project::list('single',$where));
        $data['company'] = _arefy(Company::where('status', '=', 'active')->get());
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
      $validator  = $validation->createProject('edit');
      if ($validator->fails()) {
          $this->message = $validator->errors();
      }else{
          $projects = Project::findOrFail($id);
          $data = $request->all();

          if ($file = $request->file('image')){
            $photo_name = str_random(3).$request->file('image')->getClientOriginalName();
            $file->move('assets/img/Projects',$photo_name);
            $data['image'] = $photo_name;
          }
          $projects->update($data);

          $this->status   = true;
          $this->modal    = true;
          $this->alert    = true;
          $this->message  = "Project has been Updated successfully.";
          $this->redirect = url('admin/project');
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
        $isUpdated               = Project::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Project successfully.';
            }else{
                $this->message = 'Updated Project successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }
}
