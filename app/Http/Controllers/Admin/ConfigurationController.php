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

class ConfigurationController extends Controller
{

 public function __construct(Request $request)
{
    parent::__construct($request);
} 	
  public function index(Request $request, Builder $builder){
        $data['view'] = 'admin.configuration.currencies.list';
        
        $currencies  = _arefy(Currencies::where('status','!=','trashed')->get());
       
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
public function createCurrencies()
   {
      $data['view'] = 'admin.configuration.currencies.add';
      return view('admin.home',$data);
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

   //************** Help page section************   
   public function help(Request $request)
   {
   	$data['view'] = 'admin.help.help';
   	return view('admin.home',$data);	
   }

}
