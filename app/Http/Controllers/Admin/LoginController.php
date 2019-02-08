<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function login(){
    	return view('admin/login');
    }

    public function home(Request $request)
    {
    	$data['view'] = 'admin.dashboard';
        return view('admin.home',$data);
    }
}
