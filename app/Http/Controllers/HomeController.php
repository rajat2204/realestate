<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Models\Users;
use App\Models\Deals;
use App\Models\Clients;
use App\Models\Project;
use App\Models\Agents;
use App\Models\Notice;
use App\Models\Contact;
use App\Models\Sliders;
use App\Models\Enquiry;
use App\Models\AgentEnquiry;
use App\Models\Services;
use App\Models\Property;
use App\Models\Property_Gallery;
use App\Models\Property_Enquiry;
use App\Models\ContactUs;
use App\Models\Subscribers;
use App\Models\SocialMedia;
use App\Models\Static_pages;
use App\Models\Testimonials;
use App\Models\Deals_Payment;
use App\Models\Make_Payment;
use Illuminate\Http\Request;
use App\Models\PropertyCategories;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
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
        return view('single_page',$data);
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
        $data['static'] = _arefy(Static_pages::where('status','active')->get());
        return view('front_home',$data);
    }
    /*---------------------start terms and conditions----------------------------------*/
    public function termsandconditions(Request $request){
        $data['view'] = 'front.termsandconditions';
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['static'] = _arefy(Static_pages::where('status','active')->get());
        // dd($data['static']);
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        return view('front_home',$data);
    }
    /*---------------------end terms and conditions----------------------------------*/

    /*---------------------start Privacy and policy----------------------------------*/
    public function privacypolicy(Request $request){
        $data['view'] = 'front.privacy-policy';
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['static'] = _arefy(Static_pages::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        return view('front_home',$data);
    }
    /*---------------------end Privacy and policy----------------------------------*/

    public function enquiry(Request $request,$slug){
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $data['slider'] = _arefy(Sliders::where('slug',$slug)->first());
        $data['view'] = 'front.enquiry';
        return view('front_home',$data);
    }

    public function agentEnquiry(Request $request,$id){
        $id = ___decrypt($id);
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $data['agent'] = _arefy(Agents::where('id',$id)->first());
        // dd($data['agent']);
        $data['view'] = 'front.enquiry-agent';
        return view('front_home',$data);
    }

    public function allProjects(Request $request){
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $where = 'status = "active"';
        $data['project'] = _arefy(Project::list('array',$where,['*'],'id-desc'));
        // dd($data['project']);
        $data['view'] = 'front.projects';
        return view('front_home',$data);
    }

    public function projectProperties(Request $request,$id){
        $id = ___decrypt($id);
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $where = 'status = "active"';
        $where .= 'AND project_id ="'.$id.'"';
        $data['projectproperty'] = _arefy(Property::list('array',$where,['*'],'id-desc'));
        // dd($data['projectproperty']);
        $data['view'] = 'front.projectproperties';
        return view('front_home',$data);
    }

    public function enquirySubmission(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->enquiry();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['slider_name']        = !empty($request->slider_name)?$request->slider_name:'';
            $data['slider_contact']     = !empty($request->slider_contact)?$request->slider_contact:'';
            $data['description']        = !empty($request->description)?$request->description:'';
            $data['location']           = !empty($request->location)?$request->location:'';
            $data['customer_name']      = !empty($request->customer_name)?$request->customer_name:'';
            $data['customer_contact']   = !empty($request->customer_contact)?$request->customer_contact:'';
            $data['email']              = !empty($request->email)?$request->email:'';
            $data['message']            = !empty($request->message)?$request->message:'';
            $data['user_id']            = !empty(Auth::user()->id)?Auth::user()->id:NULL;
            
            $inserId = Enquiry::add($data);

            $username="AMREESH@25"; 
            $password="AMREESH@25";
            $sender="AMRESH";

            $message = "You have got an enquiry for your shop ".$data['slider_name']." from ".ucfirst($data['customer_name']).". Their contact number is ".$data['customer_contact']." and E-mail Id is ".$data['email'].". You can contact ".ucfirst($data['customer_name'])." regarding any query. -Devdrishti Infrahomes Pvt.Ltd.";

            $message_admin="From your Portal, " .$data['slider_name']. " has got an enquiry from".ucfirst($data['customer_name']).". The Shopkeeper's contact number is ".$data['slider_contact'].". You can contact ".ucfirst($data['slider_name'])." regarding any query. You have also got the lead regarding enquiry in your admin panel. -Devdrishti Infrahomes Pvt.Ltd.";

            $pingurl = "skycon.bulksms5.com/sendmessage.php";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $pingurl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'user=' . $username . '&password=' . $password . '&mobile=' . $data['slider_contact'] . '&message=' . urlencode($message) . '&sender=' . $sender . '&type=3');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
           
            curl_close($ch);

            $admin = curl_init();
            curl_setopt($admin, CURLOPT_URL, $pingurl);
            curl_setopt($admin, CURLOPT_POST, 1);
            curl_setopt($admin, CURLOPT_POSTFIELDS, 'user=' . $username . '&password=' . $password . '&mobile=' . 9792759420 . '&message=' . urlencode($message_admin) . '&sender=' . $sender . '&type=3');
            curl_setopt($admin, CURLOPT_RETURNTRANSFER, true);
            $result_admin = curl_exec($admin);
           
            curl_close($admin);

                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Enquiry has been submitted successfully.";
                $this->redirect = url('/');
            }
        return $this->populateresponse();
    }

    public function propertyEnquirySubmission(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->propertyenquiry();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['property_id']        = !empty($request->id)?$request->id:'';
            $data['name']               = !empty($request->name)?$request->name:'';
            $data['email']              = !empty($request->email)?$request->email:'';
            $data['mobile']             = !empty($request->mobile)?$request->mobile:'';
            $data['user_id']            = !empty(Auth::user()->id)?Auth::user()->id:NULL;
            
            $inserId = Property_Enquiry::add($data);

            $username="AMREESH@25"; 
            $password="AMREESH@25";
            $sender="AMRESH";

            $message="From your Portal, you have got an enquiry from ".ucfirst($data['name']).". The Customer's contact number is ".$data['mobile'].". You can contact ".ucfirst($data['name'])." regarding any query. You have also got the lead regarding Property Enquiry in your admin panel. -Devdrishti Infrahomes Pvt.Ltd.";

            $pingurl = "skycon.bulksms5.com/sendmessage.php";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $pingurl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'user=' . $username . '&password=' . $password . '&mobile=' . 7651827761 . '&message=' . urlencode($message) . '&sender=' . $sender . '&type=3');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
           
            curl_close($ch);

                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Property Enquiry has been submitted successfully.";
                $this->redirect = url('/');
            }
        return $this->populateresponse();
    }

    public function agentEnquirySubmission(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->agentenquiry();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['agent_name']         =!empty($request->agent_name)?$request->agent_name:'';
            $data['agent_contact']      =!empty($request->agent_contact)?$request->agent_contact:'';
            $data['customer_name']      =!empty($request->customer_name)?$request->customer_name:'';
            $data['customer_contact']   =!empty($request->customer_contact)?$request->customer_contact:'';
            $data['email']              =!empty($request->email)?$request->email:'';
            $data['message']            =!empty($request->message)?$request->message:'';
            
            $inserId = AgentEnquiry::add($data);

            $username="AMREESH@25"; 
            $password="AMREESH@25";
            $sender="AMRESH";

            $message="You have got an enquiry from ".ucfirst($data['customer_name']).". The contact number of the Customer is ".$data['customer_contact']." and the respective E-mail Id is ".$data['email'].". You can contact ".ucfirst($data['customer_name'])." regarding any query. -Devdrishti Infrahomes Pvt.Ltd.";

            $message_agent="From your Portal, " .$data['agent_name']. " has got an enquiry from ".ucfirst($data['customer_name']).". The Agent's contact number is ".$data['agent_contact'].". You can contact ".ucfirst($data['agent_name'])." regarding any query. You have also got the lead regarding enquiry in your admin panel. -Devdrishti Infrahomes Pvt.Ltd.";

            $pingurl = "skycon.bulksms5.com/sendmessage.php";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $pingurl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'user=' . $username . '&password=' . $password . '&mobile=' . $data['agent_contact'] . '&message=' . urlencode($message) . '&sender=' . $sender . '&type=3');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
           
            curl_close($ch);

            $admin_agent = curl_init();
            curl_setopt($admin_agent, CURLOPT_URL, $pingurl);
            curl_setopt($admin_agent, CURLOPT_POST, 1);
            curl_setopt($admin_agent, CURLOPT_POSTFIELDS, 'user=' . $username . '&password=' . $password . '&mobile=' . 9792759420 . '&message=' . urlencode($message_agent) . '&sender=' . $sender . '&type=3');
            curl_setopt($admin_agent, CURLOPT_RETURNTRANSFER, true);
            $result_agent = curl_exec($admin_agent);
           
            curl_close($admin_agent);

                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Agent Enquiry has been submitted successfully.";
                $this->redirect = url('/');
            }
        return $this->populateresponse();
    }

    public function agentEnquiryModal(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->agentenquirymodal();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data['agent_name']         =!empty($request->agent_name)?$request->agent_name:'';
            $data['agent_contact']      =!empty($request->agent_contact)?$request->agent_contact:'';
            $data['customer_name']      =!empty($request->customer_name)?$request->customer_name:'';
            $data['customer_contact']   =!empty($request->customer_contact)?$request->customer_contact:'';
            $data['email']              =!empty($request->email)?$request->email:'';
            $data['interested']         =!empty($request->interested)?$request->interested:'';
            
            $inserId = AgentEnquiry::add($data);

            $username="AMREESH@25"; 
            $password="AMREESH@25";
            $sender="AMRESH";

            $message="You have got an enquiry ".$data['agent_name']." from ".ucfirst($data['customer_name']).". The contact number of ".ucfirst($data['customer_name'])." is ".$data['customer_contact']." and E-mail Id is ".$data['email'].". You can contact ".ucfirst($data['customer_name'])." regarding any query. -Devdrishti Infrahomes Pvt.Ltd.";

            $message_agent="From your Portal, " .$data['agent_name']. " has got an enquiry from ".ucfirst($data['customer_name']).". The Agent's contact number is ".$data['agent_contact'].". You can contact ".ucfirst($data['agent_name'])." regarding any query. You have also got the lead regarding enquiry in your admin panel. -Devdrishti Infrahomes Pvt.Ltd.";

            $pingurl = "skycon.bulksms5.com/sendmessage.php";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $pingurl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'user=' . $username . '&password=' . $password . '&mobile=' . $data['agent_contact'] . '&message=' . urlencode($message) . '&sender=' . $sender . '&type=3');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
           
            curl_close($ch);

            $admin_agent = curl_init();
            curl_setopt($admin_agent, CURLOPT_URL, $pingurl);
            curl_setopt($admin_agent, CURLOPT_POST, 1);
            curl_setopt($admin_agent, CURLOPT_POSTFIELDS, 'user=' . $username . '&password=' . $password . '&mobile=' . 9792759420 . '&message=' . urlencode($message_agent) . '&sender=' . $sender . '&type=3');
            $result_agent = curl_exec($admin_agent);
           
            curl_close($admin_agent);

                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Agent Enquiry has been submitted successfully.";
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
            $data['number']             =!empty($request->number)?$request->number:'';
            $data['message']            =!empty($request->message)?$request->message:'';
            
            $inserId = ContactUs::add($data);
            // if($inserId){
            //    $emailData               = ___email_settings();
            //    $emailData['name']       = !empty($request->name)?$request->name:'';
            //    $emailData['email']      = !empty($request->email)?$request->email:'';
            //    $emailData['subject']    = !empty($request->subject)?$request->subject:'';
            //    $emailData['number']     = !empty($request->number)?$request->number:'';
            //    $emailData['message']    = !empty($request->message)?$request->message:'';
            //    $emailData['date']       = date('Y-m-d H:i:s');

            //    $emailData['custom_text'] = 'Your Enquiry has been submitted successfully';
            //    ___mail_sender($emailData['email'],$request->name,"enquiry_email",$emailData);

                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "Enquiry has been submitted successfully.";
                $this->redirect = url('/');
            // }
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
            // if ($subscribe) {
            //     $emailData               = ___email_settings();
            //     $emailData['email']      = !empty($request->email)?$request->email:'';
            //     $data['created_at']      = date('Y-m-d H:i:s');
            //     $data['updated_at']      = date('Y-m-d H:i:s');

            // $emailData['custom_text'] = 'You are subscribed successfully';
            //    ___mail_sender($emailData['email'],$request->date,"subscription",$emailData);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "You are subscribed successfully.";
            $this->redirect = url('/');
        }
        return $this->populateresponse();
    }

    public function signUp(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->signup();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            if($request->signup == 'customer'){
                $data['first_name']                =!empty($request->first_name)?$request->first_name:'';
                $data['last_name']                 =!empty($request->last_name)?$request->last_name:'';
                $data['email']                     =!empty($request->email)?$request->email:'';
                $data['phone']                     =!empty($request->phone)?$request->phone:'';
                $data['password']                  =Hash::make(!empty($request->password)?$request->password:'');
                $data['remember_token']            =str_random(60).$request->remember_token;
                $data['user_type']                 ='user';
                $data['phone_code']                 ='+91';
                $data['created_at']                = date('Y-m-d H:i:s');
                $data['updated_at']                = date('Y-m-d H:i:s');

                $enquiry = Users::add($data);

                $userdata['user_id']                   =$enquiry;
                $userdata['name']                      =!empty($request->first_name)?$request->first_name:'';
                $userdata['email']                     =!empty($request->email)?$request->email:'';
                $userdata['phone']                     =!empty($request->phone)?$request->phone:'';
                $userdata['password']                  =Hash::make(!empty($request->password)?$request->password:'');
                $userdata['created_at']                = date('Y-m-d H:i:s');
                $userdata['updated_at']                = date('Y-m-d H:i:s');

                $clientdata = Clients::add($userdata);

                $this->status   = true;
                $this->modal    = true;
                $this->alert    = true;
                $this->message  = "User Registered successfully.";
                $this->redirect = url('/');
        }
        else{
            $data['first_name']                =!empty($request->first_name)?$request->first_name:'';
            $data['last_name']                 =!empty($request->last_name)?$request->last_name:'';
            $data['email']                     =!empty($request->email)?$request->email:'';
            $data['phone']                     =!empty($request->phone)?$request->phone:'';
            $data['password']                  =Hash::make(!empty($request->password)?$request->password:'');
            $data['remember_token']            =str_random(60).$request->remember_token;
            $data['user_type']                 ='agent';
            $data['phone_code']                 ='+91';
            $data['created_at']                = date('Y-m-d H:i:s');
            $data['updated_at']                = date('Y-m-d H:i:s');

            $enquiry = Users::add($data);

            $agentdata['user_id']                   =$enquiry;
            $agentdata['name']                      =!empty($request->first_name)?$request->first_name:'';
            $agentdata['email']                     =!empty($request->email)?$request->email:'';
            $agentdata['phone']                     =!empty($request->phone)?$request->phone:'';
            $agentdata['password']                  =Hash::make(!empty($request->password)?$request->password:'');
            $agentdata['created_at']                = date('Y-m-d H:i:s');
            $agentdata['updated_at']                = date('Y-m-d H:i:s');

            $clientdata = Agents::add($agentdata);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Agent Registered successfully.";
            $this->redirect = url('/');
        }
    }

        return $this->populateresponse();
    }

    public function customerLogin(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->custLogin();
        if($validator->fails()){
            $this->message = $validator->errors();
        }else{
            if($request->login == 'customer'){
                if (\Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
                    if(\Auth::user()->user_type == 'user'){
                      $this->status   = true;
                      $this->modal    = true;
                      $this->alert    = true;
                      $this->message  = "User Logged In Successfully !!!";
                      $this->redirect = url('/userdashboard');
                    }else{
                        \Session::flush();
                        $this->message = $validator->errors()->add('password', 'You are not authorised User.');
                        return $this->populateresponse();
                    }
                }else{
                        $this->message = $validator->errors()->add('password', 'Username or Password is Incorrect.');
                    }    
                }else{
                    if (\Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
                    if(\Auth::user()->user_type == 'agent'){
                        $this->status   = true;
                        $this->modal    = true;
                        $this->alert    = true;
                        $this->message  = "Agent Logged In Successfully !!!";
                        $this->redirect = url('/dashboard');
                    }else{
                        \Session::flush();
                        $this->message = $validator->errors()->add('password', 'You are not authorised Agent.');
                        return $this->populateresponse();
                    }
                }else{
                        $this->message = $validator->errors()->add('password', 'Username or Password is Incorrect.');
                    }   
                }
             
        }
        return $this->populateresponse();
    }

    public function propertyFinder(){
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $data['view'] = 'front.property-list';
        return view('front_home',$data);
    }

    public function searchProperty(Request $request){
            $where = 1;
            if(!empty($request->filter_propertystatus)){
                $where .= ' AND property_purpose = "'.$request->filter_propertystatus.'"';
            }
            if(!empty($request->filter_propertycategory)){
                $where .= ' AND category_id = "'.$request->filter_propertycategory.'"';
            }
            if(!empty($request->filter_bed_rooms)){
                 $where .= ' AND bedrooms = "'.$request->filter_bed_rooms.'"';
            }
            if(!empty($request->filter_bath_rooms)){
                 $where .= ' AND bathroom = "'.$request->filter_bath_rooms.'"';
            }
            $data['property_type'] = $request->filter_propertystatus;
            $data['social']   = _arefy(SocialMedia::where('status','active')->get());
            $data['property'] = _arefy(Property::list('array',$where,['*'],'id-desc'));
            $data['contact'] = _arefy(Contact::where('status','active')->get());
            $data['count']    = count($data['property']);
            $data['city']     = $request->filter_city;
            $data['view']     = 'front.property-list';
            return view('front_home',$data);
        // }
        //     return $this->populateresponse();
    }

    public function agentDashboard(Request $request){
        $data['view'] = 'front.agentdashboard';
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $data['agent'] = _arefy(Agents::where('user_id',Auth::user()->id)->first());
        $whereProperty = 'agent_id = '.$data['agent']['id'];
        $data['soldProperty'] = _arefy(Deals::list('array',$whereProperty));
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        return view('front_home',$data);
    }

    public function clientDashboard(Request $request){
        $data['view'] = 'front.clientDashboard';
        $data['social'] = _arefy(SocialMedia::where('status','active')->get());
        $data['client'] = _arefy(Clients::where('user_id',Auth::user()->id)->first());
        // dd($data['client']);
        $data['enquiry'] = _arefy(Enquiry::where('user_id',Auth::user()->id)->get());
        $where = 'user_id = '.Auth::user()->id;
        $data['propertyenquiry'] = _arefy(Property_Enquiry::list('array',$where));
        $where = 'user_id = '.Auth::user()->id;
        $data['client'] = _arefy(Clients::list('single',$where));
        $whereProperty = 'client_id = '.$data['client']['id'];
        $data['purchased'] = _arefy(Deals::list('array',$whereProperty));
        $data['paidpayment'] = _arefy(Make_Payment::where('client_id',$data['client']['id'])->get());
        $data['balancepayment'] = _arefy(Deals_Payment::where('client_id',$data['client']['id'])->where('payment_status','=','no')->get());
        $data['contact'] = _arefy(Contact::where('status','active')->get());
        return view('front_home',$data);
    }

    public function ajaxPaymentPlan(Request $request)
    {
        $where = 'user_id = '.Auth::user()->id;
        $client = _arefy(Clients::list('single',$where));
        $whereProperty = 'client_id = '.$client['id'];
        $purchased = _arefy(Deals::list('single',$whereProperty));
        // dd($purchased);
        $planview = view('front.template.ajaxpaymentplan',compact('purchased'));
        return Response($planview);
    }

    public function ajaxPaidPayment(Request $request)
    {
        $where = 'user_id = '.Auth::user()->id;
        $client = _arefy(Clients::list('single',$where));
        $paidpayment = _arefy(Make_Payment::where('client_id',$client['id'])->get());
        $paidview = view('front.template.ajaxpaidpayment',compact('paidpayment'));
        return Response($paidview);
    }

    public function ajaxBalancePayment(Request $request)
    {
        $where = 'user_id = '.Auth::user()->id;
        $client = _arefy(Clients::list('single',$where));
        $balancepayment = _arefy(Deals_Payment::where('client_id',$client['id'])->where('payment_status','=','no')->get());
        $balanceview = view('front.template.ajaxbalancepayment',compact('balancepayment'));
        return Response($balanceview);
    }

    public function agentchangePass(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->changeAgentpassword();
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

        $this->status   = true;
        $this->modal    = true;
        $this->alert    = true;
        if (\Auth::user()->user_type != 'user') {
          $this->message = 'Agent Password has been Updated Successfully.';
           $this->redirect = url('/dashboard');
        }else{
          $this->message = 'User Password has been Updated Successfully.';
           $this->redirect = url('/userdashboard');
        }
    }
        return $this->populateresponse();
    }

    public function editAgentProfile(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->editProfile();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
          $agentUserData['user_id']           = !empty($request->id)?$request->id:'';
          $agentUserData['name']              = !empty($request->name)?$request->name:'';
          $agentUserData['spouse_name']       = !empty($request->spouse_name)?$request->spouse_name:'';
          $agentUserData['district']          = !empty($request->district)?$request->district:'';
          $agentUserData['email']             = !empty($request->email)?$request->email:'';
          $agentUserData['phone']            = !empty($request->mobile)?$request->mobile:'';
          $agentUserData['dob']               = !empty($request->dob)?$request->dob:'';
          $agentUserData['adhaar']            = !empty($request->adhaar)?$request->adhaar:'';
          $agentUserData['pan']               = !empty($request->pan)?$request->pan:'';
          $agentUserData['address']           = !empty($request->address)?$request->address:'';
          $agentUserData['nominee']           = !empty($request->nominee)?$request->nominee:'';
          $agentUserData['dob_nominee']       = !empty($request->dob_nominee)?$request->dob_nominee:'';
          $agentUserData['relation']          = !empty($request->relation)?$request->relation:'';
          $agentUserData['created_at']        = date('Y-m-d H:i:s');
          $agentUserData['updated_at']        = date('Y-m-d H:i:s');

          if ($file = $request->file('image')){
            $photo_name = time().$request->file('image')->getClientOriginalName();
            $file->move('assets/img/agent',$photo_name);
            $agentUserData['image'] = $photo_name;
          }

          $agentDetails = Agents::changeDetail($request->id,$agentUserData);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Agents Profile has been Updated successfully.";
            $this->redirect = url('/dashboard');

        }
        return $this->populateresponse();
    }

    public function editClientProfile(Request $request){
        $validation = new Validations($request);
        $validator  = $validation->editClientProfile();
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
          $clientData['user_id']           = !empty($request->id)?$request->id:'';
          $clientData['name']              = !empty($request->name)?$request->name:'';
          $clientData['father_name']       = !empty($request->father_name)?$request->father_name:'';
          $clientData['occupation']        = !empty($request->occupation)?$request->occupation:'';
          $clientData['email']             = !empty($request->email)?$request->email:'';
          $clientData['phone']             = !empty($request->phone)?$request->phone:'';
          $clientData['dob']               = !empty($request->dob)?$request->dob:'';
          $clientData['pan']               = !empty($request->pan)?$request->pan:'';
          $clientData['state']             = !empty($request->state)?$request->state:'';
          $clientData['district']          = !empty($request->district)?$request->district:'';
          $clientData['address']           = !empty($request->address)?$request->address:'';
          $clientData['nationality']       = !empty($request->nationality)?$request->nationality:'';
          $clientData['created_at']        = date('Y-m-d H:i:s');
          $clientData['updated_at']        = date('Y-m-d H:i:s');

          if ($file = $request->file('photo')){
            $photo_name = time().$request->file('photo')->getClientOriginalName();
            $file->move('assets/img/Clients',$photo_name);
            $clientData['photo'] = $photo_name;
          }

          $clientDetails = Clients::changeDetail($request->id,$clientData);

            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Clients Profile has been Updated successfully.";
            $this->redirect = url('/userdashboard');

        }
        return $this->populateresponse();
    }
}
