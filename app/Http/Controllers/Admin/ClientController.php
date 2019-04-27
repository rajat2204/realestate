<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Users;
use App\Models\Clients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class ClientController extends Controller
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
        $data['view'] = 'admin.clients.list';
        
        $clients  = _arefy(Clients::where('status','!=','trashed')->get());
       
        if ($request->ajax()) {
            return DataTables::of($clients)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/client/%s/changepassword',___encrypt($item['id']))).'"  title="Change Password"><i class="fa fa-cog"></i></a> | ';
                $html   .= '<a href="'.url(sprintf('admin/client/%s/edit',___encrypt($item['id']))).'"  title="Edit Detail"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/client/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> | ';
                if($item['status'] == 'active'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/client/status/?id=%s&status=inactive',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/inactive-user.png').'"
                        data-ask="Would you like to change '.$item['name'].' status from Active to Inactive?" title="Update Status"><i class="fa fa-fw fa-ban"></i></a>';
                }
                elseif($item['status'] == 'inactive'){
                    $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/client/status/?id=%s&status=active',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/active-user.png').'"
                        data-ask="Would you like to change '.$item['name'].' status from Inactive to Active?" title="Update Status"><i class="fa fa-fw fa-check"></i></a>';
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
                return '+91-'.' ' .($item['phone']);
            })
            ->editColumn('dob',function($item){
                if (!empty($item['dob'])) {
                    return $item['dob'];
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('address',function($item){
                if (!empty($item['address'])) {
                    return $item['address'];
                }else{
                    return 'N/A';
                }
            })
            ->editColumn('photo',function($item){
                if(!empty($item['photo'])){
                    $imageurl = asset("assets/img/Clients/".$item['photo']);
                    return '<img src="'.$imageurl.'" height="70px" width="100px">';
                }else{
                    $imageurl = asset("assets/img/avatar.png");
                    return '<img src="'.$imageurl.'" height="70px" width="100px">';
                }
            })
            ->rawColumns(['photo','action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-6'l><'col-md-6 col-sm-12 col-xs-6'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'photo', 'name' => 'photo',"render"=> 'data','title' => 'Client photo','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Client Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'Client E-mail','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'phone', 'name' => 'phone','title' => 'Client Mobile','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'dob', 'name' => 'dob','title' => 'Client DOB','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'address', 'name' => 'address','title' => 'Client Address','orderable' => false, 'width' => 120])
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
        $data['view'] = 'admin.clients.add';
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
        $validator  = $validation->addClient();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $clientdata['first_name']           = !empty($request->name)?$request->name:'';
            $clientdata['username']             = !empty($request->email)?$request->email:'';
            $clientdata['email']                = !empty($request->email)?$request->email:'';
            $clientdata['phone']                = !empty($request->phone)?$request->phone:'';
            $clientdata['password']             = Hash::make(!empty($request->password)?$request->password:'');
            $clientdata['user_type']            = 'user';
            $clientdata['remember_token']       = str_random(60).$request->remember_token;
            $clientdata['created_at']           = date('Y-m-d H:i:s');
            $clientdata['updated_at']           = date('Y-m-d H:i:s');

            $client_data = Users::add($clientdata);

            $client = new Clients();
            $username="AMREESH@25"; 
            $password="AMREESH@25";
            $sender="AMRESH";

            $message = "Dear Customer ". $request->name . ", your login credentials for our portal are:->
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
            
            $request['user_id'] = $client_data;
            $request['password'] = Hash::make($request['password']);

            $client->fill($request->all());

            if ($file = $request->file('photo')){
                $photo_name = time().$request->file('photo')->getClientOriginalName();
                $file->move('assets/img/Clients',$photo_name);
                $client['photo'] = $photo_name;
            }
            if ($file = $request->file('id_proof')){
                $id_proof = time().$request->file('id_proof')->getClientOriginalName();
                $file->move('assets/img/Id Proof',$id_proof);
                $client['id_proof'] = $id_proof;
            }
            if ($file = $request->file('address_proof')){
                $address_proof = time().$request->file('address_proof')->getClientOriginalName();
                $file->move('assets/img/Address Proof',$address_proof);
                $client['address_proof'] = $address_proof;
            }
            $client->save();

            

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Client has been Added successfully.";
            $this->redirect = url('admin/client');
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
        $data['view'] = 'admin.clients.edit';
        $id = ___decrypt($id);
        $where = ' id = '.$id;
        $data['clients'] = _arefy(Clients::list('single',$where));
        // dd($data['clients']);
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
        $validator  = $validation->addClient('edit');
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $client = Clients::findOrFail($id);
            $input = $request->all();

            if ($file = $request->file('photo')){
                $photo_name = time().$request->file('photo')->getClientOriginalName();
                $file->move('assets/img/Clients',$photo_name);
                $input['photo'] = $photo_name;
            }
            if ($file = $request->file('id_proof')){
                $id_proof = time().$request->file('id_proof')->getClientOriginalName();
                $file->move('assets/img/Id Proof',$id_proof);
                $input['id_proof'] = $id_proof;
            }
            if ($file = $request->file('address_proof')){
                $address_proof = time().$request->file('address_proof')->getClientOriginalName();
                $file->move('assets/img/Address Proof',$address_proof);
                $input['address_proof'] = $address_proof;
            }

            $client->update($input);

                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Client has been Updated successfully.";
                $this->redirect = url('admin/client');
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

    public function changePassword($id)
    {
      $data['view'] = 'admin.clients.changepassword';
      $id = ___decrypt($id);
      $where = 'id = '.$id;
      $data['client'] = _arefy(Clients::list('single',$where));
      return view('admin.home',$data);
    }

    public function changePasswordForm(Request $request,$id)
    {
      $id = ___decrypt($id);
      $validation = new Validations($request);
        $validator  = $validation->changepassword();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
          $client = Clients::findOrFail($id);
          if ($request->password){
            if (Hash::check($request->password, $client->password)){
                if ($request->new_password == $request->confirm_password){
                    $input['password'] = Hash::make($request->new_password);
                }else{
                    $this->message  =  $validator->errors()->add('confirm_password', 'Confirm Password Does not match.');
                    return $this->populateresponse();
                }
            }else{
                $this->message  =  $validator->errors()->add('confirm_password', 'Current Password Does not match.');
                    return $this->populateresponse();
            }
        }
        $client->update($input);
       
        $this->message = 'Client Password has been Updated Successfully.';
        $this->modal    = true;
        $this->alert    = true;
        $this->status   = true;
        $this->redirect = url('admin/client');
    }
    return $this->populateresponse();
  }

    public function changeStatus(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Clients::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted Clients successfully.';
            }else{
                $this->message = 'Updated Clients successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }
}
