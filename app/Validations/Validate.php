<?php

namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class Validate
{
	protected $data;
	public function __construct($data){
		$this->data = $data;
	}

	private function validation($key){
		$validation = [
			'id'				=> ['required'],
			'email'				=> ['nullable','email'],
			'req_email'			=> ['required','email'],
			'first_name' 		=> ['required','string'],
			'name' 				=> ['required','string'],
			'last_name' 		=> ['nullable','string'],
			'phone_code' 		=> ['nullable','required_with:mobile_number','string'],
			'mobile_number' 	=> ['required','numeric'],
			'req_mobile_number' => ['required','required_with:phone_code','numeric'],
			'country' 			=> ['required','string'],
			'address'           => ['nullable','string','max:1500'],
			'description'       => ['required','string'],
			'key_points'       	=> ['required','string','max:1500'],
			'title'             => ['required','string'],
			'profile_picture'   => ['required','mimes:doc,docx,pdf'],
			'pin_code' 			=> ['nullable','max:6','min:4'],
			'type' 	           	=> ['required','string'],
			'phone' 	        => ['required','numeric','digits:10'],
			'location' 	        => ['required','string'],
			'password'          => ['required','string','max:50','min:6'],
			'price'				=> ['required','numeric'],
			'pricing'			=> ['nullable','numeric'],
			'start_from'		=> ['required'],
			'photo'				=> ['required','mimes:jpg,jpeg,png'],
			'photomimes'		=> ['nullable','mimes:jpg,jpeg,png'],
			'photo_null'		=> ['nullable'],
			'slug_no_space'		=> ['required','alpha_dash','max:255'],
			'password_check'	=> ['required'],
			'newpassword'		=> ['required','max:10'],
			'area'				=> ['required','numeric'],
			'areaProperty'		=> ['nullable','numeric'],
			'gallery'			=> ['required','mimes:jpg,jpeg,png'],
			'gallery_null'		=> ['nullable'],
			'url' 				=> ['required','url'],
			'pincode' 			=> ['nullable','min:6','max:6'],
            'req_pincode'       => ['required','min:6','max:6'],
			'req_adhaar' 		=> ['required','min:12','max:12'],
			'commission' 		=> ['nullable','numeric','between:0,99.99'],
            'amount'            => ['required','numeric'],
			'late_amount'		=> ['nullable','numeric'],
            'action'            => ['required'],
			'percentage'		=> ['required','numeric','between:0,99.99'],
			'password_null' 	=> ['nullable'],
		];
		return $validation[$key];
	}

	public function login(){
        $validations = [
            'email' 		       	 => $this->validation('req_email'),
						'password'       	   => $this->validation('password'),
			    ];
        $validator = \Validator::make($this->data->all(), $validations,[
        		'email.required'     => 'E-mail is required.',
        		'password.required'  => 'Password is required.',
        ]);
        return $validator;		
	}

	public function custLogin(){
        $validations = [
        		'login'							 => $this->validation('name'),
            'phone' 		       	 => $this->validation('phone'),
						'password'       	   => $this->validation('password'),
			    ];
        $validator = \Validator::make($this->data->all(), $validations,[
        	'login.required'  		 =>	'Please Select Any of the one field.',
        	'phone.required'  		 =>	'Phone is required.',
        	'phone.numeric'  			 =>	'Phone should be in numeric format.',
					'password.required'    => 'Password is required.',

				]);
        return $validator;		
	}

	public function search(){
		$validations = [
        	'filter_propertystatus'		  => $this->validation('name'),
        	'filter_propertycategory' 	=> $this->validation('name'),
        	'filter_city'               => $this->validation('name'),
        	'filter_address'            => $this->validation('name'),
        ];
        $validator = \Validator::make($this->data->all(), $validations,[
        	'filter_propertystatus.required'   => 'Property Type is Required.',
        	'filter_propertycategory.required' => 'Property Category is Required.',
        	'filter_city.required'             => 'City is Required.',
        	'filter_address.required'          => 'Address is Required.',
        ]);
        return $validator;
	}

	public function signup(){
        $validations = [
        		'signup'					=> $this->validation('name'),
            'first_name' 		  => $this->validation('name'),
			      'last_name'       => $this->validation('name'),
						'email'					 	=> array_merge($this->validation('req_email'),[Rule::unique('users_realestate')]),
						'phone'       	  => array_merge($this->validation('phone'),[Rule::unique('users_realestate')]),
						'password'       	=> $this->validation('password'),
				];
        $validator = \Validator::make($this->data->all(), $validations,[
        		'signup.required'					=> 'Please Select Any of the one field.',
						'first_name.required'			=> 'Please Enter your First Name',        	
            'last_name.required'      => 'Please Enter your Last Name',       
						'email.required'			    => 'Please Enter your E-mail',      	
						'email.unique'						=> 'Email is already registered.',   	
						'phone.required'					=> 'Phone Number is required.',   	
						'phone.numeric'						=> 'Phone Number should be numeric.',	
						'phone.unique'						=> 'Phone Number is already registered.',	
						'phone.digits'						=> 'Phone Number cannot be greater than 10 digits.',  	
						'password.required'				=> 'Password is required.',  	
        ]);
        return $validator;		
	}

	public function createpropertyCategory($action='add'){
        $validations = [
            'name' 		        => $this->validation('name'),
						'slug'  			=> array_merge($this->validation('slug_no_space'),[Rule::unique('property_categories')]),
    	];
				if($action =='edit'){
					$validations['slug'] = array_merge($this->validation('slug_no_space'),[
						Rule::unique('property_categories')->where(function($query){
							$query->where('id','!=',$this->data->id);
						})
					]);
				}
      $validator = \Validator::make($this->data->all(), $validations,[
      	'name.required'     			=> 'Category Name is Required.',
      	'slug.required'     			=> 'Category Slug is Required.',
      	'slug.unique'     				=> 'This Category Slug has already been taken.',
      	'slug.alpha_dash'     			=> 'No spaces allowed in category slug.The Slug may only contain letters, numbers, dashes and underscores.',
      ]);
      return $validator;		
		}

		public function staticpage($action='edit'){
        $validations = [
            'title' 					=> $this->validation('name'),
            'description' 		=> $this->validation('description'),
    	];
      $validator = \Validator::make($this->data->all(), $validations,[
      	'title.required'     			=> 'Title is Required.',
      	'description.required'    => 'Description is Required.',
      ]);
      return $validator;		
		}

	public function addLead($action='add'){
        $validations = [
            'name' 		        => $this->validation('name'),
            'address' 		    => $this->validation('name'),
            'email' 		    => array_merge($this->validation('req_email'),[Rule::unique('lead')]),
            'phone' 		    => array_merge($this->validation('phone'),[Rule::unique('lead')]),
            'available' 		=> $this->validation('name'),
            'property_id' 		=> $this->validation('name'),
            'followup' 			=> $this->validation('name'),
            'status' 			=> $this->validation('name'),
            'remarks' 			=> $this->validation('name'),
    	];
		if($action =='edit'){
			$validations['email'] = array_merge($this->validation('req_email'),[
				Rule::unique('lead')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
			$validations['phone'] = array_merge($this->validation('phone'),[
				Rule::unique('lead')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
		}
        $validator = \Validator::make($this->data->all(), $validations,[
        	'name.required'     			=> 'Name is Required.',
        	'address.required'     			=> 'Address is Required.',
        	'email.required'     			=> 'E-mail is Required.',
        	'email.unique'     				=> 'E-mail is already taken.',
        	'phone.required'     			=> 'Phone Number is Required.',
        	'phone.unique'     				=> 'Phone Number is already taken.',
        	'available.required'     		=> 'Availability is Required.',
        	'property_id.required'     		=> 'Property Name is Required.',
        	'followup.required'     		=> 'Follow Up date is Required.',
        	'status.required'     			=> 'Lead Status is Required.',
        	'remarks.required'     			=> 'Lead Remarks is Required.',
        ]);
        return $validator;		
	}

	public function addPurchase($action='add'){
        $validations = [
            'project_id' 		=> $this->validation('name'),
            'property_id' 		=> $this->validation('name'),
            'seller_name' 		=> $this->validation('name'),
            'seller_address' 	=> $this->validation('name'),
            'seller_email' 		=> $this->validation('req_email'),
            'seller_mobile' 	=> $this->validation('phone'),
            'area' 				=> $this->validation('area'),
            'price' 			=> $this->validation('price'),
            // 'description' 		=> $this->validation('description'),
    	];
        $validator = \Validator::make($this->data->all(), $validations,[
        	'project_id.required'     				=> 'Project Name is Required.',
        	'property_id.required'     				=> 'Property Name is Required.',
        	'seller_name.required'     				=> 'Seller Name is Required.',
        	'seller_address.required'     			=> 'Sellers address is required.',
        	'seller_email.required'     			=> 'Sellers E-mail is required.',
        	'seller_mobile.required'     			=> 'Sellers Phone Number is Required.',
        	'seller_mobile.numeric'     			=> 'Sellers Phone Number should be numeric.',
        	'area.required'     					=> 'Area is Required.',
        	'area.numeric'     						=> 'Area should be numeric.',
        	'price.required'						=> 'Price is required.',
        	'price.numeric'							=> 'Price must be numeric.',
        	// 'description.required'					=> 'Description is required.',
        ]);
        return $validator;		
	}

	public function createCompany($action='add'){
        $validations = [
            'name' 		        => $this->validation('name'),
			'slug'  					=> array_merge($this->validation('slug_no_space'),[Rule::unique('company')]),
            'image' 		    	=> $this->validation('photo'),
            'description' 		=> $this->validation('description'),
    	];
		if($action =='edit'){
			$validations['image'] 	= $this->validation('photo_null');
			$validations['slug'] 	= array_merge($this->validation('slug_no_space'),[
				Rule::unique('company')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
		}
        $validator = \Validator::make($this->data->all(), $validations,[
        	'name.required'     			=> 'Company Name is Required.',
        	'slug.required'     			=> 'Company Slug is Required.',
        	'slug.unique'     				=> 'This Company Slug has already been taken.',
        	'slug.alpha_dash'     			=> 'No spaces allowed in Company slug.The Slug may only contain letters, numbers, dashes and underscores.',
        	'image.required'				=> 'Company Image is required.',
        	'image.mimes'					=> 'Image Should be in .jpg,.jpeg,.png format.',
        	'description.required'			=> 'Description of a Company is required.',
        ]);
        return $validator;		
	}

	public function addProperty($action='add'){
		$validations = [
			'category_id'			=> $this->validation('name'),
			'project_id'			=> $this->validation('name'),
            'name' 		        	=> $this->validation('name'),
			'slug'  				=> array_merge($this->validation('slug_no_space'),[Rule::unique('property')]),
			'property_purpose'		=> $this->validation('name'),
			'property_construct'	=> $this->validation('name'),
			'price'  				=> $this->validation('price'),
			'company_id'  			=> $this->validation('name'),
			'featured_image'  		=> $this->validation('photo'),
			'gallery'				=> $this->validation('id'),
			'gallery.*'				=> $this->validation('gallery'),
            'area'                  => $this->validation('area'),
			'unit_id'				=> $this->validation('name'),
			'location'				=> $this->validation('name'),
			'pincode'				=> $this->validation('pincode'),
    	];
    	if($action == 'edit'){
			$validations['featured_image'] 	= $this->validation('photo_null');
			$validations['gallery'] = $this->validation('gallery_null');
			$validations['slug'] = array_merge($this->validation('slug_no_space'),[
				Rule::unique('property')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
		}
    	$validator = \Validator::make($this->data->all(), $validations,[
    		'category_id.required'			=> 'Property Category is required.',
    		'project_id.required'			=> 'Project Name is required.',
        	'name.required'     			=> 'Property Name is Required.',
        	'slug.required'     			=> 'Property Slug is Required.',
        	'slug.unique'     				=> 'This Property Slug has already been taken.',
        	'slug.alpha_dash'     			=> 'No spaces allowed in Property slug.The Slug may only contain letters, numbers, dashes and underscores.',
			'property_purpose.required'		=> 'Property Type is required.',
			'property_construct.required'	=> 'Property Construct is required.',
            'price.required'                => 'Price of the Property is required.',
        	'price.numeric'					=> 'Price of the Property must be numeric.',
        	'company_id.required'			=> 'Company is required.',
        	'featured_image.required'		=> 'Property Image is required.',
        	'featured_image.mimes'			=> 'Image Should be in .jpg,.jpeg,.png format.',
        	'gallery.*.required' 			=> 'Gallery Images are required.',
			'gallery.*.mimes' 				=> 'Gallery Images should be in jpg,jpeg,png format.',
            'area.required'                 => 'Area of a Property is required.',
            'area.numeric'                  => 'Area of a Property must be numeric.',
			'unit_id.required'				=> 'Unit is required.',
			'location.required'				=> 'Location of a Property is required.',
			
        ]);
        return $validator;
	}

	public function addslider($action='add'){
    	$validations = [
            'image' 		        => $this->validation('photo'),
            'title'					=> $this->validation('name'),
            'slug'					=> array_merge($this->validation('slug_no_space'),[Rule::unique('sliders')]),
            'position'				=> $this->validation('name'),
            'location'				=> $this->validation('name'),
            'description'			=> $this->validation('name'),
    	];
		if($action == 'edit'){
			$validations['image'] 	= $this->validation('photo_null');
			$validations['slug'] = array_merge($this->validation('slug_no_space'),[
				Rule::unique('sliders')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
		}
        $validator = \Validator::make($this->data->all(), $validations,[
        	'image.required'     			=> 'Slider Image is required.',
        	'image.mimes'					=> 'Slider Should be in .jpg,.jpeg,.png format.',
        	'title.required'				=> 'Slider Title is required.',
        	'slug.required'     			=> 'Slider Slug is Required.',
        	'slug.unique'     				=> 'This Slider Slug has already been taken.',
        	'slug.alpha_dash'     			=> 'No spaces allowed in Slider slug.The Slug may only contain letters, numbers, dashes and underscores.',
        	'position.required'				=> 'Slider Position is required.',
        	'location.required'				=> 'Location is required.',
        	'description.required'			=> 'Slider Description is required.',
        ]);
       
        if($this->data->position != 'center'){
        	if(empty($this->data->mobile)){
		    	$validator->after(function ($validator){
				   $validator->errors()->add('mobile', 'Contact Number is required.');
				});
			}        
        }
		return $validator;
	}

	public function createContactUs($action='add'){
        $validations = [
        	'name' 				=> $this->validation('name'),
			'email'  			=> $this->validation('req_email'),
            'subject' 		    => $this->validation('name'),
            'number'            => $this->validation('phone'),
            'message' 		    => $this->validation('name'),
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
    		'name.required' 		=>  'Name is required.',
    		'email.required' 		=>  'E-mail is required.',
    		'subject.required' 		=>  'Subject is required.',
            'number.required'       =>  'Contact is required.',
            'number.numeric'        =>  'Contact should be numeric.',
            'number.digits'         =>  'Contact should not be greater than 10 digits.',
    		'message.required' 		=>  'Message is required.',

    	]);
        return $validator;		
	}

	public function enquiry($action='add'){
        $validations = [
            'customer_name'         => $this->validation('name'),
            'customer_contact'      => $this->validation('phone'),
            'email'                 => $this->validation('req_email'),
        ];
        
        $validator = \Validator::make($this->data->all(), $validations,[
            'customer_name.required'        =>  'Customer Name is required.',
            'customer_contact.required'     =>  'Customer Contact is required.',
            'customer_contact.numeric'      =>  'Contact Number should be numeric.',
            'customer_contact.digits'       =>  'Contact Number should not be greater than 10 digits.',
            'email.required'                =>  'Customer E-mail is required.',

        ]);
        return $validator;      
    }

    public function propertyenquiry($action='add'){
        $validations = [
            'name'                  => $this->validation('name'),
            'email'                 => $this->validation('req_email'),
            'mobile'                => $this->validation('phone'),
        ];
        
        $validator = \Validator::make($this->data->all(), $validations,[
            'name.required'       =>  'Customer Name is required.',
            'email.required'      =>  'Customer E-mail is required.',
            'mobile.required'     =>  'Customer Contact is required.',
            'mobile.numeric'      =>  'Contact Number should be numeric.',
            'mobile.digits'       =>  'Contact Number should not be greater than 10 digits.',

        ]);
        return $validator;      
    }

    public function agentenquiry($action='add'){
        $validations = [
            'customer_name'         => $this->validation('name'),
            'customer_contact'      => $this->validation('phone'),
            'email'                 => $this->validation('req_email'),
        ];
        
        $validator = \Validator::make($this->data->all(), $validations,[
            'customer_name.required'        =>  'Customer Name is required.',
            'customer_contact.required'     =>  'Customer Contact is required.',
            'customer_contact.numeric'      =>  'Contact Number should be numeric.',
            'customer_contact.digits'       =>  'Contact Number should not be greater than 10 digits.',
            'email.required'                =>  'Customer E-mail is required.',

        ]);
        return $validator;      
    }

    public function agentenquirymodal($action='add'){
        $validations = [
        	'customer_name' 		=> $this->validation('name'),
            'email'                 => $this->validation('req_email'),
			'customer_contact'  	=> $this->validation('phone'),
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
    		'customer_name.required' 		=>  'Customer Name is required.',
            'email.required'                =>  'Customer E-mail is required.',
    		'customer_contact.required' 	=>  'Customer Contact is required.',
    		'customer_contact.numeric' 		=>  'Contact Number should be numeric.',
    		'customer_contact.digits' 		=>  'Contact Number should not be greater than 10 digits.',

    	]);
        return $validator;		
	}

	public function addsocialmedia(){
		$validations = [
        	'url' 				=> $this->validation('url'),
    	];
    	
		$validator = \Validator::make($this->data->all(), $validations,[
			'url.required'			=>	'Social Media URL is required.',
		]);
		return $validator;
	}

	public function subscriber($action='add'){
		$validations = [
        	'email' 				=> $this->validation('req_email'),
    	];
		$validator = \Validator::make($this->data->all(), $validations,[
			'email.required'		=> 	'E-mail is required',
		]);
		return $validator;
	}

	public function addTestimonial($action='add'){
		$validations = [
        	'name' 				=> $this->validation('name'),
        	'image' 			=> $this->validation('photo'),
        	'description' 		=> $this->validation('name'),
    	];
    	if($action == 'edit'){
			$validations['image'] 	= $this->validation('photo_null');
		}
		$validator = \Validator::make($this->data->all(), $validations,[
			'name.required'     	=> 'Testimonial Name is Required.',
			'image.required'		=> 'Testimonial Image is required.',
        	'image.mimes'			=> 'Image Should be in .jpg,.jpeg,.png format.',
        	'description.required'	=> 'Testimonial Description is required.',
		]);
		return $validator;
	}

	public function addAgent($action='add'){
		$validations = [
        	'image' 			=> $this->validation('photo'),
            'name'              => $this->validation('name'),
            'spouse_name'       => $this->validation('name'),
            'dob'               => $this->validation('name'),
            'adhaar'            => $this->validation('req_adhaar'),
            'address'           => $this->validation('name'),
            'post_office'       => $this->validation('name'),
            'district'          => $this->validation('name'),
            'pin'               => $this->validation('req_pincode'),
            'phone'             => array_merge($this->validation('phone'),[Rule::unique('users_realestate')]),
            'email'             => array_merge($this->validation('req_email'),[Rule::unique('users_realestate')]),
            'password'          => $this->validation('password'),
            'nominee'           => $this->validation('name'),
            'relation'          => $this->validation('name'),
        	'dob_nominee' 		=> $this->validation('name'),
          		
    	];
    	if($action == 'edit'){
			$validations['image'] 	= $this->validation('photo_null');
			$validations['email'] = array_merge($this->validation('req_email'),[
				Rule::unique('agent')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
			$validations['phone'] = array_merge($this->validation('phone'),[
				Rule::unique('agent')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
            $validations['password']   = $this->validation('password_null');
		}
		$validator = \Validator::make($this->data->all(), $validations,[
			'image.required'		=> 'Agent Image is required.',
        	'image.mimes'			=> 'Image Should be in .jpg,.jpeg,.png format.',
            'name.required'         => 'Agent Name is Required.',
            'spouse_name.required'  => 'Agent Spouse Name is Required.',
            'dob.required'          => 'Agents DOB is Required.',
            'adhaar.required'       => 'Agents Adhaar Number is Required.',
			'adhaar.numeric'        => 'Agents Adhaar Number should be numeric.',
            'address.required'      => 'Please enter your address.',
            'post_office.required'  => 'Please enter your Area Post Office.',
            'district.required'     => 'Please enter your District.',
            'pin.required'          => 'Please enter your Pin Code.',
			'pin.numeric'           => 'Pin Code should be Numeric.',
			'phone.required'		=> 'Please enter your Contact Number.',
			'phone.numeric'		    => 'Phone Number should be numeric.',
			'phone.unique'			=> 'Phone Number is already registered.',
            'email.required'        => 'Agent E-mail is required.',
            'email.unique'          => 'E-mail is already registered.',
            'password.required'     => 'Password is required.',
            'nominee.required'      => 'Nominee is required.',
            'relation.required'     => 'Relation of a Nominee to an Agent is required.',
            'dob_nominee.required'  => 'DOB of a Nominee is required.',
		]);
		return $validator;
	}

	public function addService($action='add')
	{
		$validations = [
        	'image' 			=> $this->validation('photo'),
        	'title' 			=> $this->validation('name'),
        	'description' 		=> $this->validation('name'),
    	];
    	if($action == 'edit'){
			$validations['image'] 	= $this->validation('photo_null');
		}
		$validator = \Validator::make($this->data->all(), $validations,[
			'image.required'		=> 'Service Image is required.',
        	'image.mimes'			=> 'Image Should be in .jpg,.jpeg,.png format.',
			'title.required'     	=> 'Service Name is Required.',
        	'description.required'	=> 'Service Description is required.',
		]);
		return $validator;
	}

	public function contactaddress($action='edit'){
        $validations = [
            'address'               => $this->validation('name'),
            'email'                 => $this->validation('req_email'),
            'phone'                 => $this->validation('name'),
            'whatsapp'                 => $this->validation('name'),
        ];
        $validator = \Validator::make($this->data->all(), $validations,[
            'address.required'              =>  'Please enter your address.',
            'email.required'                =>  'Please enter your E-mail.',
            'phone.required'                =>  'Please enter your Contact Number.',
            'whatsapp.required'             =>  'Please enter your Whatsapp Number.',
        ]);
        return $validator;
    }

    public function savePayment(){
		$validations = [
        	'late_amount' 			=> $this->validation('late_amount'),
        	'payment_type'			=> $this->validation('name'),
        	'date'					=> $this->validation('name'),
    	];
		$validator = \Validator::make($this->data->all(), $validations,[
			'late_amount.numeric' 		=>  'Late Amount should be numeric.',
			'payment_type.required'		=> 	'Payment Type is Required.',
			'date.required'				=> 	'Date is Required.',
		]);
        if($this->data->payment_type == 'cheque'){
            if(empty($this->data->cheque_no)){
                $validator->after(function ($validator){
                   $validator->errors()->add('cheque_no', 'Cheque Number is required.');
                });
            }
            if(empty($this->data->bank_name)){
                $validator->after(function ($validator){
                   $validator->errors()->add('bank_name', 'Bank Name is required.');
                });
            }        
        }
		return $validator;
	}

	public function createNotice($action='add'){
        $validations = [
            'text' 		        => $this->validation('name'),
			'slug'  			=> array_merge($this->validation('slug_no_space'),[Rule::unique('notice')]),
    	];
		if($action =='edit'){
			$validations['slug'] = array_merge($this->validation('slug_no_space'),[
				Rule::unique('notice')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
		}
        $validator = \Validator::make($this->data->all(), $validations,[
        	'text.required'     			=> 'Category Name is Required.',
        	'slug.required'     			=> 'Category Slug is Required.',
        	'slug.unique'     				=> 'This Category Slug has already been taken.',
        	'slug.alpha_dash'     			=> 'No spaces allowed in category slug.The Slug may only contain letters, numbers, dashes and underscores.',
        ]);
        return $validator;		
	}

	public function createProject($action='add'){
        $validations = [
        	'company_id'		=> $this->validation('name'),
            'name' 		        => $this->validation('name'),
			'slug'  			=> array_merge($this->validation('slug_no_space'),[Rule::unique('project')]),
            'location'          => $this->validation('name'),
			'nearest_location'  => $this->validation('name'),
			'image'				=> $this->validation('photo'),
			'layout'			=> $this->validation('photo'),
			'locationmap'		=> $this->validation('photo'),
    	];
		if($action =='edit'){
			$validations['image'] 			= $this->validation('photo_null');
			$validations['layout'] 			= $this->validation('photo_null');
			$validations['locationmap'] 	= $this->validation('photo_null');
			$validations['slug'] 	= array_merge($this->validation('slug_no_space'),[
				Rule::unique('project')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
		}
        $validator = \Validator::make($this->data->all(), $validations,[
        	'company_id.required'			=> 'Company Name is Required.',
        	'name.required'     			=> 'Project Name is Required.',
        	'slug.required'     			=> 'Project Slug is Required.',
        	'slug.unique'     				=> 'This Project Slug has already been taken.',
        	'slug.alpha_dash'     			=> 'No spaces allowed in project slug.The Slug may only contain letters, numbers, dashes and underscores.',
            'location.required'             => 'Location of a Project is required.',
        	'nearest_location.required'		=> 'Nearest Location of a Project is required.',
        	'image.required'				=> 'Project Image is required.',
        	'image.mimes'					=> 'Image Should be in .jpg,.jpeg,.png format.',
        	'layout.required'				=> 'Project Layout Plan is required.',
        	'layout.mimes'					=> 'Project Layout Plan Image Should be in .jpg,.jpeg,.png format.',
        	'locationmap.required'			=> 'Project Location Map is required.',
        	'locationmap.mimes'				=> 'Project Location Map Image Should be in .jpg,.jpeg,.png format.',
        ]);
        return $validator;		
	}

	public function editProfile($action='add'){
        $validations = [
        	'image'				=> $this->validation('photomimes'),
        	'spouse_name'		=> $this->validation('name'),
            'district' 		    => $this->validation('name'),
			'dob'  				=> $this->validation('name'),
			'adhaar'  			=> $this->validation('req_adhaar'),
			'address'			=> $this->validation('name'),
			'nominee' 	     	=> $this->validation('name'),
			'dob_nominee' 	    => $this->validation('name'),
			'relation' 	     	=> $this->validation('name'),
    	];
        $validator = \Validator::make($this->data->all(), $validations,[
        	'image.mimes'					=> 'Image Should be in .jpg,.jpeg,.png format.',
        	'spouse_name.required'     		=> 'Spouse Name is Required.',
        	'district.required'     		=> 'City is Required.',
        	'dob.required'     		    	=> 'Agents DOB is Required.',
        	'adhaar.required'     		    => 'Agents Adhaar Number is Required.',
        	'address.required'     		    => 'Agents Address is Required.',
        	'nominee.required'     		    => 'Nominee Name is Required.',
        	'dob_nominee.required'     		=> 'Nominees DOB is Required.',
        	'relation.required'     		=> 'Nominees Relation to Agent is Required.',
        ]);
        return $validator;		
	}

	public function editClientProfile($action='add'){
        $validations = [
        	'photo'					=> $this->validation('photomimes'),
        	'father_name'			=> $this->validation('name'),
            'occupation' 		    => $this->validation('name'),
			'address'				=> $this->validation('name'),
			'district'				=> $this->validation('name'),
			'state'					=> $this->validation('name'),
			'dob'  					=> $this->validation('name'),
			'pan' 	     			=> $this->validation('name'),
			'nationality' 	   		=> $this->validation('name'),
    	];
        $validator = \Validator::make($this->data->all(), $validations,[
        	'photo.mimes'					=> 'Image Should be in .jpg,.jpeg,.png format.',
        	'father_name.required'     		=> 'Father/Mothers Name is Required.',
        	'occupation.required'     		=> 'User occupation is Required.',
        	'address.required'     		    => 'User Address is Required.',
        	'district.required'     		=> 'District is Required.',
        	'state.required'     		    => 'State of a Client is Required.',
        	'dob.required'     		    	=> 'Clients DOB is Required.',
        	'pan.required'     				=> 'PAN Number is Required.',
        	'nationality.required'     		=> 'CLients Nationality is Required.',
        ]);
        return $validator;		
	}

	public function changepassword($action='add'){
        $validations = [
        	'password' 					=> $this->validation('password'),
			'new_password'  			=> $this->validation('password'),
            'confirm_password' 		    => $this->validation('password'),
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
    		'password.required' 	=>  'Current Password is required.',
    		'new_password.required' 		=>  'New password is required.',
    		'confirm_password.required' 	=>  'Confirm Password is required.',

    	]);
        return $validator;		
	}

	public function changeAgentpassword(){
        $validations = [
        	'password' 					=> $this->validation('password'),
			'new_password'  			=> $this->validation('password'),
            'confirm_password' 		    => $this->validation('password'),
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
    		'password.required' 	=>  'Current Password is required.',
    		'new_password.required' 		=>  'New password is required.',
    		'confirm_password.required' 	=>  'Confirm Password is required.',

    	]);
        return $validator;		
	}

	public function addPlan($action='add'){
      $validations = [
      	'name' 				=> $this->validation('name'),
				'installment'  		=> $this->validation('name'),
  		];
  	
      $validator = \Validator::make($this->data->all(), $validations,[
  		'name.required' 		=>  'Plan Name is required.',
  		'installment.required' 	=>  'Plan Installment is required.',
  	]);
      return $validator;		
	}

	public function createvendor($action='add'){
      $validations = [
      	'name' 				=> $this->validation('name'),
		'address' 			=> $this->validation('name'),
		'contact' 			=> array_merge($this->validation('phone'),
								[Rule::unique('vendor')]),
  		];

  		if($action =='edit'){
		$validations['contact'] 	= array_merge($this->validation('phone'),
			[Rule::unique('vendor')->where(function($query){
			$query->where('id','!=',$this->data->id);
					})]);
			}
  	
      $validator = \Validator::make($this->data->all(), $validations,[
  		'name.required' 		=>  'Vendor Name is required.',
  		'address.required' 	=>  'Vendor Address is required.',
  		'contact.required' 		=>  'Vendor Contact is required.',
  		'contact.numeric' 		=>  'Vendor Contact should be numeric.',
  		'contact.unique' 			=>  'This Vendor Contact has already been taken.',
  	]);
      return $validator;		
	}

	public function addClient($action='add'){
      $validations = [
      	'name' 				=> $this->validation('name'),
      	'father_name' 		=> $this->validation('name'),
      	'dob' 				=> $this->validation('name'),
		'phone'  			=> array_merge($this->validation('phone'),[Rule::unique('users_realestate')]),
		'email'  			=> array_merge($this->validation('req_email'),[Rule::unique('users_realestate')]),
		'password'  		=> $this->validation('password'),
		'address'  			=> $this->validation('name'),
		'district'  		=> $this->validation('name'),
		'state'  			=> $this->validation('name'),
		'nationality'  		=> $this->validation('name'),
		'pincode'  			=> $this->validation('req_pincode'),
		'photo'  			=> $this->validation('photo'),
		'id_proof'  		=> $this->validation('photomimes'),
		'address_proof'  	=> $this->validation('photomimes'),
		  ];

	  	if($action =='edit'){
			$validations['phone'] 	= array_merge($this->validation('phone'),[
				Rule::unique('client')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
			$validations['email'] 	= array_merge($this->validation('req_email'),[
				Rule::unique('client')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
			$validations['password'] 			= $this->validation('photo_null');
			$validations['photo'] 				= $this->validation('photo_null');
			$validations['id_proof'] 			= $this->validation('photo_null');
			$validations['address_proof'] = $this->validation('photo_null');
		}
  	
      $validator = \Validator::make($this->data->all(), $validations,[
	  		'name.required' 				=>  'Client Name is required.',
	  		'father_name.required' 	=>  'Clients Father/Husband/Wife name is required.',
	  		'dob.required' 					=>  'Clients Date of Birth is required.',
	  		'phone.required' 				=>  'Clients Mobile Number is required.',
	  		'phone.numeric' 				=>  'Mobile Number should be numeric.',
	    	'phone.digits' 					=>  'Mobile Number should not be greater than 10 digits.',
	    	'phone.unique' 					=>  'This Mobile Number is already registered.',
	    	'email.required' 				=>  'E-mail is required.',
	    	'email.unique' 					=>  'This E-mail is already registered.',
	    	'password.required' 		=>  'Password is required.',
	    	'address.required' 			=>  'Address is required.',
	    	'district.required' 		=>  'District is required.',
	    	'state.required' 				=>  'State is required.',
	    	'nationality.required' 	=>  'Nationality is required.',
	    	'pincode.required' 			=>  'Pincode is required.',
	    	'photo.required' 				=>  'Clients Image is required.',
	    	'photo.mimes' 					=>  'Clients Image should be in jpg,jpeg,png format.',
	    	'id_proof.mimes' 				=>  'Image should be in jpg,jpeg,png format.',
	    	'address_proof.mimes' 	=>  'Image should be in jpg,jpeg,png format.',
	  	]);
      return $validator;		
		}

		public function addExpenseCategory($action='add'){
	      $validations = [
	      	'name' 				=> $this->validation('name'),
	  		];
	  	
	      $validator = \Validator::make($this->data->all(), $validations,[
	  		'name.required' 		=>  'Expense Category Name is required.',
	  	]);
	      return $validator;		
		}

		public function addExpense($action='add'){
      $validations = [
      	'project_id' 					=> $this->validation('name'),
      	'category_id' 				=> $this->validation('name'),
      	'vendor_id' 					=> $this->validation('name'),
      	'invoice_date' 				=> $this->validation('name'),
      	'amount' 							=> $this->validation('price'),
      	'balance' 						=> $this->validation('price'),
  		];
  	
      $validator = \Validator::make($this->data->all(), $validations,[
  		'project_id.required' 		=>  'Project Name is required.',
  		'category_id.required' 		=>  'Expense Category Name is required.',
  		'vendor_id.required' 			=>  'Vendor Name is required.',
  		'invoice_date.required' 	=>  'Invoice Date is required.',
  		'amount.required' 				=>  'Expense Amount is required.',
  		'amount.numeric' 					=>  'Expense Amount should be numeric.',
  		'balance.required' 				=>  'Expense Balance is required.',
  		'balance.numeric' 				=>  'Expense Balance Amount should be numeric.',
  	]);
      	if(($this->data->balance)>($this->data->amount)){
		    $validator->after(function ($validator){
				   $validator->errors()->add('balance', 'Due Balance Amount should not be greater than Invoice Amount.');
			});
		}
      return $validator;		
	}

	public function addexpensepayment($action='add'){
      $validations = [
        'amount'                    => $this->validation('amount'),         
        'payment_type'              => $this->validation('name'),
        'date'                      => $this->validation('name'),
            ];
    
      $validator = \Validator::make($this->data->all(), $validations,[
        'amount.required'           =>  'Payment Amount is required.',
        'amount.numeric'            =>  'Amount should be numeric.',
        'payment_type.required'     =>  'Payment Type is required.',        
        'date.required'             =>  'Date is required.',        
        ]);
        if(($this->data->amount)>($this->data->balance)){
            $validator->after(function ($validator){
            $validator->errors()->add('amount', 'Payment Amount should not be greater than Due 
            Balance Amount.');
       });
      }
      return $validator;        
    }

    public function addpurchasepayment($action='add'){
      $validations = [
      	'amount' 					=> $this->validation('amount'),      	
		'payment_type' 				=> $this->validation('name'),
		'date'						=> $this->validation('name'),
	];
  	
      $validator = \Validator::make($this->data->all(), $validations,[
	  	'amount.required' 			=>  'Payment Amount is required.',
	  	'amount.numeric' 			=>  'Amount should be numeric.',
		'payment_type.required' 	=>  'Payment Type is required.',		
		'date.required'				=>  'Date is required.',		
  		]);
  		if(($this->data->amount)>($this->data->balance)){
		    $validator->after(function ($validator){
		    $validator->errors()->add('amount', 'Payment Amount should not be greater than Due 
		    Balance Amount.');
	   });
	  }
      return $validator;		
	}

	public function addInventory($action='add'){
      $validations = [
      	'project_id' 				=> $this->validation('name'),
      	'expense_category_id' 		=> $this->validation('name'),
      	'vendor_id' 				=> $this->validation('name'),
      	'invoice_date' 				=> $this->validation('name'),
      	'quantity' 					=> $this->validation('price'),
  		];
  	
      $validator = \Validator::make($this->data->all(), $validations,[
  		'project_id.required' 		=>  'Project Name is required.',
  		'category_id.required' 		=>  'Expense Category Name is required.',
  		'vendor_id.required' 		=>  'Vendor Name is required.',
  		'invoice_date.required' 	=>  'Invoice Date is required.',
  		'quantity.required' 		=>  'Inventory Quantity is required.',
  		'quantity.numeric' 			=>  'Inventory Quantity should be numeric.',
  	]);
      return $validator;		
	}

	public function makeEntryBalance($action='add'){
      $validations = [
      	'qty' 					=> $this->validation('price'),
      	'date'				 	=> $this->validation('name'),
  		];
  	
      $validator = \Validator::make($this->data->all(), $validations,[
  		'quantity.required' 		=>  'Inventory Quantity is required.',
  		'quantity.numeric' 			=>  'Inventory Quantity should be numeric.',
  		'invoice_date.required' 	=>  'Invoice Date is required.',
  	]);
      if(($this->data->qty)>($this->data->balance)){
		$validator->after(function ($validator){
		$validator->errors()->add('qty', 'Quantity should not be greater than Due 
		    Balance Inventory.');
	   });
	  }
      return $validator;		
	}
		
	public function addWallet($action='add'){
	      $validations = [
      	'amount' 		=> $this->validation('amount'),      	
				'action' 		=> $this->validation('action'),
				'remarks'   	=> $this->validation('name'),
			];
  	
      $validator = \Validator::make($this->data->all(), $validations,[
	  		'amount.required' 		=>  'Amount should not be blank.',
	  		'amount.numeric' 			=>  'Amount should be numeric.',
				'action.required' 		=>  'Action is required.',  		
				'remark.required'			=>  'Remark is required'
  			
  		]);
  		if($this->data->action=='deduct')
  		{
  		if(($this->data->amount)>($this->data->balance)){
		    $validator->after(function ($validator){
	  	  $validator->errors()->add('amount', 'Payment Amount should not be greater than Due Balance Amount.');
			});
			}
		}
      return $validator;		
	}

	public function createUser($action='add'){
      $validations = [
      	'user_level_id' 	     => $this->validation('name'),
      	'username'				 => array_merge($this->validation('name'),[Rule::unique('users_realestate')]),
      	'password'				 => $this->validation('password'),
      	'first_name'			 => $this->validation('name'),
      	'email'				 	 => array_merge($this->validation('req_email'),[Rule::unique('users_realestate')]),
      	'phone'				 	 => array_merge($this->validation('phone'),[Rule::unique('users_realestate')]),
  		];
  		if($action =='edit'){
					$validations['username'] = array_merge($this->validation('name'),[
						Rule::unique('users_realestate')->where(function($query){
							$query->where('id','!=',$this->data->id);
						})
					]);
  				$validations['password'] = $this->validation('password_null');
					$validations['email'] = array_merge($this->validation('req_email'),[
						Rule::unique('users_realestate')->where(function($query){
							$query->where('id','!=',$this->data->id);
						})
					]);
					$validations['phone'] = array_merge($this->validation('phone'),[
						Rule::unique('users_realestate')->where(function($query){
							$query->where('id','!=',$this->data->id);
						})
					]);
				}
  	
      $validator = \Validator::make($this->data->all(), $validations,[
  		'user_level_id.required' 		=>  'User Level is required.',
  		'username.required' 				=>  'User Name is required.',
  		'username.unique'	 					=>  'This User Name is already registered.',
  		'password.required'	 				=>  'Password is required.',
  		'first_name.required'	 			=>  'Name is required.',
  		'email.required'	 					=>  'E-mail is required.',
  		'email.unique'	 						=>  'This E-mail is already registered.',
  		'phone.required'	 					=>  'Mobile Number is required.',
  		'phone.numeric'	 						=>  'Mobile Number should be numeric.',
  		'phone.unique'	 						=>  'This Mobile Number is already registered.',
  	]);
      return $validator;		
	}

	public function createUserLevel($action='add'){
	    $validations = [
	      	'level_name' 				=> $this->validation('name'),
	  		];
	  	
	      $validator = \Validator::make($this->data->all(), $validations,[
	  		'level_name.required' 		=>  'User Level Name is required.',
	  	]);
	      return $validator;		
		}

		public function addDeal($action='add'){
	      $validations = [
	      	'client_id' 				=> $this->validation('name'),
	      	'project_id' 				=> $this->validation('name'),
            'property_id'               => $this->validation('name'),
	      	'invoice_no' 			    => $this->validation('name'),
            'date'                      => $this->validation('name'),
	      	'balance' 					=> $this->validation('price'),
            'discount'                  => $this->validation('commission'),
	      	'plan_id' 					=> $this->validation('name'),
	      	'payment_method' 		    => $this->validation('name'),
	  		];

            if($action == 'edit'){
                $validations['client_id']           = $this->validation('password_null');
                $validations['project_id']          = $this->validation('password_null');
                $validations['property_id']         = $this->validation('password_null');
                $validations['invoice_no']          = $this->validation('name');
                $validations['date']                = $this->validation('name');
                $validations['balance']             = $this->validation('password_null');
                $validations['discount']            = $this->validation('password_null');
                $validations['plan_id']             = $this->validation('password_null');
                $validations['payment_method']      = $this->validation('password_null');
            }
	  	
	      $validator = \Validator::make($this->data->all(), $validations,[
	  		'client_id.required' 			 =>  'Client Name is required.',
	  		'project_id.required' 		     =>  'Project Name is required.',
            'property_id.required'           =>  'Property Name is required.',
	  		'invoice_no.required' 		     =>  'Invoice Number is required.',
            'date.required'                  =>  'Invoice Date is required.',
            'balance.required'               =>  'Balance is required.',
            'balance.numeric'                =>  'Balance Amount should be numeric.',
            'discount.numeric'               =>  'Discount should be numeric.',
	  		'plan_id.required' 				 =>  'Plan is required.',
	  		'payment_method.required'        =>  'Please Select the Payment Method.',
	  	]);
        if(($this->data->balance)>($this->data->amount)){
          $validator->after(function ($validator){
          $validator->errors()->add('balance', 'Balance Amount should not be greater than Total Amount.');
     });
    }
	      return $validator;		
		}
		
    public function addCurrency($action ='add'){
   		$validations = [
	      'currency_name' 						=> $this->validation('name'),
		   'image'								=> $this->validation('photo'),
	  		];
	  	
	   $validator = \Validator::make($this->data->all(), $validations,[
	  		'currency_name.required' 		=>  'Currency name should not be blank',
	    	'image.required' 				=>  'Currency Image is required.',
	    	'image.mimes' 					=>  'Currency Image should be in jpg,jpeg,png format.',
	  	]);
	      return $validator;		
		}
    public function addTax($action ='add'){
        $validations = [
          'name'                        => $this->validation('name'),
        ];
        
        $validator = \Validator::make($this->data->all(), $validations,[
            'name.required'             => 'Tax Name should not be blank',
        ]);
          return $validator;        
        }

        public function addTaxPercentage($action ='add'){
        $validations = [
          'tax_id'                      => $this->validation('name'),
          'percentage'                  => $this->validation('percentage'),
        ];
        
        $validator = \Validator::make($this->data->all(), $validations,[
            'tax_id.required'           => 'Tax Name is required',
            'percentage.required'       => 'Tax Percentage is required' ,
            'percentage.numeric'        => 'Tax Percentage should be numeric',
        ]);
          return $validator;        
        }

        public function addUnits($action ='add'){
   		$validations = [
	      'name' 						=> $this->validation('name'),
	 	];
	  	
	    $validator = \Validator::make($this->data->all(), $validations,[
	    	'name.required'				=> 'Unit Name should not be blank',
	  	]);
	      return $validator;
		}
}
