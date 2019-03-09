<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use App\Models\Project;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Validations\Validate as Validations;

class InventoryController extends Controller
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
        $data['view'] = 'admin.inventory.list';
        
        $where = 'status != "trashed"';
        $inventory  = _arefy(Inventory::list('array',$where));

        if ($request->ajax()) {
            return DataTables::of($inventory)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/inventory/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/inventory/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/inventory/status/?id=%s&status=inactive',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/inactive-user.png').'"
                        data-ask="Would you like to change status from Active to Inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a>';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/inventory/status/?id=%s&status=active',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/active-user.png').'"
                        data-ask="Would you like to change status from Inactive to Active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
                }
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('project_id',function($item){
                return ucfirst($item['project']['name']);
            })
            ->editColumn('category_id',function($item){
                return ucfirst($item['expensecategory']['name']);
            })
            ->editColumn('vendor_id',function($item){
                return ucfirst($item['vendor']['name']);
            })
            ->editColumn('invoice_no',function($item){
              if (!empty($item['invoice_no'])) {
                return $item['invoice_no'];
              }else{
                return 'N/A';
              }
            })
            ->editColumn('invoice_date',function($item){
              if (!empty($item['invoice_date'])) {
                return $item['invoice_date'];
              }else{
                return 'N/A';
              }
            })
            ->editColumn('remarks',function($item){
              if (!empty($item['remarks'])) {
                return str_limit(strip_tags($item['remarks']),30);
              }else{
                return 'N/A';
              }
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'project_id','name' => 'project_id','title' => 'Project Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'category_id','name' => 'category_id','title' => 'Category Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'vendor_id','name' => 'vendor_id','title' => 'Vendor/Staff','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_no','name' => 'invoice_no','title' => 'Invoice No.','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'invoice_date','name' => 'invoice_date','title' => 'Invoice Date','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'amount','name' => 'amount','title' => 'Quantity','orderable' => false, 'width' => 120])
            // ->addColumn(['data' => '','name' => '','title' => 'Balance Due','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'remarks','name' => 'remarks','title' => 'Remarks','orderable' => false, 'width' => 120])
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
        $data['view'] = 'admin.inventory.add';
        $data['project'] = _arefy(Project::where('status', '=', 'active')->get());
        $data['expensecategory'] = _arefy(ExpenseCategory::where('status', '=', 'active')->get());
        $data['vendor'] = _arefy(Vendor::where('status', '=', 'active')->get());
        return view('admin.home',$data);
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
        $validator  = $validation->addInventory();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
          $data = new Expense();
          $data->fill($request->all());
          
          $data->save();

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Expense has been Added successfully.";
            $this->redirect = url('admin/expenses');
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
        //
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
}
