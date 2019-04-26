<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use App\Models\Users;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Validations\Validate as Validations;

class LoginController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function login(){
    	return view('admin/login');
    }

    public function authentication(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->login();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
             if (\Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
               if(Auth::user()->user_type != NULL){
                    $this->status   = true;
                    $this->modal    = true;
                    $this->alert    = true;
                    $this->message  = "Successfully Logged In!!!";
                    $this->redirect = url('admin/home');
               }else{
                    \Session::flush();
                    $this->message  =  $validator->errors()->add('not_exists', 'You are not authorised user.');
                    return $this->populateresponse();
                 }
              }
            else{
                    $this->message  =  $validator->errors()->add('not_exists', 'User Email or Password is Invalid.');
                } 
        }
        return $this->populateresponse();
    }

    public function home(Request $request)
    {
    	$data['view'] = 'admin.dashboard';
        return view('admin.home',$data);
    }

    public function changePassword(Request $request){
        $data['view'] = 'admin.changepassword';
        $data['admin'] = _arefy(Users::find(Auth::user()->id));
        return view('admin.home',$data);
    }

    public function adminchangePass(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->changepassword();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
          $user = Users::findOrFail(Auth::user()->id);
          if ($request->password){
            if (Hash::check($request->password, $user->password)){
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
        $user->update($input);
       
        $this->message = 'Admin Password has been Updated Successfully.';
        $this->modal    = true;
        $this->alert    = true;
        $this->status = true;
        $this->redirect = url('admin/changepassword');
     }
        return $this->populateresponse();
    }
}
