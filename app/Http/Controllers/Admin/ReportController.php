<?php

namespace App\Http\Controllers\Admin;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Validations\Validate as Validations;

class ReportController extends Controller
{
	public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function purchaseReport(Request $request)
    {
    	$data['view'] = 'admin.reports.purchasereport';
    	return view('admin.home',$data);
    }

    public function salesReport(Request $request)
    {
    	$data['view'] = 'admin.reports.salesreport';
    	return view('admin.home',$data);
    }

    public function expenseReport(Request $request)
    {
    	$data['view'] = 'admin.reports.expensereport';
    	return view('admin.home',$data);
    }

    public function profitReport(Request $request)
    {
        $data['view'] = 'admin.reports.profitreport';
        return view('admin.home',$data);
    }

    public function balanceInvoice(Request $request)
    {
        $data['view'] = 'admin.invoices.balanceinvoice';
        return view('admin.home',$data);
    }

    public function paidInvoice(Request $request)
    {
    	$data['view'] = 'admin.invoices.paidinvoice';
    	return view('admin.home',$data);
    }
}
