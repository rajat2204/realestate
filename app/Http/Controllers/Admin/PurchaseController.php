<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use App\Models\Project;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class PurchaseController extends Controller
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
        $data['view'] = 'admin.purchase.list';
        
        $where = 'status != "trashed"';
        $purchase  = _arefy(Purchase::list('array',$where));

        // dd($purchase);
        if ($request->ajax()) {
            return DataTables::of($purchase)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/purchase/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/purchase/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('price',function($item){
                return 'Rs.'. ' ' .number_format(($item['price']));
            })
            ->editColumn('balance',function($item){
                return 'Rs.'. ' ' .number_format(($item['balance']));
            })
            ->editColumn('seller_mobile',function($item){
                return '+91-'. ' ' .($item['seller_mobile']);
            })
            ->editColumn('area',function($item){
                return $item['area']. ' ' . 'sq.ft.';
            })
            ->editColumn('project_id',function($item){
                return ucfirst($item['project']['name']);
            })
            ->editColumn('property',function($item){
                return ucfirst($item['property']['name']);
            })
            ->editColumn('description',function($item){
                return str_limit(strip_tags($item['description']),50);
            })
            ->editColumn('property_image',function($item){
                $imageurl = asset("assets/img/properties/".$item['property']['featured_image']);
                return '<img src="'.$imageurl.'" height="70px" width="100px">';
            })
            ->rawColumns(['property_image','action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'property_image', 'name' => 'property_image','render' => 'data','title' => 'Property Image','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property', 'name' => 'property','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'project_id', 'name' => 'project_id','title' => 'Project Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'seller_name', 'name' => 'seller_name','title' => 'Seller Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'seller_address', 'name' => 'seller_address','title' => 'Seller Address','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'seller_mobile', 'name' => 'seller_mobile','title' => 'Seller Mobile','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'area', 'name' => 'area','title' => 'Area','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'price', 'name' => 'price','title' => 'Price','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'balance', 'name' => 'balance','title' => 'Balance','orderable' => false, 'width' => 120])
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
        $data['view'] = 'admin.purchase.add';
        $data['project'] = _arefy(Project::where('status', '=', 'active')->get());
        $data['property'] = _arefy(Property::where('status', '=', 'active')->get());
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
        $validator  = $validation->addPurchase();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $purchase = new Purchase();
            $purchase->fill($request->all());
            if ($purchase['balance'] != 0) {
                $purchase['status'] = 'partial';
            }else{
                $purchase['status'] = 'paid';
            }

            $purchase->save();

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Purchase has been Added successfully.";
            $this->redirect = url('admin/purchase');
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
        $data['view'] = 'admin.purchase.edit';
        $id = ___decrypt($id);
        $where = 'id = '.$id;
        $data['purchase'] = _arefy(Purchase::list('single',$where));
        $data['project'] = _arefy(Project::where('status', '=', 'active')->get());
        $data['property'] = _arefy(Property::where('status', '=', 'active')->get());
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

    public function changeStatus(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Purchase::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Purchase successfully.';
            }else{
                $this->message = 'Updated Purchase successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }
}
