<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Users;
use App\Models\Agents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Models\Agents_Wallets;
use Validations\Validate as Validations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;

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
            ->editColumn('phone',function($item){
                return '+91-' .$item['phone'];
            })
            ->editColumn('spouse_name',function($item){
                if(!empty($item['spouse_name'])){
                    return ucfirst($item['spouse_name']);
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('nominee',function($item){
                if(!empty($item['nominee'])){
                    return ucfirst($item['nominee']);
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('adhaar',function($item){
                if(!empty($item['adhaar'])){
                    return ucfirst($item['adhaar']);
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('address',function($item){
                if(!empty($item['address'])){
                    return ucfirst($item['address']);
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('balance',function($item){
                if($item['balance'] != NULL){
                  return 'Rs.'. ' ' .($item['balance']);
                }else{
                  return 'Rs.'. ' ' .'0';
                }
            })
            ->editColumn('image',function($item){
                if (!empty($item['image'])) {
                    $imageurl = asset("assets/img/agent/".$item['image']);
                    return '<img src="'.$imageurl.'" height="100px" width="120px">';
                }else{
                    $imageurl = asset("assets/img/avatar.png");
                    return '<img src="'.$imageurl.'" height="70px" width="100px">';
                }
            })
            ->rawColumns(['image','action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-6'l><'col-md-6 col-sm-12 col-xs-6'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'image', 'name' => 'image',"render"=> 'data','title' => 'Agent Image','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'agent_id', 'name' => 'agent_id','title' => 'Agent ID','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Agent Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'spouse_name', 'name' => 'spouse_name','title' => 'Agents Spouse Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'nominee', 'name' => 'nominee','title' => 'Agents Nominee','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'adhaar', 'name' => 'adhaar','title' => 'Agents Adhaar Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'Agent E-mail','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'phone', 'name' => 'phone','title' => 'Agent Mobile','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'address', 'name' => 'address','title' => 'Agent Address','orderable' => false, 'width' => 120])
             ->addColumn(['data' => 'balance','name' => 'balance','title' => 'Balance','orderable' => false, 'width' => 120])           
            ->addColumn(['data' => 'status','name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function exportAgent(Request $request, Builder $builder){
        $agent  = _arefy(Agents::where('status','!=','trashed')->get());
        // dd($agent);
        $type='xlsx';
        $excel_name='agents_data';
        Excel::create($excel_name, function($excel) use ($agent) {
                $excel->sheet('mySheet', function($sheet) use ($agent){
                    $headings = [
                        'Agent Name',
                        'Agents Spouse Name',
                        'Agents Nominee',
                        'Agents Adhaar Number',
                        'Agents E-mail',
                        'Agents Contact',
                        'Agents Address',
                        'Balance',
                    ];

                    $sheet->row(1, $headings);
                    $sheet->cell('A1:I1', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $total=count($agent)+1;
                    $sheet->setBorder('A1:I'.$total, 'thin');

                    $i=2;
                    $j=1;
                    foreach ($agent as $key => $value) {
                        if($value){
                            
            
                            $sheet->row($i,[
                                ucfirst($value['name']),
                                ucfirst($value['spouse_name']),
                                ucfirst($value['nominee']),
                                $value['adhaar'],
                                $value['email'],
                                $value['phone'],
                                $value['address'],
                                'Rs.'.number_format($value['balance']),
                            ]);
                        }
                        $i++;
                        $j++;
                    }
                });
            })->download($type);
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
                if($item['amount'] != NULL){
                  return 'Rs.'. ' ' .($item['amount']);
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
             ->addColumn(['data' => 'amount','name' => 'amount','title' => 'Amount','orderable' => false, 'width' => 120])
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
            $agentsdata['first_name']           = !empty($request->name)?$request->name:'';
            $agentsdata['username']             = !empty($request->email)?$request->email:'';
            $agentsdata['email']                = !empty($request->email)?$request->email:'';
            $agentsdata['phone']                = !empty($request->phone)?$request->phone:'';
            $agentsdata['password']             = Hash::make(!empty($request->password)?$request->password:'');
            $agentsdata['user_type']            = 'agent';
            $agentsdata['remember_token']       = str_random(60).$request->remember_token;
            $agentsdata['created_at']           = date('Y-m-d H:i:s');
            $agentsdata['updated_at']           = date('Y-m-d H:i:s');

            $agent_data = Users::add($agentsdata);
            
            $data = new Agents();
            
            $username="AMREESH@25"; 
            $password="AMREESH@25";
            $sender="AMRESH";

            $message = "Dear Agent ". $request->name . ", your login credentials for our portal are:->
            Username: " . $request->phone .
            "Password: " . $request->password . 
            " Thanks and Regards, -DevDrishti Infrahomes Pvt. Ltd.";

            $pingurl = "skycon.bulksms5.com/sendmessage.php";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $pingurl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'user=' . $username . '&password=' . $password . '&mobile=' . $request->phone . '&message=' . urlencode($message) . '&sender=' . $sender . '&type=3');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            $request['user_id'] = $agent_data;
            $request['password'] = Hash::make($request['password']);

            $data->fill($request->all());

            if ($file = $request->file('image')){
                $photo_name = time().$request->file('image')->getClientOriginalName();
                $file->move('assets/img/agent',$photo_name);
                $data['image'] = $photo_name;
            }

            $data->save();

            $lastid = $data->id;

            $agentId['agent_id'] = "DIH00" . $lastid;

            $data = Agents::change($lastid,$agentId);

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
       // dd($data['agent']);
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
            $data['phone']=$request->phone;
            $data['amount']=$request->amount;
            $data['action']=$request->action;
             //to deduct on selecting action[deduct] and Add on selecting action[add] 
            if($data['action']=='deduct' )
            {
                $balance = $request->balance-$request->amount;
            }elseif($data['action']=='add'){
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
