<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deals;
use App\Models\Units;
use App\Models\Agents;
use App\Models\Clients;
use App\Models\Property;
use App\Models\Plans;
use App\Models\Tax;
use App\Models\Tax_Percent;
use App\Models\Project;
use App\Models\Deals_Payment;
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

                $html   .= '<a href="'.url(sprintf('admin/deals/makeplan/%s',___encrypt($item['id']))).'"  title="Make Payment Plan"><i class="fa fa-credit-card"></i></a> | ';
                $html   .= '<a href="'.url(sprintf('admin/deals/showplan/%s',___encrypt($item['id']))).'"  title="Show Payment Plan"><i class="fa fa-briefcase"></i></a> | ';
                $html   .= '<a href="'.url(sprintf('admin/deals/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="'.url(sprintf('admin/deals/payment/%s',___encrypt($item['id']))).'"  title="Make Payment"><i class="fa fa-money"></i></a> | ';
                $html   .= '<a href="'.url(sprintf('admin/deals/showpayment/%s',___encrypt($item['id']))).'"  title="Show Payment"><i class="fa fa-eye"></i></a> | ';
                $html   .= '<a href="'.url(sprintf('admin/deals/print/%s',___encrypt($item['id']))).'"  title="Print Invoice"><i class="fa fa-print"></i></a> | ';
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
            ->editColumn('client_id',function($item){
                return ucfirst($item['client']['name']);
            })
            ->editColumn('project_id',function($item){
                return ucfirst($item['project']['name']);
            })
            ->editColumn('property_id',function($item){
                return ucfirst($item['property']['name']);
            })
            ->editColumn('status',function($item){
                if ($item['balance'] != 0) {
                    return 'Partial';
                }
                else {
                    return 'Paid';
                }
            })
            ->editColumn('amount',function($item){
                if($item['amount'] != NULL){
                  return 'Rs.'. ' ' .number_format($item['amount']);
                }else{
                  return 'Rs.'. ' ' .'0';
                }
            })
            ->editColumn('area',function($item){
                  return $item['area'].' '.$item['units']['name'];
            })
            ->editColumn('balance',function($item){
                if($item['balance'] != NULL){
                  return 'Rs.'. ' ' .number_format($item['balance']);
                }else{
                  return 'Rs.'. ' ' .'0';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'client_id', 'name' => 'client_id','title' => 'Client Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'project_id', 'name' => 'project_id','title' => 'Project Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id', 'name' => 'property_id','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_no', 'name' => 'invoice_no','title' => 'Invoice Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'date', 'name' => 'date','title' => 'Invoice Date','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'area', 'name' => 'area','title' => 'Area','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount', 'name' => 'amount','title' => 'Amount','orderable' => false, 'width' => 120])
             ->addColumn(['data' => 'balance','name' => 'balance','title' => 'Balance','orderable' => false, 'width' => 120])           
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function showPaymentPlan(Request $request, Builder $builder,$id){
        $data['view'] = 'admin.deals.showpaymentplan';

        \DB::statement(\DB::raw('set @rownum=0'));
        $id = ___decrypt($id);
        $dealspayment  = Deals_Payment::where('deal_id',$id)->get(['deal_payment_plan.*', 
                    \DB::raw('@rownum  := @rownum  + 1 AS rownum')]);
       $dealspayment = _arefy($dealspayment);
        if ($request->ajax()) {
            return DataTables::of($dealspayment)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';

                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('amount',function($item){
                return 'Rs.' .number_format($item['amount']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'rownum', 'name' => 'rownum','title' => 'S No','orderable' => false, 'width' => 1])     
            ->addColumn(['data' => 'name','name' => 'name','title' => 'Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount','name' => 'amount','title' => 'Amount','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'date','name' => 'date','title' => 'Due Date','orderable' => false, 'width' => 120])
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
        $data['view'] = 'admin.deals.add';
        $data['agent'] = _arefy(Agents::where('status','!=','trashed')->get());
        $data['client'] = _arefy(Clients::where('status','!=','trashed')->get());
        $data['property'] = _arefy(Property::where('status','!=','trashed')->get());
        $data['plan'] = _arefy(Plans::where('status','!=','trashed')->get());
        $data['project'] = _arefy(Project::where('status','!=','trashed')->get());
        $data['units'] = _arefy(Units::where('status','!=','trashed')->get());
        // dd($data['property']);
        return view('admin.home',$data);
    }

    public function ajaxProperties(Request $request)
    {
      $id = $request->id;
      $property = Property::where('project_id',$id)->where('deals','=','no')->get();
      $propertyview = view('admin.template.ajaxproperty',compact('property'));

      return Response($propertyview);
    }

    public function ajaxTax(Request $request)
    {
      $id = $request->id;
      $tax = Tax_Percent::where('tax_id',$id)->get();
      $taxview = view('admin.template.ajaxtax',compact('tax'));

      return Response($taxview);
    }

    public function ajaxArea(Request $request)
    {
      $id = $request->id;
      $area = Property::where('id',$id)->first();
      $units = Units::where('id',$area['unit_id'] )->first();
      $areaview['unit_id']=$units['id'];
      $areaview['unit_name']=$units['name'];
      $areaview['area']=$area['area'];
      $areaview['price']=$area['price'];
      return Response($areaview);
    }

    public function makePaymentPlan(Request $request,$id)
    {
      $data['view'] = 'admin.deals.makepaymentplan';
      $id = ___decrypt($id);
      $where = 'id = '.$id;
      $data['deal'] = _arefy(Deals::list('single',$where));
      $data['installment'] = $data['deal']['plan']['installment'];
      return view('admin.home',$data);
    }

    public function makePayment(Request $request,$id)
    {
      $data['view'] = 'admin.deals.makepayment';
      $id = ___decrypt($id);
      $where = 'id = '.$id;
      $data['deal'] = _arefy(Deals::list('single',$where));
      $data['tax'] = _arefy(Tax::where('status','!=','trashed')->get());
      $data['installment'] = $data['deal']['plan']['installment'];
      return view('admin.home',$data);
    }

    public function makePaymentPlanForm(Request $request,$id)
    {
        $id = ___decrypt($id);
        foreach ($request->deal as $deals) {
          $data['name']=$deals['name'];
          $data['amount']=$deals['amount'];
          $data['date']=$deals['date'];
          $data['deal_id']=$id;
          $deal = Deals_Payment::insert($data);
        }

        $this->status   = true;
        $this->modal    = true;
        $this->alert    = true;
        $this->message  = "Payment Plan has been Added successfully.";
        $this->redirect = url('admin/deals');
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
        $validator  = $validation->addDeal();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data = new Deals();

            $data->fill($request->all());
            $data->save();

            $lastid = $data->property_id;
            $input = Property::findOrFail($lastid);
            $property['deals'] = 'yes';

            $input->update($property);
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
        $data['view'] = 'admin.deals.edit';
        $id = ___decrypt($id);
        $where = 'id = '.$id;
        $data['deal'] = _arefy(Deals::list('single',$where));
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
        $validator  = $validation->addDeal('edit');
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $deal = Deals::findOrFail($id);
            $input = $request->all();

            $deal->update($input);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Deal has been Updated successfully.";
            $this->redirect = url('admin/deals');
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
        $isUpdated               = Deals::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Deals successfully.';
            }else{
                $this->message = 'Updated Deals successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }
}
