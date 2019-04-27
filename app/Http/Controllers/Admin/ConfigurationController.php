<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tax;
use App\Models\Tax_Percent;
use App\Models\Units;
use App\Models\Currencies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class ConfigurationController extends Controller
{

public function __construct(Request $request)
{
  parent::__construct($request);
} 	
  public function index(Request $request, Builder $builder)
  {
        $data['view'] = 'admin.configuration.currencies.list';
           \DB::statement(\DB::raw('set @rownum=0'));
        $currencies = Currencies::where('status','!=','trashed')->get(['currency.*', 
                    \DB::raw('@rownum  := @rownum  + 1 AS rownum')]);
        $currencies = _arefy($currencies);

        if ($request->ajax()) {
            return DataTables::of($currencies)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
               
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/currencies/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('currency_name',function($item){
                return ucfirst($item['currency_name']);
            })
            ->editColumn('status',function($item){
              if ($item['status'] == 'active') {
                return 'Active';
              }
            })
            ->editColumn('image',function($item){
                $imageurl = asset("assets/img/currency/".$item['image']);
                return '<img src="'.$imageurl.'" height="20" width="25">';
            })
            ->rawColumns(['image','action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-6'l><'col-md-6 col-sm-12 col-xs-6'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'rownum', 'name' => 'rownum','title' => 'S No','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'currency_name', 'name' => 'currency_name','title' => 'Currency Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'image', 'name' => 'image',"render" => 'data','title' => 'Currency Image','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status', 'name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
            return view('admin.home')->with($data);
    }

public function tax(Request $request, Builder $builder)
   {
         $data['view'] = 'admin.configuration.tax.list';
        \DB::statement(\DB::raw('set @rownum=0'));
        $tax = Tax::where('status','!=','trashed')->get(['tax.*', 
                    \DB::raw('@rownum  := @rownum  + 1 AS rownum')]);
        $tax  = _arefy($tax);
        
        if ($request->ajax()) {
            return DataTables::of($tax)
            ->editColumn('action',function($item) {
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/tax/edit/%s/',___encrypt($item['id']))).'"  title="Edit Tax"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/tax/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('name',function($item){
                return ucfirst($item['name']);
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
            ->addColumn(['data' => 'rownum', 'name' => 'rownum','title' => 'S No','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Tax Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status', 'name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])        
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
   
   }

   public function taxpercent(Request $request, Builder $builder)
   {
        $data['view'] = 'admin.configuration.tax.taxpercentlist';
        
        $where = 'status != "trashed"';
        $taxpercent = Tax_Percent::list('array',$where);
        
        if ($request->ajax()) {
            return DataTables::of($taxpercent)
            ->editColumn('action',function($item) {
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/taxpercent/edit/%s/',___encrypt($item['id']))).'"  title="Edit Tax Percent"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);"
                        data-url="'.url(sprintf('admin/taxpercent/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('tax_id',function($item){
                return ucfirst($item['taxname']['name']);
            })
            ->editColumn('percentage',function($item){
                return ucfirst($item['percentage']);
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
            ->addColumn(['data' => 'tax_id','name' => 'tax_id','title' => 'Tax Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'percentage', 'name' => 'percentage','title' => 'Tax Percentage','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status', 'name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])        
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
   
   } 

   public function units(Request $request, Builder $builder)
   {
         $data['view'] = 'admin.configuration.units.list';
        \DB::statement(\DB::raw('set @rownum=0'));
        $units = Units::where('status','!=','trashed')->get(['unit.*', 
                    \DB::raw('@rownum  := @rownum  + 1 AS rownum')]);
        $units  = _arefy($units);
        
        if ($request->ajax()) {
            return DataTables::of($units)
            ->editColumn('action',function($item) {
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/units/edit/%s/',___encrypt($item['id']))).'"  title="Edit Units"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/units/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('name',function($item){
                return ucfirst($item['name']);
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
            ->addColumn(['data' => 'rownum', 'name' => 'rownum','title' => 'S No','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Units Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status', 'name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])        
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
   
   }

public function currencyAdd(Request $request)
    {
        $validation = new Validations($request);
        $validator  = $validation->addCurrency();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data = new Currencies();//currency model
            $data->fill($request->all());

            if ($file = $request->file('image')){
                $photo_name = time().$request->file('image')->getClientOriginalName();
                $file->move('assets/img/currency',$photo_name);
                $data['image'] = $photo_name;
            }
            
            $data->save();
              $this->status   = true;
              $this->modal    = true;
              $this->alert    = true;
              $this->message  = "Currency has been Added successfully.";
              $this->redirect = url('admin/currencies');
        } 
      return $this->populateresponse();
    }
    public function currencyAddForm(Request $request)
    {
        $data['view'] = 'admin.configuration.currencies.add';
        return view('admin.home',$data);  
    }

    public function unitsAddForm(Request $request)
    {
        $data['view'] = 'admin.configuration.units.add';
        return view('admin.home',$data);  
    }

    public function unitsAdd(Request $request)
    {
        $validation = new Validations($request);
        $validator  = $validation->addUnits();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data = new Units();
            $data->fill($request->all());
            
            $data->save();

              $this->status   = true;
              $this->modal    = true;
              $this->alert    = true;
              $this->message  = "Unit has been Added successfully.";
              $this->redirect = url('admin/units');
        } 
      return $this->populateresponse();
    }

   //************** Help page section************   
   public function help(Request $request)
   {
   	$data['view'] = 'admin.help.help';
   	return view('admin.home',$data);	
   }
  //*******Tax Page section*********

    public function taxAddForm(Request $request)
    {
        $data['view'] = 'admin.configuration.tax.add';
        return view('admin.home',$data);  
    }

    public function addTaxPercent(Request $request)
    {
        $data['view'] = 'admin.configuration.tax.addtaxpercent';
        $data['taxname'] = _arefy(Tax::where('status', '=', 'active')->get());
        return view('admin.home',$data);  
    }

    public function taxPercentForm(Request $request)
    {
        $validation = new Validations($request);
        $validator  = $validation->addTaxPercentage();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data = new Tax_Percent();
            $data->fill($request->all());

            $data->save();
              $this->status   = true;
              $this->modal    = true;
              $this->alert    = true;
              $this->message  = "Tax Percentage has been Added successfully.";
              $this->redirect = url('admin/taxpercent');
        }
        return $this->populateresponse();
    }

    public function taxAdd(Request $request)
    {
        $validation = new Validations($request);
        $validator  = $validation->addTax();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data = new Tax();//currency model
            $data->fill($request->all());

            $data->save();
              $this->status   = true;
              $this->modal    = true;
              $this->alert    = true;
              $this->message  = "Tax has been Added successfully.";
              $this->redirect = url('admin/tax');
 
      } 
      return $this->populateresponse();
    }

    public function taxEditForm(Request $request,$id)
    {
        $data['view'] = 'admin.configuration.tax.edit';
        $id = ___decrypt($id);
        $data['tax'] = _arefy(Tax::where('id',$id)->first());
        // dd($data['tax']);
        return view('admin.home',$data);
    }

    public function taxPercentEditForm(Request $request,$id)
    {
        $data['view'] = 'admin.configuration.tax.taxpercentedit';
        $id = ___decrypt($id);
        $data['taxpercent'] = _arefy(Tax_Percent::where('id',$id)->first());
        $data['taxname'] = _arefy(Tax::where('status', '=', 'active')->get());
        // dd($data['taxname']);
        return view('admin.home',$data);
    }

    public function taxPercentEdit(Request $request,$id)
    {
        $id = ___decrypt($id);
        $validation = new Validations($request);
        $validator  = $validation->addTaxPercentage();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $tax = Tax_Percent::findOrFail($id);
            $input = $request->all();

            $tax->update($input);
              $this->status   = true;
              $this->modal    = true;
              $this->alert    = true;
              $this->message  = "Tax Percentage has been Updated successfully.";
              $this->redirect = url('admin/taxpercent');
        }
        return $this->populateresponse();
    }

    public function unitsEditForm(Request $request,$id)
    {
        $data['view'] = 'admin.configuration.units.edit';
        $id = ___decrypt($id);
        $data['units'] = _arefy(Units::where('id',$id)->first());
        // dd($data['tax']);
        return view('admin.home',$data);
    }

    public function unitEdit(Request $request, $id)
    {   
        $id = ___decrypt($id);
        $validation = new Validations($request);
        $validator  = $validation->addUnits();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $units = Units::findOrFail($id);
            $input = $request->all();

            $units->update($input);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Unit has been Updated successfully.";
            $this->redirect = url('admin/units');
        }
            return $this->populateresponse();
    }

    public function taxEdit(Request $request, $id)
    {   
        $id = ___decrypt($id);
        $validation = new Validations($request);
        $validator  = $validation->addTax();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $tax = Tax::findOrFail($id);
            $input = $request->all();

            $tax->update($input);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Tax has been Updated successfully.";
            $this->redirect = url('admin/tax');
        }
            return $this->populateresponse();
    }

    public function changeStatus(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Currencies::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Currencies successfully.';
            }else{
                $this->message = 'Updated Currencies successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }

    public function changeStatusTax(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Tax::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Tax successfully.';
            }else{
                $this->message = 'Updated Tax successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }

    public function changeStatusUnits(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Units::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Units successfully.';
            }else{
                $this->message = 'Updated Units successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }

    public function changeStatusTaxPercent(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Tax_Percent::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Tax Percentage successfully.';
            }else{
                $this->message = 'Updated Tax Percentage successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }

}
