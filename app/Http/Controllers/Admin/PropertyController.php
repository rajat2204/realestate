<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use App\Models\Company;
use App\Models\Project;
use App\Models\Agents;
use App\Models\Units;
use Illuminate\Http\Request;
use App\Models\Property_Gallery;
use App\Models\PropertyCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class PropertyController extends Controller
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
        $data['view'] = 'admin.property.list';

        $where = 'status != "trashed"';
        $property  = _arefy(Property::list('array',$where));
        if ($request->ajax()) {
            return DataTables::of($property)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/property/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/property/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/property/status/?id=%s&status=inactive',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['name'].' status from Active to Inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a>';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/property/status/?id=%s&status=active',$item['id'])).'" 
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
            ->editColumn('category_id',function($item){
                return ucfirst($item['category']['name']);
            })
            ->editColumn('agent_id',function($item){
                return ucfirst($item['agent']['name']);
            })
            ->editColumn('company_id',function($item){
                return ucfirst($item['company']['name']);
            })
            ->editColumn('name',function($item){
                return ucfirst(str_limit($item['name'],30));
            })
            ->editColumn('property_type',function($item){
                return ucfirst($item['property_type']);
            })
            ->editColumn('property_purpose',function($item){
                return ucfirst($item['property_purpose']);
            })
            ->editColumn('location',function($item){
                return ucfirst(str_limit($item['location'],30));
            })
            ->editColumn('price',function($item){
                if(!empty($item['price'])){
                    return 'Rs.'.' ' .number_format($item['price']);
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('property_type',function($item){
                if(!empty($item['property_type'])){
                    return ucfirst($item['property_type']);
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('area',function($item){
                if (!empty($item['area'])) {
                    return ($item['area']). ' ' . 'sq.ft.';                    
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('featured_image',function($item){
                $imageurl = asset("assets/img/properties/".$item['featured_image']);
                return '<img src="'.$imageurl.'" height="70px" width="100px">';
            })
            ->rawColumns(['featured_image','action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'featured_image', 'name' => 'featured_image',"render"=> 'data','title' => 'Property Image','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'category_id','name' => 'category_id','title' => 'Category','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'company_id','name' => 'company_id','title' => 'Company','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Property Name','orderable' => false, 'width' => 120])
            // ->addColumn(['data' => 'slug','name' => 'slug','title' => 'Slug','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'area','name' => 'area','title' => 'Property Area','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'location','name' => 'location','title' => 'Property Location','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_type','name' => 'property_type','title' => 'Property Type','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_purpose','name' => 'property_purpose','title' => 'Property Purpose','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'price','name' => 'price','title' => 'Property Price','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'agent_id','name' => 'agent_id','title' => 'Agent','orderable' => false, 'width' => 120])
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
        $data['view'] = 'admin.property.add';
        $data['agent'] = _arefy(Agents::where('status', '=', 'active')->get());
        $data['project'] = _arefy(Project::where('status', '=', 'active')->get());
        $data['category'] = _arefy(PropertyCategories::where('status', '=', 'active')->get());
        $data['company'] = _arefy(Company::where('status', '=', 'active')->get());
        $data['units'] = _arefy(Units::where('status', '=', 'active')->get());
        return view('admin.home',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->addProperty();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data = new Property();
            $data->fill($request->all());
            
            if ($file = $request->file('featured_image')){
                $photo_name = time().$request->file('featured_image')->getClientOriginalName();
                $file->move('assets/img/properties',$photo_name);
                $data['featured_image'] = $photo_name;
            }

            if ($request->featured == 1){
                $data->featured = 1;
            }

            $data->save();
            $lastid = $data->id;

            if ($files = $request->file('gallery')){
                foreach ($files as $file){
                    $gallery = new Property_Gallery;
                    $image_name = str_random(2).time().$file->getClientOriginalName();
                    $file->move('assets/img/Property Gallery',$image_name);
                    $gallery['images'] = $image_name;
                    $gallery['plot_id'] = $lastid;
                    $gallery->save();

                    $this->status   = true;
                    $this->modal    = true;
                    $this->alert    = true;
                    $this->message  = "Property has been Added successfully.";
                    $this->redirect = url('admin/property');
                }
            }    
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
        $data['view'] = 'admin.property.edit';
        $id = ___decrypt($id);
        $where = ' id = '.$id;
        $data['property'] = _arefy(Property::list('single',$where));
        $data['gallery'] = _arefy(Property_Gallery::where('plot_id',$id)->get());
        $data['agent'] = Agents::where('status', '=', 'active')->get();
        $data['company'] = Company::where('status', '=', 'active')->get();
        $data['project'] = Project::where('status', '=', 'active')->get();
        $data['category'] = PropertyCategories::where('status', '=', 'active')->get();
        $data['units'] = _arefy(Units::where('status', '=', 'active')->get());
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
        $validator  = $validation->addProperty('edit');
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $property = Property::findOrFail($id);
            $input = $request->all();

            if ($file = $request->file('featured_image')){
                $photo_name = time().$request->file('featured_image')->getClientOriginalName();
                $file->move('assets/img/properties',$photo_name);
                $input['featured_image'] = $photo_name;
            }

            if ($request->galdel == 1){
                $gal = Property_Gallery::where('plot_id',$id);
                $gal->delete();
            }

            if ($request->featured == 1){
                $input['featured'] = 1;
            }else{
                $input['featured'] = NULL;
            }

            $property->update($input);

            if ($files = $request->file('gallery')){
                foreach ($files as $file){
                    $gallery = new Property_Gallery;
                    $image_name = str_random(2).time().$file->getClientOriginalName();
                    $file->move('assets/img/Property Gallery',$image_name);
                    $gallery['images'] = $image_name;
                    $gallery['plot_id'] = $id;
                    $gallery->save();
                }
            }
            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Property has been Updated successfully.";
            $this->redirect = url('admin/property');
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
        $isUpdated               = Property::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Property successfully.';
            }else{
                $this->message = 'Updated Property successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }
}
