<?php

namespace App\Http\Controllers\Admin;

use App\Models\Leads;
use App\Models\Property;
use App\Models\ContactUs;
use App\Models\AgentEnquiry;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class LeadController extends Controller
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
        $data['view'] = 'admin.leads.list';
        
        $where = 'status != "trashed"';
        $lead  = _arefy(Leads::list('array',$where));
       
        if ($request->ajax()) {
            return DataTables::of($lead)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="'.url(sprintf('admin/leads/%s/edit',___encrypt($item['id']))).'"  title="Edit Details"><i class="fa fa-edit"></i></a> | ';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/leads/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> ';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('name',function($item){
                return ucfirst($item['name']);
            })
            ->editColumn('available',function($item){
                return ucfirst($item['available']);
            })
            ->editColumn('phone',function($item){
                return '+91-'.''.($item['phone']);
            })
            ->editColumn('property_id',function($item){
                return ucfirst($item['property']['name']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'E-mail','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id','name' => 'property_id','title' => 'Property','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'phone', 'name' => 'phone','title' => 'Phone Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'available', 'name' => 'available','title' => 'Available For','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'followup', 'name' => 'followup','title' => 'Follow Up','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status', 'name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function contactLead(Request $request, Builder $builder){
        $data['view'] = 'admin.leads.enquirylist';
        
        $contactlead  = _arefy(ContactUs::where('status','!=','trashed')->get());
       
        if ($request->ajax()) {
            return DataTables::of($contactlead)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/contactleads/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> ';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('name',function($item){
                return ucfirst($item['name']);
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('subject',function($item){
                return ucfirst($item['subject']);
            })
            ->editColumn('message',function($item){
                return ucfirst(str_limit($item['message'],50));
            })
            ->editColumn('number',function($item){
                return '+91-'.''.($item['number']);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            // ->addColumn(['data' => 'id', 'name' => 'id','title' => 'Id','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'E-mail','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'subject', 'name' => 'subject','title' => 'Subject','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'message', 'name' => 'message','title' => 'Message','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'number', 'name' => 'number','title' => 'Phone Number','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status', 'name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function agentLead(Request $request, Builder $builder){
        $data['view'] = 'admin.leads.agentlist';
        
        $agentlead  = _arefy(AgentEnquiry::where('status','!=','trashed')->get());
        // dd($agentlead);
       
        if ($request->ajax()) {
            return DataTables::of($agentlead)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/agentleads/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> ';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('agent_name',function($item){
                return ucfirst($item['agent_name']);
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('agent_contact',function($item){
                return '+91-'.''.($item['agent_contact']);
            })
            ->editColumn('customer_contact',function($item){
                return '+91-'.''.($item['customer_contact']);
            })
            ->editColumn('message',function($item){
                if (!empty($item['message'])) {
                    return str_limit($item['message'],30);
                }else{
                    return 'N/A';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            // ->addColumn(['data' => 'id', 'name' => 'id','title' => 'Id','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'agent_name', 'name' => 'agent_name','title' => 'Agent Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'agent_contact', 'name' => 'agent_contact','title' => 'Agent Contact','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'customer_name', 'name' => 'customer_name','title' => 'Customer Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'customer_contact', 'name' => 'customer_contact','title' => 'Customer Contact','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'E-mail','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'message', 'name' => 'message','title' => 'Message','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status', 'name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
            ->addAction(['title' => 'Actions', 'orderable' => false, 'width' => 120]);
        return view('admin.home')->with($data);
    }

    public function sliderLead(Request $request, Builder $builder){
        $data['view'] = 'admin.leads.sliderlist';
        
        $sliderlead  = _arefy(Enquiry::where('status','!=','trashed')->get());
        // dd($agentlead);
       
        if ($request->ajax()) {
            return DataTables::of($sliderlead)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/sliderleads/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> ';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('slider_name',function($item){
                return ucfirst($item['slider_name']);
            })
            ->editColumn('status',function($item){
                return ucfirst($item['status']);
            })
            ->editColumn('slider_contact',function($item){
                return '+91-'.''.($item['slider_contact']);
            })
            ->editColumn('customer_contact',function($item){
                return '+91-'.''.($item['customer_contact']);
            })
            ->editColumn('message',function($item){
                if (!empty($item['message'])) {
                    return str_limit($item['message'],30);
                }else{
                    return 'N/A';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            // ->addColumn(['data' => 'id', 'name' => 'id','title' => 'Id','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'slider_name', 'name' => 'slider_name','title' => 'Slider Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'slider_contact', 'name' => 'slider_contact','title' => 'Slider Contact','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'location', 'name' => 'location','title' => 'Location','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'customer_name', 'name' => 'customer_name','title' => 'Customer Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'customer_contact', 'name' => 'customer_contact','title' => 'Customer Contact','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'E-mail','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'message', 'name' => 'message','title' => 'Message','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'status', 'name' => 'status','title' => 'Status','orderable' => false, 'width' => 120])
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
      $data['view'] = 'admin.leads.add';
      $data['property'] = _arefy(Property::where('status', '=', 'active')->get());
      // dd($data['property']);
      return view('admin.home',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = new Validations($request);
        $validator  = $validation->addLead();
        if ($validator->fails()){
            $this->message = $validator->errors();
        }else{
            $data = new Leads();
            $data->fill($request->all());
            
            $data->save();
              $this->status   = true;
              $this->modal    = true;
              $this->alert    = true;
              $this->message  = "Lead has been Added successfully.";
              $this->redirect = url('admin/leads');
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
        $data['view'] = 'admin.leads.edit';
        $id = ___decrypt($id);
        $where = 'id = '.$id;
        $data['lead'] = _arefy(Leads::list('single',$where));
        // dd($data['lead']);
        $data['property'] = _arefy(Property::where('status', '=', 'active')->get());
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
        $validator  = $validation->addLead('edit');
        if ($validator->fails()) {
            $this->message = $validator->errors();
        }else{
            $lead = Leads::findOrFail($id);
            $input = $request->all();
            
            $lead->update($input);
            $this->status   = true;
            $this->modal    = true;
            $this->alert    = true;
            $this->message  = "Lead has been Updated successfully.";
            $this->redirect = url('admin/leads');
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
        $isUpdated               = Leads::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted lead successfully.';
            }else{
                $this->message = 'Updated lead successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }

    public function changeStatusContacts(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = ContactUs::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted lead successfully.';
            }else{
                $this->message = 'Updated lead successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }

    public function changeStatusAgents(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = AgentEnquiry::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted lead successfully.';
            }else{
                $this->message = 'Updated lead successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }

    public function changeStatusSlider(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Enquiry::change($request->id,$userData);

        if($isUpdated){
            if($request->status == 'trashed'){
                $this->message = 'Deleted lead successfully.';
            }else{
                $this->message = 'Updated lead successfully.';
            }
            $this->status = true;
            $this->redirect = true;
            $this->jsondata = [];
        }
        return $this->populateresponse();
    }
}
