<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use App\Models\Project;
use App\Models\Purchase;
use App\Models\Purchase_Payment;
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
                if ($item['status'] != 'paid'){
                  $html   .= '<a href="'.url(sprintf('admin/purchase/payment/%s',___encrypt($item['id']))).'"  title="Purchase Payment"><i class="fa fa-money"></i></a> | ';
                }
                $html   .= '<a href="'.url(sprintf('admin/purchase/showpayment/%s',___encrypt($item['id']))).'"  title="Show Payment History"><i class="fa fa-eye"></i></a> | ';
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
              if (!empty($item['description'])) {
                return str_limit(strip_tags($item['description']),50);
              }else{
                return 'N/A'; 
              }
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

    public function showPayment(Request $request, Builder $builder,$id){
        $data['view'] = 'admin.purchase.showpaymentlist';
        
        $id = ___decrypt($id);
        $purchasePayment  = _arefy(Purchase_Payment::where('purchase_id',$id)->get());
        if ($request->ajax()) {
            return DataTables::of($purchasePayment)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                // $html   .= '<a href="'.url(sprintf('admin/expenses/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                // $html   .= '<a href="javascript:void(0);" 
                //         data-url="'.url(sprintf('admin/showpayment/status/?id=%s&status=trashed',$item['id'])).'" 
                //         data-request="ajax-confirm"
                //         data-ask_image="'.url('assets/img/delete.png').'"
                //         data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                // }
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('amount',function($item){
                return 'Rs.'. ' ' .number_format($item['amount']);
            })
            ->editColumn('payment_type',function($item){
              if ($item['payment_type'] == 'debit_card') {
                return 'Debit Card';
              }if ($item['payment_type'] == 'bank_transfer') {
                return 'Bank Transfer';
              }else{
                return ucfirst($item['payment_type']);
              }
            })
            ->editColumn('remarks',function($item){
                if (!empty($item['remarks'])) {
                  return ucfirst(item['remarks']);
                }else{
                  return 'N/A';
                }
            })
            ->editColumn('date',function($item){
                return $item['date'];
            })
            ->editColumn('status',function($item){
              if ($item['status'] == 'active') {
                return 'Active';
              }            
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'amount','name' => 'amount','title' => 'Amount','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'payment_type','name' => 'payment_type','title' => 'Payment Type','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'date','name' => 'date','title' => 'Date','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'remarks','name' => 'remarks','title' => 'Remarks','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120]);
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

    public function purchasePayment(Request $request,$id)
    {
      $data['view'] = 'admin.purchase.payment';
      $id = ___decrypt($id);
      $where = 'id = '.$id;
      $data['purchase'] = _arefy(Purchase::list('single',$where));      
      return view('admin.home',$data);
    }

    public function purchasePaymentAmount(Request $request, $id)
    {
      $id = ___decrypt($id);
      $validation = new Validations($request);
      $validator  = $validation->addpurchasepayment();
      if ($validator->fails()) {
        $this->message = $validator->errors();
      }else{
        // pp($request->all());
          $purchasepayment = new Purchase_Payment();
          $purchasepayment->fill($request->all());

          $purchasepayment->save();
          $getBalance = Purchase::where('id',$id)->first();
          $bal['balance'] = $getBalance['balance']-$request->amount;
          if ($bal['balance'] != 0) {
            $bal['status'] = 'partial';
          }else{
            $bal['status'] = 'paid';
          }
          $upd = Purchase::where('id',$id)->update($bal);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Purchase Payment has been Added successfully.";
            $this->redirect = url('admin/purchase');
        }
          return $this->populateresponse();
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
        $data['property'] = _arefy(Property::where('status', '=', 'active')->where('id',$id)->get());
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
        $validator  = $validation->addPurchase('edit');
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $purchase = Purchase::findOrFail($id);
            $input = $request->all();
            if ($input['balance'] != 0) {
              $input['status'] = 'partial';
            }else{
              $input['status'] = 'paid';
            }

            $purchase->update($input);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Purchase has been Updated successfully.";
            $this->redirect = url('admin/purchase');
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
