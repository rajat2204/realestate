<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(Request $request){
        parent::__construct($request);
    }

    public function index(Request $request){
    	$data['view']='front.index';
		return view('front_home',$data);
    }

    public function aboutUs(Request $request){
    	$data['view']='front.aboutus';
		return view('front_home',$data);
    }
}
