<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Deals;
use App\Models\Project;
use App\Models\Purchase;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Make_Payment;
use App\Models\Deals_Payment;
use App\Models\Purchase_Payment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class ReportController extends Controller
{
	public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function purchaseReport(Request $request){
    	    $data['view'] = 'admin.reports.purchasereport';
            $data['projects'] = _arefy(Project::where('status','!=','trashed')->get());
            $current_month = date('m');
            $current_year = date('Y');
            $purchase_year = \DB::table('purchase');
            if(!empty($request->year)){
                $year = $request->year;
                $purchase_year->whereRaw('YEAR(created_at) = ?',$year);
            }

            if(!empty($request->project_name)){
                $project_name = $request->project_name;
                $purchase_year->where('project_id',$project_name);
            }

            if(!empty($request->seller_name)){
                $seller_name = $request->seller_name;
                $purchase_year->where('seller_name','like','%'.$seller_name.'%');
            }
            if(!empty($request->date_from) && !empty($request->date_to)){
                $date_from = $request->date_from;
                $purchase_year->whereBetween('created_at', array($date_from, $request->date_to));
            }

            $purchase_year =$purchase_year->get();
            $data['purchase_year'] =_arefy($purchase_year);

            $data['purchase_month'] = _arefy(Purchase::whereRaw('MONTH(created_at) = ?',[$current_month])->whereRaw('YEAR(created_at) = ?',[$current_year])->where('status','!=','trashed')->get());
            $data['purchase_payment'] = _arefy(Purchase_Payment::where('status','!=','trashed')->get());
            
    	  return view('admin.home',$data);
    }

    public function salesReport(Request $request){
    	$data['view'] = 'admin.reports.salesreport';
    	return view('admin.home',$data);
    }

    public function expenseReport(Request $request){
    	$data['view'] = 'admin.reports.expensereport';
    	return view('admin.home',$data);
    }

    public function profitReport(Request $request){
        $data['view'] = 'admin.reports.profitreport';
        return view('admin.home',$data);
    }

    public function balanceInvoice(Request $request, Builder $builder){
        $data['view'] = 'admin.invoices.balanceinvoice';

        $where = 'status != "trashed"';
        $where .= ' AND balance != "0"';
        $balanceinvoice  = _arefy(Deals::list('array',$where));
        // dd($balanceinvoice);

        if ($request->ajax()) {
            return DataTables::of($balanceinvoice)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/balanceinvoices/%s',___encrypt($item['id']))).'"  title="Show Balance Invoices"><i class="fa fa-eye"></i></a> ';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('client_id',function($item){
                return ucfirst($item['client']['name']);
            })
            ->editColumn('client_phone',function($item){
                return ucfirst($item['client']['phone']);
            })
            ->editColumn('project_id',function($item){
                return ucfirst($item['project']['name']);
            })
            ->editColumn('property_id',function($item){
                return ucfirst($item['property']['name']);
            })
            ->editColumn('property',function($item){
                return ucfirst($item['property']['property_construct']);
            })
            ->editColumn('area',function($item){
                return number_format($item['area']). ' '. $item['units']['name'];
            })
            ->editColumn('amount',function($item){
                return 'Rs.'.number_format($item['amount']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'client_id','name' => 'client_id','title' => 'Client Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'client_phone','name' => 'client_phone','title' => 'Client Phone','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'project_id','name' => 'project_id','title' => 'Project Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id','name' => 'property_id','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property','name' => 'property','title' => 'Property Type','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_no','name' => 'invoice_no','title' => 'Invoice Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'area','name' => 'area','title' => 'Property Area','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount','name' => 'amount','title' => 'Amount','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function showBalanceInvoice(Request $request, Builder $builder,$id){

        $data['view'] = 'admin.invoices.showbalanceinvoice';

        $id = ___decrypt($id);
        $where = 'deal_id = '.___decrypt($id);
        $where .= ' AND payment_status = "no"';
        $data['balance'] = _arefy(Deals_Payment::list('array',$where,['*'],'id-asc'));
        // dd($data['balance']);

        if ($request->ajax()) {
            return DataTables::of($data['balance'])
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';

                $html   .= '<a href="'.url(sprintf('admin/balanceinvoice/invoicepdf/%s',___encrypt($item['id']))).'"  title="Print Demand Letter"><i class="fa fa-print"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('amount',function($item){
                return 'Rs.'.number_format($item['amount']);
            })
            ->editColumn('client_id',function($item){
                return ucfirst($item['client']['name']);
            })
            ->editColumn('client_phone',function($item){
                return $item['client']['phone'];
            })
            ->editColumn('property_id',function($item){
                return $item['property']['name'];
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'client_id','name' => 'client_id','title' => 'Client Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'client_phone','name' => 'client_phone','title' => 'Phone Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id','name' => 'property_id','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_no','name' => 'invoice_no','title' => 'Invoice Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name','name' => 'name','title' => 'Payment Due On','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'date','name' => 'date','title' => 'Payment Due Date','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount','name' => 'amount','title' => 'Amount','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);;
        return view('admin.home')->with($data);
    }

    public function pdfInvoice(Request $request,$id){
        $id = ___decrypt($id);
        $where = 'deal_id = '.___decrypt($id);
        $where .= ' AND payment_status = "no"';
        $data['balance'] = _arefy(Deals_Payment::list('array',$where));
        $data['balanceinvoice'] = _arefy($data['balance']);
        $excel_name='invoice_data';
        $pdf = PDF::loadView('admin.pdfview', $data);
        return $pdf->download('balance_invoice.pdf');
    }

    public function pdfbalanceInvoice(Request $request,$id){
        $id = ___decrypt($id);
        $where = 'id = '.___decrypt($id);
        $where .= ' AND payment_status = "no"';
        $data['singlebalance'] = _arefy(Deals_Payment::list('single',$where));
        $data['contact'] = _arefy(Contact::where('status','!=','trashed')->get());
        // dd($data['contact']);
        $data['balanceinvoice'] = _arefy($data['singlebalance']);
        $excel_name='balance_invoice';
        $pdf = PDF::loadView('admin.balancepdfview', $data);
        return $pdf->download('balance_invoice.pdf');
    }

    public function paidInvoice(Request $request, Builder $builder){
    	$data['view'] = 'admin.invoices.paidinvoices';

        $where = 'status != "trashed"';
        $paidinvoice  = _arefy(Deals::list('array',$where));
        // dd($paidinvoice);

        if ($request->ajax()) {
            return DataTables::of($paidinvoice)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/paidinvoices/%s',___encrypt($item['id']))).'"  title="Show Paid Invoices"><i class="fa fa-eye"></i></a> ';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('client_id',function($item){
                return ucfirst($item['client']['name']);
            })
            ->editColumn('client_phone',function($item){
                return ucfirst($item['client']['phone']);
            })
            ->editColumn('project_id',function($item){
                return ucfirst($item['project']['name']);
            })
            ->editColumn('property_id',function($item){
                return ucfirst($item['property']['name']);
            })
            ->editColumn('property',function($item){
                return ucfirst($item['property']['property_construct']);
            })
            ->editColumn('area',function($item){
                return number_format($item['area']). ' '. $item['units']['name'];
            })
            ->editColumn('amount',function($item){
                return 'Rs.'.number_format($item['amount']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'client_id','name' => 'client_id','title' => 'Client Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'client_phone','name' => 'client_phone','title' => 'Client Phone','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'project_id','name' => 'project_id','title' => 'Project Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id','name' => 'property_id','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property','name' => 'property','title' => 'Property Type','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_no','name' => 'invoice_no','title' => 'Invoice Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'area','name' => 'area','title' => 'Property Area','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount','name' => 'amount','title' => 'Amount','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function showPaidInvoice(Request $request, Builder $builder,$id=''){
        $data['view'] = 'admin.invoices.showpaidinvoice';

        $where = 'deal_id = '.___decrypt($id);
        $data['paid'] = _arefy(Make_Payment::list('array',$where));

        if ($request->ajax()) {
            return DataTables::of($data['paid'])
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('amount',function($item){
                return 'Rs.'.number_format($item['amount']);
            })
            ->editColumn('client_id',function($item){
                return ucfirst($item['client']['name']);
            })
            ->editColumn('client_phone',function($item){
                return $item['client']['phone'];
            })
            ->editColumn('property_id',function($item){
                return $item['property']['name'];
            })
            ->editColumn('payable_amount',function($item){
                return 'Rs.'.number_format($item['payable_amount']);
            })
            ->editColumn('late_amount',function($item){
                return 'Rs.'.number_format($item['late_amount']);
            })
            ->editColumn('taxable_amount',function($item){
                return 'Rs.'.number_format($item['taxable_amount']);
            })
            ->editColumn('tax_id',function($item){
                if (!empty($item['tax_name']['name'])) {
                    return ($item['tax_name']['name']);
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('tax_percentage',function($item){
                if (!empty($item['tax_percent']['percentage'])) {
                    return ($item['tax_percent']['percentage']).'%';
                }else{
                    return 'N/A';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'client_id','name' => 'client_id','title' => 'Client Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'client_phone','name' => 'client_phone','title' => 'Phone Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id','name' => 'property_id','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_no','name' => 'invoice_no','title' => 'Invoice Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name','name' => 'name','title' => 'Payment Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount','name' => 'amount','title' => 'Amount','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'tax_id','name' => 'tax_id','title' => 'Tax Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'tax_percentage','name' => 'tax_percentage','title' => 'Tax Percentage','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'taxable_amount','name' => 'taxable_amount','title' => 'Taxable Amount','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'late_amount','name' => 'late_amount','title' => 'Late Amount','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'date','name' => 'date','title' => 'Payment Date','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'payable_amount','name' => 'payable_amount','title' => 'Total Payable Amount','orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function pdfpaidInvoice(Request $request,$id){
        $id = ___decrypt($id);
        $where = 'deal_id = '.___decrypt($id);
        $data['paid'] = _arefy(Make_Payment::list('array',$where));
        $data['paidinvoice'] = _arefy($data['paid']);
        $excel_name='invoice_data';
        $pdf = PDF::loadView('admin.pdfpaidview', $data);
        return $pdf->download('paid_invoice.pdf');

    }
}
