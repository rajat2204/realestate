<?php

namespace App\Http\Controllers;

use App\Models\Agents;
use App\Models\Notice;
use App\Models\Contact;
use App\Models\Sliders;
use App\Models\Enquiry;
use App\Models\Services;
use App\Models\Property;
use App\Models\ContactUs;
use App\Models\Subscribers;
use App\Models\SocialMedia;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use App\Models\PropertyCategories;
use App\Http\Controllers\Controller;
use Validations\Validate as Validations;

class HomeController extends Controller{
    public function __construct(Request $request){
        parent::__construct($request);
    }

    public function index(Request $request){
    	$data['view']='front.index';
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $where = 'status = "active"';
        $data['testimonial'] = _arefy(Testimonials::list('array',$where,['*'],'id-desc',9));
        $data['agent'] = _arefy(Agents::where('status','active')->get());
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['categories'] = _arefy(PropertyCategories::where('status','active')->get());
        $where = 'featured = "1" AND status = "active"';
        $data['property'] = _arefy(Property::list('array',$where,['*'],'id-desc',6));
        $data['property_featured'] = _arefy(Property::list('array',$where,['*'],'id-desc'));
        $where = 'status = "active"';
        $data['remarkablework'] = _arefy(Property::list('array',$where,['*'],'id-desc',9));
        $where = 'status = "active"';
        $data['service'] = _arefy(Services::list('array',$where,['*'],'id-asc',6));
        $data['notice'] = _arefy(Notice::list('array',$where,['*'],'id-desc',3));
        $data['service_load'] = _arefy(Services::list('array',$where,['*'],'id-asc'));
		return view('front_home',$data);
    }

    public function featuredProperty(Request $request){
        $data['view'] = 'front.all-featured-properties';
        $where = 'featured = "1" AND status = "active"';
        $data['property_featured'] = _arefy(Property::list('array',$where,['*'],'id-desc'));
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        return view('front_home',$data);
    }

    public function remarkableWork(Request $request){
        $where = 'status = "active"';
        if($request->value !='all'){
            $where.=' AND property_type = '."'$request->value'";
        }
        $data['remarkablework'] = _arefy(Property::list('array',$where,['*'],'id-desc'));
        $html = view('front.ajaxremarkablework',$data);
        return response($html);
    }

    public function allServices(Request $request){
        $data['view']='front.all-services';
        $where = 'status = "active"';
        $data['service_load'] = _arefy(Services::list('array',$where,['*'],'id-asc'));
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        return view('front_home',$data);
    }

    public function singlePlotView(Request $request,$slug){
        $data['view'] = 'front.single-plot-view';
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $where = 'slug = "'.$slug.'"';
        $data['property'] = _arefy(Property::list('single',$where));
        // dd($data['property']);
        return view('front_home',$data);
    }

    public function allProperties(Request $request){
        $where = 'status = "active"';
        $data['property'] = _arefy(Property::list('array',$where,['*'],'id-desc'));
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['view'] = 'front.allproperties';
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        return view('front_home',$data);
    }

    public function testimonials(Request $request){
        $where = 'status = "active"';
        $data['testimonial'] = _arefy(Testimonials::list('array',$where,['*'],'id-desc'));
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $data['view'] = 'front.testimonials';
        return view('front_home',$data); 
    }

    public function contact(Request $request){
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['view'] = 'front.contact';
        return view('front_home',$data);
    }

    public function aboutUs(Request $request){
        $data['view']='front.aboutus';
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        return view('front_home',$data);
    }

    public function enquiry(Request $request,$slug){
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $data['slider'] = _arefy(Sliders::where('slug',$slug)->first());
        $data['view'] = 'front.enquiry';
        return view('front_home',$data);
    }

    public function enquirySubmission(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->enquiry();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['slider_name']        =!empty($request->slider_name)?$request->slider_name:'';
            $data['slider_contact']     =!empty($request->slider_contact)?$request->slider_contact:'';
            $data['description']        =!empty($request->description)?$request->description:'';
            $data['location']            =!empty($request->location)?$request->location:'';
            $data['customer_name']      =!empty($request->customer_name)?$request->customer_name:'';
            $data['customer_contact']   =!empty($request->customer_contact)?$request->customer_contact:'';
            $data['email']              =!empty($request->email)?$request->email:'';
            $data['message']            =!empty($request->message)?$request->message:'';
            
            $inserId = Enquiry::add($data);
                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Enquiry has been submitted successfully.";
                $this->redirect = url('/');
            }
        return $this->populateresponse();
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
            if ($subscribe) {
                $emailData               = ___email_settings();
                $emailData['email']      = !empty($request->email)?$request->email:'';
                $data['created_at']          = date('Y-m-d H:i:s');
                $data['updated_at']          = date('Y-m-d H:i:s');

            $emailData['custom_text'] = 'You are subscribed successfully';
               ___mail_sender($emailData['email'],$request->date,"subscription",$emailData);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "You are subscribed successfully.";
            $this->redirect = url('/');
            }
        }
        return $this->populateresponse();
    }
}
