<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use App\Models\Project;
use App\Models\Inventory;
use App\Models\Inventory_balance;
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
                if ($item['status'] != 'empty'){
                  $html   .= '<a href="'.url(sprintf('admin/inventory/entry/%s',___encrypt($item['id']))).'"  title="Make Entry"><i class="fa fa-plus"></i></a> | ';
                }
                $html   .= '<a href="'.url(sprintf('admin/showinventory/%s',___encrypt($item['id']))).'"  title="Show Inventory"><i class="fa fa-eye"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/inventory/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
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
            ->addColumn(['data' => 'quantity','name' => 'quantity','title' => 'Quantity','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'balance','name' => 'balance','title' => 'Balance Due','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'remarks','name' => 'remarks','title' => 'Remarks','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function showInventoryEntry(Request $request, Builder $builder,$id){
        $data['view'] = 'admin.inventory.entrylist';
        
        $id = ___decrypt($id);
        $enrtyList  = _arefy(Inventory_balance::where('inventory_id',$id)->get());

        if ($request->ajax()) {
            return DataTables::of($enrtyList)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                // $html   .= '<a href="javascript:void(0);" 
                //         data-url="'.url(sprintf('admin/showinventory/status/?id=%s&status=trashed',$item['id'])).'" 
                //         data-request="ajax-confirm"
                //         data-ask_image="'.url('assets/img/delete.png').'"
                //         data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a>';
                $html   .= '</div>';
                                
                return $html;
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
            ->addColumn(['data' => 'date','name' => 'date','title' => 'Entry Date','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'qty','name' => 'qty','title' => 'Quantity','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'remarks','name' => 'remarks','title' => 'Remarks','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120]);
            // ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
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
          $data = new Inventory();
          $data->fill($request->all());
          if ($data['balance'] != 0) {
            $data['status'] = 'available';
          }else{
            $data['status'] = 'empty';
          }

          $data->save();

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Inventory has been Added successfully.";
            $this->redirect = url('admin/inventory');
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
        $data['view'] = 'admin.inventory.edit';
        $id = ___decrypt($id);
        $where = 'id = '.$id;
        $data['inventory'] = _arefy(Inventory::list('single',$where));
        $data['project'] = _arefy(Project::where('status', '=', 'active')->get());
        $data['expensecategory'] = _arefy(ExpenseCategory::where('status', '=', 'active')->get());
        $data['vendor'] = _arefy(Vendor::where('status', '=', 'active')->get());
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
        $validator  = $validation->addInventory();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
          $inventory = Inventory::findOrFail($id);
          $input = $request->all();

          if ($input['balance'] != 0) {
            $input['status'] = 'available';
          }else{
            $input['status'] = 'empty';
          }

          $inventory->update($input);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Inventory has been Updated successfully.";
            $this->redirect = url('admin/inventory');
        }
          return $this->populateresponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function makeEntry(Request $request,$id){
      $data['view'] = 'admin.inventory.entry';
      $id = ___decrypt($id);
      $where = 'id = '.$id;
      $data['inventory'] = _arefy(Inventory::list('single',$where));      
      // dd($data['inventory']);
      return view('admin.home',$data);
    }

    public function makeEntryInventory(Request $request, $id){
      $id = ___decrypt($id);
      $validation = new Validations($request);
      $validator  = $validation->makeEntryBalance();
      if ($validator->fails()) {
        $this->message = $validator->errors();
      }else{
          $entry = new Inventory_balance();
          $entry->fill($request->all());

          $entry->save();

          $getBalance = Inventory::where('id',$id)->first();
          $bal['balance'] = $getBalance['balance']-$request->qty;
          if ($bal['balance'] != 0) {
            $bal['status'] = 'available';
          }else{
            $bal['status'] = 'empty';
          }
          $upd = Inventory::where('id',$id)->update($bal);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Inventory Quantity has been Added successfully.";
            $this->redirect = url('admin/inventory');
        }
          return $this->populateresponse();
      }

    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Inventory::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Inventory successfully.';
            }else{
                $this->message = 'Updated Inventory successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }

    public function changeStatusEntry(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Inventory_balance::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Inventory Entry successfully.';
            }else{
                $this->message = 'Updated Inventory Entry successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }
}
