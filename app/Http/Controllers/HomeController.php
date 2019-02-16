<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Agents;
use App\Models\Contact;
use App\Models\Services;
use App\Models\ContactUs;
use App\Models\SocialMedia;
use App\Models\Subscribers;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use App\Models\PropertyCategories;
use App\Http\Controllers\Controller;
use Validations\Validate as Validations;

class HomeController extends Controller
{
    public function __construct(Request $request){
        parent::__construct($request);
    }

    public function index(Request $request){
    	$data['view']='front.index';
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $data['testimonial'] = _arefy(Testimonials::where('status','active')->get());
        $data['agent'] = _arefy(Agents::where('status','active')->get());
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['categories'] = _arefy(PropertyCategories::where('status','active')->get());
        $where = 'featured = "1" AND status = "active"';
        $data['property'] = _arefy(Property::list('array',$where,['*'],'id-desc',6));
        $data['property_featured'] = _arefy(Property::list('array',$where,['*'],'id-desc'));
        $where = 'status = "active"';
        $data['service'] = _arefy(Services::list('array',$where,['*'],'id-asc',6));
        $data['service_load'] = _arefy(Services::list('array',$where,['*'],'id-asc'));
		return view('front_home',$data);
    }

    public function featuredProperty(Request $request)
    {
        $data['view']='front.all-featured-properties';
        $where = 'featured = "1" AND status = "active"';
        $data['property_featured'] = _arefy(Property::list('array',$where,['*'],'id-desc'));
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        return view('front_home',$data);
    }

    public function allServices(Request $request)
    {
        $data['view']='front.all-services';
        $where = 'status = "active"';
        $data['service_load'] = _arefy(Services::list('array',$where,['*'],'id-asc'));
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        return view('front_home',$data);
    }

    public function singlePlotView(Request $request)
    {
        $data['view'] = 'front.single-plot-view';
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        return view('front_home',$data);
    }

    public function aboutUs(Request $request){
    	$data['view']='front.aboutus';
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
		return view('front_home',$data);
    }

    public function contactUs(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->createContactUs();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['name']               =!empty($request->name)?$request->name:'';
            $data['email']              =!empty($request->email)?$request->email:'';
            $data['subject']            =!empty($request->subject)?$request->subject:'';
            $data['message']            =!empty($request->message)?$request->message:'';
            
            $inserId = ContactUs::add($data);
            if($inserId){
               $emailData               = ___email_settings();
               $emailData['name']       = !empty($request->name)?$request->name:'';
               $emailData['email']      = !empty($request->email)?$request->email:'';
               $emailData['subject']    = !empty($request->subject)?$request->subject:'';
               $emailData['message']    = !empty($request->message)?$request->message:'';
               $emailData['date']       = date('Y-m-d H:i:s');

               $emailData['custom_text'] = 'Your Enquiry has been submitted successfully';
               ___mail_sender($emailData['email'],$request->name,"enquiry_email",$emailData);

                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Enquiry has been submitted successfully.";
                $this->redirect = url('/');
            }
        }
        return $this->populateresponse();
    }

    public function Subscribe(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->subscriber();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $data['email']               = !empty($request->email)?$request->email:'';
            $data['created_at']          = date('Y-m-d H:i:s');
            $data['updated_at']          = date('Y-m-d H:i:s');

            $subscribe = Subscribers::add($data);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "You are subscribed successfully.";
            $this->redirect = url('/');
            }
        return $this->populateresponse();
    }
}
