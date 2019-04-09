<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Deals;
use App\Models\Project;
use App\Models\Purchase;
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
        $where = 'status != "trashed"';
        $data['purchase'] = _arefy(Purchase::list('array',$where));
        

        $data['purchase_payment'] = _arefy(Purchase_Payment::where('status','!=','trashed')->where('date','!=','trashed')->get());
       $tt= Purchase_Payment::checkdate1();
        dd($tt);
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

        \DB::statement(\DB::raw('set @rownum=0'));
        $id = ___decrypt($id);
        $balance = _arefy(Deals_Payment::where('deal_id',$id)->where('payment_status','=','no')->get(['deal_payment_plan.*', 
            \DB::raw('@rownum  := @rownum  + 1 AS rownum')]));
        $balance = _arefy($balance);

        if ($request->ajax()) {
            return DataTables::of($balance)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';

                $html   .= '</div>';
                                
                return $html;
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
            ->addColumn(['data' => 'rownum', 'name' => 'rownum','title' => 'S No','orderable' => false, 'width' => 1])
            ->addColumn(['data' => 'name','name' => 'name','title' => 'Payment Due On','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'date','name' => 'date','title' => 'Payment Due Date','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount','name' => 'amount','title' => 'Amount','orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function paidInvoice(Request $request, Builder $builder){
    	$data['view'] = 'admin.invoices.paidinvoices';

        $where = 'status != "trashed"';
        $paidinvoice  = _arefy(Deals::list('array',$where));
        // dd($balanceinvoice);

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
        $paid = _arefy(Make_Payment::list('array',$where));
        // dd($paid);

        if ($request->ajax()) {
            return DataTables::of($paid)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';

                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('amount',function($item){
                return 'Rs.'.number_format($item['amount']);
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
            // ->editColumn('taxable_amount',function($item){
            //     return 'Rs.'.number_format($item['taxable_amount']);
            // })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
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

    public function pdf(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_paid_invoice_to_html());
        $pdf->stream();
    }

    public function convert_paid_invoice_to_html(){
        //$invoice_data = $this->showPaidInvoice();
        //dd($invoice_data);
        $output = '
            <h3 align="center">Paid Invoice Data</h3>
            <table width="100%" style="border-collapse:collapse; border: 0px;">
                <tr>
                    <th style= "border: 1px solid;padding:12px" width="20%">Payment Name</th>
                    <th style= "border: 1px solid;padding:12px" width="20%">Amount</th>
                    <th style= "border: 1px solid;padding:12px" width="20%">Tax Name</th>
                    <th style= "border: 1px solid;padding:12px" width="20%">Tax Percentage</th>
                    <th style= "border: 1px solid;padding:12px" width="20%">Taxable Amount</th>
                    <th style= "border: 1px solid;padding:12px" width="20%">Late Amount</th>
                    <th style= "border: 1px solid;padding:12px" width="20%">Payment Date</th>
                    <th style= "border: 1px solid;padding:12px" width="20%">Total Payable Amount</th>
                </tr>
        ';
        //foreach ($invoice_data as $invoice) {
            $output .= '
                <tr>
                    <td style= "border: 1px solid;padding:12px" width="20%">asdaDA</td>
                    <td style= "border: 1px solid;padding:12px" width="20%">SFSDF</td>
                    <td style= "border: 1px solid;padding:12px" width="20%">SFSDF</td>
                    <td style= "border: 1px solid;padding:12px" width="20%">SFSDF</td>
                    <td style= "border: 1px solid;padding:12px" width="20%"></td>
                    <td style= "border: 1px solid;padding:12px" width="20%"></td>
                    <td style= "border: 1px solid;padding:12px" width="20%"></td>
                    <td style= "border: 1px solid;padding:12px" width="20%"></td>
                </tr>
            ';
        //}
        $output .= '</table>';
        dd($output);
        return $output;
    }
}
