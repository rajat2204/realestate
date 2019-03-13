<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currencies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;
use App\Models\Tax;
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
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'rownum', 'name' => 'rownum','title' => 'S No','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'currency_name', 'name' => 'currency_name','title' => 'Currency Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'image', 'name' => 'image','title' => 'Currency Image','orderable' => false, 'width' => 120])
            // ->addColumn(['data' => 'dob', 'name' => 'dob','title' => 'Currency','orderable' => false, 'width' => 120])
           
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
            return view('admin.home')->with($data);
    }

 public function general(Request $request)
   {
   	 $data['view'] = 'admin.configuration.general';
        return view('admin.home',$data);

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
                $html   .= '<a href="'.url(sprintf('admin/tax/%s/edit',___encrypt($item['id']))).'"  title="Edit Tax"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/tax/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('tax_name',function($item){
              
                return ucfirst($item['tax_name']);
            })
        
            ->make(true);
        }
        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'rownum', 'name' => 'rownum','title' => 'S No','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'tax_name', 'name' => 'tax_name','title' => 'Tax Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'tax_percentage', 'name' => 'tax_percentage','title' => 'Tax Percentage','orderable' => false, 'width' => 120])          
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

}
