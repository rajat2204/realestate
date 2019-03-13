<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deals;
use App\Models\Agents;
use App\Models\Clients;
use App\Models\Property;
use App\Models\Plans;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class DealsController extends Controller
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
        $data['view'] = 'admin.deals.list';

        $where = 'status != "trashed"';
        $deals  = _arefy(Deals::list('array',$where));
       
        if ($request->ajax()) {
            return DataTables::of($deals)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';

                $html   .= '<a href="'.url(sprintf('admin/deals/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/deals/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('name',function($item){
                return ucfirst($item['name']);
            })
            ->editColumn('balance',function($item){
                if($item['balance'] != NULL){
                  return 'Rs.'. ' ' .($item['balance']);
                }else{
                  return 'Rs.'. ' ' .'0';
                }
            })
            ->editColumn('image',function($item){
                $imageurl = asset("assets/img/agent/".$item['image']);
                return '<img src="'.$imageurl.'" height="100px" width="120px">';
            })
            ->rawColumns(['image','action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'image', 'name' => 'image',"render"=> 'data','title' => 'Agent Image','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Agent Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'Agent E-mail','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'mobile', 'name' => 'mobile','title' => 'Agent Mobile','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'address', 'name' => 'address','title' => 'Agent Address','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'designation', 'name' => 'designation','title' => 'Agent Designation','orderable' => false, 'width' => 120])
             ->addColumn(['data' => 'balance','name' => 'balance','title' => 'Balance','orderable' => false, 'width' => 120])           
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
        $data['view'] = 'admin.deals.add';
        $data['agent'] = _arefy(Agents::where('status','!=','trashed')->get());
        $data['client'] = _arefy(Clients::where('status','!=','trashed')->get());
        $data['property'] = _arefy(Property::where('status','!=','trashed')->get());
        $data['plan'] = _arefy(Plans::where('status','!=','trashed')->get());
        $data['project'] = _arefy(Project::where('status','!=','trashed')->get());
        // dd($data['project']);
        return view('admin.home',$data);
    }

    public function ajaxProperty(Request $request)
    {
      $id = $request->id;
      $property = Property::where('project_id',$id)->get();
      $propertyview = view('admin.template.ajaxproperty',compact('property'));

      return Response($propertyview);
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
        $validator  = $validation->addDeal();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data = new Deals();
            $data->fill($request->all());

            $data->save();

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Deal has been Added successfully.";
            $this->redirect = url('admin/deals');  
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
        //
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
        //
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
