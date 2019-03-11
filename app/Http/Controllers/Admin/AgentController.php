<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;
use App\Models\Agents_Wallets;

class AgentController extends Controller
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
        $data['view'] = 'admin.agents.list';
        
        $agent  = _arefy(Agents::where('status','!=','trashed')->get());
       
        if ($request->ajax()) {
            return DataTables::of($agent)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';

                $html   .= '<a href="'.url(sprintf('admin/agent/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="'.url(sprintf('admin/agent/wallet/%s',___encrypt($item['id']))).'"  title="Wallet"><i class="fa fa-shopping-cart"></i></a> | ';

                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/agent/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/agent/status/?id=%s&status=inactive',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['name'].' status from Active to Inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a>';
                }elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/agent/status/?id=%s&status=active',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/active-user.png').'"
                        data-ask="Would you like to change '.$item['name'].' status from Inactive to Active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a> | ';
                }
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('name',function($item){
                return ucfirst($item['name']);
            })
            ->editColumn('balance',function($item){
                if($item['balance'] != NULL){
                  return 'Rs.'. ' ' .($item['balance']);
                }else{
                  return 'Rs.'. ' ' .'0';
                }
            })
            ->editColumn('image',function($item){
                $imageurl = asset("assets/img/agent/".$item['image']);
                return '<img src="'.$imageurl.'" height="100px" width="120px">';
            })
            ->rawColumns(['image','action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'image', 'name' => 'image',"render"=> 'data','title' => 'Agent Image','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Agent Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'Agent E-mail','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'mobile', 'name' => 'mobile','title' => 'Agent Mobile','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'address', 'name' => 'address','title' => 'Agent Address','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'designation', 'name' => 'designation','title' => 'Agent Designation','orderable' => false, 'width' => 120])
             ->addColumn(['data' => 'balance','name' => 'balance','title' => 'Balance','orderable' => false, 'width' => 120])           
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function walletHistory(Request $request, Builder $builder){
        $data['view'] = 'admin.agents.wallet_history';
        
        $wallet_history  = _arefy(Agents_Wallets::where('status','!=','trashed')->get());
       // dd($wallet_history);
        if ($request->ajax()) {
            return DataTables::of($wallet_history)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('balance',function($item){
                if($item['balance'] != NULL){
                  return 'Rs.'. ' ' .($item['balance']);
                }else{
                  return 'Rs.'. ' ' .'0';
                }
            })
            ->editColumn('action',function($item){
                if($item['action'] == 'add'){
                  return 'CR';
                }else{
                  return 'DR';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            // ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Agent Name','orderable' => false, 'width' => 120])
             ->addColumn(['data' => 'balance','name' => 'balance','title' => 'Amount','orderable' => false, 'width' => 120])
             ->addColumn(['data' => 'action','name' => 'action','title' => 'Action','orderable' => false, 'width' => 120]);
             // ->addColumn(['data' => 'created_at','name' => 'created_at','title' => 'Created AT','orderable' => false, 'width' => 120]);
            // ->addAction(['title' => '', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['view'] = 'admin.agents.add';
        return view('admin.home',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->addAgent();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data = new Agents();
            $data->fill($request->all());

            if ($file = $request->file('image')){
                $photo_name = time().$request->file('image')->getClientOriginalName();
                $file->move('assets/img/agent',$photo_name);
                $data['image'] = $photo_name;
            }

            $data->save();

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Agent has been Added successfully.";
            $this->redirect = url('admin/agent');  
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
        $data['view'] = 'admin.agents.edit';
        $id = ___decrypt($id);
        $data['agent'] = _arefy(Agents::where('id',$id)->first());
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
        $validator  = $validation->addAgent('edit');
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }
        else{
            $agent = Agents::findOrFail($id);
            $data = $request->all();

            if ($file = $request->file('image')){
                $photo_name = time().$request->file('image')->getClientOriginalName();
                $file->move('assets/img/agent',$photo_name);
                $data['image'] = $photo_name;
            }
            $agent->update($data);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Agent has been Updated successfully.";
            $this->redirect = url('admin/agent');
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
        $isUpdated               = Agents::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Agent successfully.';
            }else{
                $this->message = 'Updated Agent successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }
    
    public function wallet_history(Request $request,$id)
    
    {
        $data['view'] = 'admin.agents.wallet_history';
        $id = ___decrypt($id);
        $data['agent'] = _arefy(Agents::where('id',$id)->first());
        return view('admin.home',$data);
    }


    public function wallet(Request $request,$id)
    {
        $data['view'] = 'admin.agents.wallet';
        $id = ___decrypt($id);
        $data['agent'] = _arefy(Agents::where('id',$id)->first());
        return view('admin.home',$data);
    }

    public function walletAmount(Request $request, $id)
    {
      $id = ___decrypt($id);
      $validation = new Validations($request);
      $validator  = $validation->addWallet();
      
      if ($validator->fails()) {
            $this->message = $validator->errors();
        }
        else{
            $data['agents_id']=$request->agent_id;
            $data['email']=$request->email;
            $data['mobile']=$request->mobile;
            $data['amount']=$request->amount;
            $data['action']=$request->action;
         //to deduct on selecting action[deduct] and Add on selecting action[add] 

            if($data['action']=='deduct' )
            {
                $balance = $request->balance-$request->amount;
            }else{
                $balance = $request->balance+$request->amount;
            }
            $data['balance']=$balance;
            $data['remarks']=$request->remarks;
            $data['status']='active';
            $data['created_at']=$request->created_at;
            $data['updated_at']=$request->updated_at;
            
            Agents_Wallets::insert($data);
            $balan['balance']=$balance;
            Agents::where('id',$request->agent_id)->update($balan);
            $this->status   = true;
            $this->modal =true;
            $this->alert    = true;
            $this->message  = "Wallet has been Updated successfully.";
            $this->redirect = url('admin/agent');

          }

        return $this->populateresponse();
    }


}
