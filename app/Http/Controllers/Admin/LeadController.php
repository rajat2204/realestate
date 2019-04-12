<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Leads;
use App\Models\Property;
use App\Models\ContactUs;
use App\Models\AgentEnquiry;
use App\Models\Property_Enquiry;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Facades\Excel;

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
        // dd($lead);
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

    public function propertyEnquiryLead(Request $request, Builder $builder){
        $data['view'] = 'admin.leads.propertyenquirylist';
        
        $where = 'status != "trashed"';
        $propertyEnquiryLead  = _arefy(Property_Enquiry::list('array',$where));
       
        if ($request->ajax()) {
            return DataTables::of($propertyEnquiryLead)
            ->editColumn('action',function($item){
                
                $html    = '<div class="edit_details_box">';
                $html   .= '<a href="javascript:void(0);" 
                        data-url="'.url(sprintf('admin/propertyenquiryleads/status/?id=%s&status=trashed',$item['id'])).'" 
                        data-request="ajax-confirm"
                        data-ask_image="'.url('assets/img/delete.png').'"
                        data-ask="Would you like to Delete?" title="Delete"><i class="fa fa-fw fa-trash"></i></a> ';
                $html   .= '</div>';
                                
                return $html;
            })
            ->editColumn('name',function($item){
                return ucfirst($item['name']);
            })
            ->editColumn('property_id',function($item){
                return ucfirst($item['property']['name']);
            })
            ->editColumn('property_construct',function($item){
                return ucfirst($item['property']['property_construct']);
            })
            ->editColumn('type',function($item){
                return ucfirst($item['property']['property_purpose']);
            })
            ->editColumn('location',function($item){
                return ucfirst($item['property']['location']);
            })
            ->editColumn('price',function($item){
                if ($item['property']['property_purpose'] == 'sale') {
                    return 'Rs.'.(number_format($item['property']['price']));
                }else{
                    return 'Rs.'.(number_format($item['property']['price'])).'/month';
                }
            })
            ->editColumn('mobile',function($item){
                return '+91-'.''.($item['mobile']);
            })
            ->editColumn('image',function($item){
                $imageurl = asset("assets/img/properties/".$item['property']['featured_image']);
                return '<img src="'.$imageurl.'" height="60px" width="100px">';
            })
            ->rawColumns(['action','image'])
            ->make(true);
        }

        $data['html'] = $builder
            ->parameters([
                "dom" => "<'row' <'col-md-6 col-sm-12 col-xs-4'l><'col-md-6 col-sm-12 col-xs-4'f>><'row filter'><'row white_box_wrapper database_table table-responsive'rt><'row' <'col-md-6'i><'col-md-6'p>>",
            ])
            ->addColumn(['data' => 'image', 'name' => 'image',"render"=> 'data','title' => 'Property Image','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'name', 'name' => 'name','title' => 'Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_id', 'name' => 'property_id','title' => 'Property Name','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'property_construct', 'name' => 'property_construct','title' => 'Property Type','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'type', 'name' => 'type','title' => 'Availability','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'location', 'name' => 'location','title' => 'Property Location','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'price', 'name' => 'price','title' => 'Property Price','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'email', 'name' => 'email','title' => 'E-mail','orderable' => false, 'width' => 120])
            ->addColumn(['data' => 'mobile', 'name' => 'mobile','title' => 'Phone Number','orderable' => false, 'width' => 120])
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
    public function create(){
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
    public function store(Request $request){
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
    public function edit($id){
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
    public function update(Request $request, $id){
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

    public function changeStatusPropertyEnquiry(Request $request){
        $userData                = ['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')];
        $isUpdated               = Property_Enquiry::change($request->id,$userData);

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

    public function exportLeads(Request $request, Builder $builder){
        $where = 'status != "trashed"';
        $lead  = _arefy(Leads::list('array',$where));
        $type='xlsx';
        $excel_name='leads_data';
        Excel::create($excel_name, function($excel) use ($lead) {
                $excel->sheet('mySheet', function($sheet) use ($lead){
                    $headings = [
                        'Name',
                        'E-mail',
                        'Phone Number',
                        'Property Name',
                        'Available For',
                        'Follow Up',
                        'Status',
                    ];

                    $sheet->row(1, $headings);
                    $sheet->cell('A1:I1', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $total=count($lead)+1;
                    $sheet->setBorder('A1:I'.$total, 'thin');

                    $i=2;
                    $j=1;
                    foreach ($lead as $key => $value) {
                        if($value){
                            
            
                            $sheet->row($i,[
                                $value['name'],
                                $value['email'],
                                $value['phone'],
                                $value['property']['name'],
                                $value['available'],
                                $value['followup'],
                                $value['status'],
                            ]);
                        }
                        $i++;
                        $j++;
                    }
                });
            })->download($type);
    }

    public function exportenquiryLeads(Request $request, Builder $builder){
        $contactlead  = _arefy(ContactUs::where('status','!=','trashed')->get());
        // dd($contactlead);
        $type='xlsx';
        $excel_name='enquiry_data';
        Excel::create($excel_name, function($excel) use ($contactlead) {
                $excel->sheet('mySheet', function($sheet) use ($contactlead){
                    $headings = [
                        'Name',
                        'E-mail',
                        'Subject',
                        'Message',
                        'Phone Number',
                    ];

                    $sheet->row(1, $headings);
                    $sheet->cell('A1:I1', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $total=count($contactlead)+1;
                    $sheet->setBorder('A1:I'.$total, 'thin');

                    $i=2;
                    $j=1;
                    foreach ($contactlead as $key => $value) {
                        if($value){
                            
            
                            $sheet->row($i,[
                                $value['name'],
                                $value['email'],
                                $value['subject'],
                                $value['message'],
                                $value['number'],
                            ]);
                        }
                        $i++;
                        $j++;
                    }
                });
            })->download($type);
    }

    public function propertyenquiryLeads(Request $request, Builder $builder){
        $where = 'status != "trashed"';
        $propertyEnquiryLead  = _arefy(Property_Enquiry::list('array',$where));
        // dd($propertyEnquiryLead);
        $type='xlsx';
        $excel_name='propertyenquiry_data';
        Excel::create($excel_name, function($excel) use ($propertyEnquiryLead) {
                $excel->sheet('mySheet', function($sheet) use ($propertyEnquiryLead){
                    $headings = [
                        'Name',
                        'Property Name',
                        'Property Type',
                        'Availability',
                        'Property Location',
                        'Property Price',
                        'E-mail',
                        'Phone Number',
                    ];

                    $sheet->row(1, $headings);
                    $sheet->cell('A1:I1', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $total=count($propertyEnquiryLead)+1;
                    $sheet->setBorder('A1:I'.$total, 'thin');

                    $i=2;
                    $j=1;
                    foreach ($propertyEnquiryLead as $key => $value) {
                        if($value){
                            
            
                            $sheet->row($i,[
                                $value['name'],
                                $value['property']['name'],
                                ucfirst($value['property']['property_construct']),
                                ucfirst($value['property']['property_purpose']),
                                $value['property']['location'],
                                'Rs.'.number_format($value['property']['price']),
                                $value['email'],
                                $value['mobile'],
                            ]);
                        }
                        $i++;
                        $j++;
                    }
                });
            })->download($type);
    }

    public function agentLeads(Request $request, Builder $builder){
        $agentlead  = _arefy(AgentEnquiry::where('status','!=','trashed')->get());
        // dd($agentlead);
        $type='xlsx';
        $excel_name='agentleads_data';
        Excel::create($excel_name, function($excel) use ($agentlead) {
                $excel->sheet('mySheet', function($sheet) use ($agentlead){
                    $headings = [
                        'Agent Name',
                        'Agent Contact',
                        'Customer Name',
                        'Customer Contact',
                        'E-mail',
                        'Message',
                    ];

                    $sheet->row(1, $headings);
                    $sheet->cell('A1:I1', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $total=count($agentlead)+1;
                    $sheet->setBorder('A1:I'.$total, 'thin');

                    $i=2;
                    $j=1;
                    foreach ($agentlead as $key => $value) {
                        if($value){
                            
            
                            $sheet->row($i,[
                                $value['agent_name'],
                                $value['agent_contact'],
                                $value['customer_name'],
                                $value['customer_contact'],
                                $value['email'],
                                $value['message'],
                            ]);
                        }
                        $i++;
                        $j++;
                    }
                });
            })->download($type);
    }

    public function sliderLeads(Request $request, Builder $builder){
        $sliderlead  = _arefy(Enquiry::where('status','!=','trashed')->get());
        // dd($sliderlead); 
        $type='xlsx';
        $excel_name='agentleads_data';
        Excel::create($excel_name, function($excel) use ($sliderlead) {
                $excel->sheet('mySheet', function($sheet) use ($sliderlead){
                    $headings = [
                        'Slider Name',
                        'Slider Contact',
                        'Location',
                        'Customer Name',
                        'Customer Contact',
                        'E-mail',
                        'Message',
                    ];

                    $sheet->row(1, $headings);
                    $sheet->cell('A1:I1', function($cell) {
                        $cell->setFontWeight('bold');
                    });
                    $total=count($sliderlead)+1;
                    $sheet->setBorder('A1:I'.$total, 'thin');

                    $i=2;
                    $j=1;
                    foreach ($sliderlead as $key => $value) {
                        if($value){
                            
            
                            $sheet->row($i,[
                                $value['slider_name'],
                                $value['slider_contact'],
                                $value['location'],
                                $value['customer_name'],
                                $value['customer_contact'],
                                $value['email'],
                                $value['message'],
                            ]);
                        }
                        $i++;
                        $j++;
                    }
                });
            })->download($type);
    }

    public function printLeads(Request $request){
        $where = 'status != "trashed"';
        $data['lead']  = _arefy(Leads::list('array',$where));
        // dd($data['lead']);
        $data['leads'] = _arefy($data['lead']);
        $excel_name='leads_data';
        $pdf = PDF::loadView('admin.leadpdf', $data);
        return $pdf->download('leads_data.pdf');
    }

    public function printcontactLeads(Request $request){
        $data['contactlead']  = _arefy(ContactUs::where('status','!=','trashed')->get());
        // dd($data['lead']);
        $data['contactleads'] = _arefy($data['contactlead']);
        $excel_name='contact_leads_data';
        $pdf = PDF::loadView('admin.contactleadpdf', $data);
        return $pdf->download('contact_leads_data.pdf');
    }

    public function propertyLeads(Request $request){
        $where = 'status != "trashed"';
        $data['propertyEnquiryLead']  = _arefy(Property_Enquiry::list('array',$where));
        // dd($data['lead']);
        $data['propertyEnquiryLeads'] = _arefy($data['propertyEnquiryLead']);
        $excel_name='property_leads_data';
        $pdf = PDF::loadView('admin.propertyleadspdf', $data);
        return $pdf->download('property_leads_data.pdf');
    }

    public function AgentLeadsList(Request $request){
        $data['agentlead']  = _arefy(AgentEnquiry::where('status','!=','trashed')->get());
        // dd($data['lead']);
        $data['agentleads'] = _arefy($data['agentlead']);
        $excel_name='agent_leads_data';
        $pdf = PDF::loadView('admin.agentleadspdf', $data);
        return $pdf->download('agent_leads_data.pdf');
    }

    public function SliderLeadsList(Request $request){
        $data['sliderlead']  = _arefy(Enquiry::where('status','!=','trashed')->get());
        // dd($data['lead']);
        $data['sliderleads'] = _arefy($data['sliderlead']);
        $excel_name='slider_leads_data';
        $pdf = PDF::loadView('admin.sliderleadspdf', $data);
        return $pdf->download('slider_leads_data.pdf');
    }
}
