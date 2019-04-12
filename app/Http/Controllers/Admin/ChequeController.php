<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Cheques;
use App\Models\Clients;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class ChequeController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function allchequesList(Builder $builder,Request $request){
    	$data['view'] = 'admin.cheques.allcheques';
        
        $where = 'status = "pending"';
        $data['cheques'] = _arefy(Cheques::list('array',$where));
        // dd($data['cheques']);
       
        if ($request->ajax()) {
            return DataTables::of($data['cheques'])
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/allcheques/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('property_id',function($item){
                return ucfirst($item['property']['name']);
            })
            ->editColumn('client_id',function($item){
                return ucfirst($item['client']['name']);
            })
            ->editColumn('client_phone',function($item){
                return ucfirst($item['client']['phone']);
            })
            ->editColumn('amount',function($item){
                return 'Rs.'.(number_format($item['amount']));
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'client_id', 'name' => 'client_id','title' => 'Client Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'client_phone', 'name' => 'client_phone','title' => 'Client Contact Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id', 'name' => 'property_id','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Payment Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_no', 'name' => 'invoice_no','title' => 'Invoice No.','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount', 'name' => 'amount','title' => 'Amount Paid','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'cheque_no', 'name' => 'cheque_no','title' => 'Cheque Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'bank_name', 'name' => 'bank_name','title' => 'Bank Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function clearchequesList(Builder $builder,Request $request){
        $data['view'] = 'admin.cheques.clearchequeslist';
        
        $where = 'status = "clear"';
        $data['cheques'] = _arefy(Cheques::list('array',$where));
        // dd($data['cheques']);
       
        if ($request->ajax()) {
            return DataTables::of($data['cheques'])
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('property_id',function($item){
                return ucfirst($item['property']['name']);
            })
            ->editColumn('client_id',function($item){
                return ucfirst($item['client']['name']);
            })
            ->editColumn('client_phone',function($item){
                return ucfirst($item['client']['phone']);
            })
            ->editColumn('amount',function($item){
                return 'Rs.'.(number_format($item['amount']));
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'client_id', 'name' => 'client_id','title' => 'Client Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'client_phone', 'name' => 'client_phone','title' => 'Client Contact Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id', 'name' => 'property_id','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Payment Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_no', 'name' => 'invoice_no','title' => 'Invoice No.','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount', 'name' => 'amount','title' => 'Amount Paid','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'cheque_no', 'name' => 'cheque_no','title' => 'Cheque Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'bank_name', 'name' => 'bank_name','title' => 'Bank Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function bouncedchequesList(Builder $builder,Request $request){
        $data['view'] = 'admin.cheques.bouncedchequeslist';
        
        $where = 'status = "bounce"';
        $data['cheques'] = _arefy(Cheques::list('array',$where));
        // dd($data['cheques']);
       
        if ($request->ajax()) {
            return DataTables::of($data['cheques'])
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('property_id',function($item){
                return ucfirst($item['property']['name']);
            })
            ->editColumn('client_id',function($item){
                return ucfirst($item['client']['name']);
            })
            ->editColumn('client_phone',function($item){
                return ucfirst($item['client']['phone']);
            })
            ->editColumn('amount',function($item){
                return 'Rs.'.(number_format($item['amount']));
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'client_id', 'name' => 'client_id','title' => 'Client Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'client_phone', 'name' => 'client_phone','title' => 'Client Contact Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id', 'name' => 'property_id','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Payment Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_no', 'name' => 'invoice_no','title' => 'Invoice No.','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount', 'name' => 'amount','title' => 'Amount Paid','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'cheque_no', 'name' => 'cheque_no','title' => 'Cheque Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'bank_name', 'name' => 'bank_name','title' => 'Bank Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function cancelledchequesList(Builder $builder,Request $request){
        $data['view'] = 'admin.cheques.cancelchequelist';
        
        $where = 'status = "cancelled"';
        $data['cheques'] = _arefy(Cheques::list('array',$where));
        // dd($data['cheques']);
       
        if ($request->ajax()) {
            return DataTables::of($data['cheques'])
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('property_id',function($item){
                return ucfirst($item['property']['name']);
            })
            ->editColumn('client_id',function($item){
                return ucfirst($item['client']['name']);
            })
            ->editColumn('client_phone',function($item){
                return ucfirst($item['client']['phone']);
            })
            ->editColumn('amount',function($item){
                return 'Rs.'.(number_format($item['amount']));
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'client_id', 'name' => 'client_id','title' => 'Client Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'client_phone', 'name' => 'client_phone','title' => 'Client Contact Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id', 'name' => 'property_id','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Payment Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_no', 'name' => 'invoice_no','title' => 'Invoice No.','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount', 'name' => 'amount','title' => 'Amount Paid','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'cheque_no', 'name' => 'cheque_no','title' => 'Cheque Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'bank_name', 'name' => 'bank_name','title' => 'Bank Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function updateChequeStatus($id){
        $data['view'] = 'admin.cheques.editcheque';
        $id = ___decrypt($id);
        $where = 'id = '.___decrypt($id);
        $data['cheques'] = _arefy(Cheques::list('single',$where));
        // dd($data['cheques']);
        return view('admin.home',$data);
    }

    public function updateCheque(Request $request, $id)
    {
        $id = ___decrypt($id);
        $cheque = Cheques::findOrFail($id);
        $data = $request->all();

        $cheque->update($data);
        $propertyDetails = _arefy(Property::where('id',$cheque['property_id'])->first());
        $clientDetails = _arefy(Clients::where('id',$cheque['client_id'])->first());
        // dd($clientDetails);

        $username="AMREESH@25"; 
        $password="AMREESH@25";
        $sender="AMRESH";

        $message="Dear ".$clientDetails['name'].", it is to inform you that your Cheque Number ".$cheque['cheque_no']." of ".$cheque['bank_name']." whose amount is Rs. ".number_format($cheque['amount']). " is ".$cheque['status']. " which you have submitted as a ".$cheque['name']. " for ".$propertyDetails['name'].". -DevDrishti Infrahomes Pvt. Ltd.";

        $pingurl = "skycon.bulksms5.com/sendmessage.php";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $pingurl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'user=' . $username . '&password=' . $password . '&mobile=' . $clientDetails['phone'] . '&message=' . urlencode($message) . '&sender=' . $sender . '&type=3');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
       
        curl_close($ch);

        $this->status   = true;
        $this->modal    = true;
        $this->alert    = true;
        $this->message  = "Cheque Status has been Updated successfully.";
        $this->redirect = url('admin/allcheques');

        return $this->populateresponse();
    }

    public function pdfCheques(Request $request){
        $where = 'status = "pending"';
        $data['cheques'] = _arefy(Cheques::list('array',$where));
        $data['cheque'] = _arefy($data['cheques']);
        // dd($data['cheque']);
        $excel_name='cheques_pending_data';
        $pdf = PDF::loadView('admin.chequepdfview', $data);
        return $pdf->download('cheques_pending_data.pdf');
    }
}
