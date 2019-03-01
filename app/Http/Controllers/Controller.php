<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Perks\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(Request $request){
        $this->jsondata         = (object)[];
        $this->message          = "";
        $this->error_code       = "no_error_found";
        $this->status           = false;
        $this->status_code      = 200;
        $this->redirect         = false;
        $this->modal            = false;
        $this->alert            = false;
        $this->successimage     = asset('assets/img/success.png');
        $this->ajax             = 'api';
        
        if($request->ajax()){
            $this->ajax = 'web';
        }

        $json = json_decode(file_get_contents('php://input'),true);
        if(!empty($json)){
            $this->post = $json;
        }else{
            $this->post = $request->all();
        }

        $request->replace($this->post);
    }    

    protected function populateresponse(){
        if(empty($this->status)){
            $data['status']     = $this->status;
            $response = new Response($this->message);
            if($this->ajax == 'api'){
                $data['errors']     = $response->api_error_response();
                $data = json_decode(json_encode($data),true);

                if(empty($this->jsondata)){
                    $data['data'] = (object) $this->jsondata;
                }
                $data['status_code'] = $this->status_code = 200;
                $data['error_code']  = $this->error_code;
                return $data;
            }else{
                $data['errors']     = $response->web_error_response();
                return ([
                    'data'          => $data['errors'],
                    'status'        => $this->status,
                    'status_code'   => $this->status_code,
                    'message'       => $this->message,
                    'nomessage'     => true,
                    'modal'         => $this->modal,
                    'successimage'  => $this->successimage,
                ]);                
            }
        }else{
            if($this->ajax == 'api'){
                return [
                    'status'        => $this->status,
                    'status_code'   => $this->status_code,
                    'data'          => $this->jsondata,
                    'message'       => $this->message,
                ]; 
            }else{
                return [
                    'status'        => $this->status,
                    'status_code'   => $this->status_code,
                    'redirect'      => $this->redirect,
                    'data'          => $this->jsondata,
                    'modal'         => $this->modal,
                    'successimage'  => $this->successimage,
                    'message'       => $this->message,
                    'alert'         => $this->alert,
                ];  
            }
        }        
    } 
}
