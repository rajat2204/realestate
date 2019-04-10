<?php

namespace App\Http\Controllers\Admin;

use App\Models\Static_pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class StaticController extends Controller
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
        $data['view'] = 'admin.staticpages.list';
        
        $static  = _arefy(Static_pages::where('status','!=','trashed')->get());
       
        if ($request->ajax()) {
            return DataTables::of($static)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/static_pages/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('title',function($item){
                return ucfirst($item['title']);
            })
            ->editColumn('description',function($item){
                return strip_tags(str_limit(($item['description']),50));
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'title', 'name' => 'title','title' => 'Title','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'slug','name' => 'slug','title' => 'Slug','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'description','name' => 'description','title' => 'Description','orderable' => false, 'width' => 120])
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data['view'] = 'admin.staticpages.edit';
        $id = ___decrypt($id);
        $data['staticpage'] = _arefy(Static_pages::where('id',$id)->first());
        return view('admin.home',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      $id = ___decrypt($id);
      $validation = new Validations($request);
      $validator  = $validation->staticpage('edit');
      if ($validator->fails()) {
          $this->message = $validator->errors();
      }else{
          $staticpage = Static_pages::findOrFail($id);
          $input = $request->all();

          if ($file = $request->file('image')){
            $photo_name = str_random(3).$request->file('image')->getClientOriginalName();
            $file->move('assets/img/staticpage',$photo_name);
            $input['image'] = $photo_name;
          }

          $staticpage->update($input);

          $this->status   = true;
          $this->modal    = true;
          $this->alert    = true;
          $this->message  = "Static Page has been Updated successfully.";
          $this->redirect = url('admin/static_pages');
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
}
