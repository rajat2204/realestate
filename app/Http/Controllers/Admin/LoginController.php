<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Validations\Validate as Validations;
use Auth;

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

               if(Auth::user()->user_type == 'super-admin'){

                    $this->status   = true;
                    $this->modal    = true;
                    $this->alert    = true;
                    $this->message  = "Login Successfull!";
                    $this->redirect = url('admin/home');
               }else{
                    \Session::flush();
                    $this->message  =  $validator->errors()->add('not_exists', 'you are not authorised user.');
                    return $this->populateresponse();
               }
            }
            else{
                    $this->message  =  $validator->errors()->add('not_exists', 'User Email or Password is Incorrect.');
                } 
        }
        return $this->populateresponse();
    }

    public function home(Request $request)
    {
    	$data['view'] = 'admin.dashboard';
        return view('admin.home',$data);
    }
}
