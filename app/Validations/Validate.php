<?php

namespace Validations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
/**
* 
*/
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
			'description'       => ['required','string','max:1500'],
			'key_points'       	=> ['required','string','max:1500'],
			'title'             => ['required','string'],
			'profile_picture'   => ['required','mimes:doc,docx,pdf'],
			'pin_code' 			=> ['nullable','max:6','min:4'],
			'type' 	           	=> ['required','string'],
			'phone' 	        => ['required','string','numeric','digits:10'],
			'location' 	        => ['required','string'],
			'password'          => ['required','string','max:50'],
			'price'				=> ['required','numeric'],
			'start_from'		=> ['required'],
			'photo'				=> ['required','mimes:jpg,jpeg,png'],
			'photomimes'		=> ['mimes:jpg,jpeg,png','max:2408'],
			'photo_null'		=> ['nullable'],
			'slug_no_space'		=> ['required','alpha_dash','max:255'],
			'password_check'	=> ['required'],
			'newpassword'		=> ['required','max:10'],
			'area'				=> ['required','numeric'],
			'gallery'			=> ['required','mimes:jpg,jpeg,png'],
			'gallery_null'		=> ['nullable'],
			'url' 				=> ['required','url'],
			'pincode' 			=> ['required','min:6','max:6'],

		];
		return $validation[$key];
	}

	public function login(){
        $validations = [
            'email' 		       	 => $this->validation('req_email'),
						'password'       	   => $this->validation('password'),
			    ];
        $validator = \Validator::make($this->data->all(), $validations,[]);
        return $validator;		
	}

	public function custLogin(){
        $validations = [
            'phone' 		       	 => $this->validation('phone'),
			'password'       	   => $this->validation('password'),
			    ];
        $validator = \Validator::make($this->data->all(), $validations,[
        	'phone.required'  		 =>	'Phone is required.',
        	'phone.numeric'  			 =>	'Phone should be in numeric format',
					'password.required'    => 'Password is required',

				]);
        return $validator;		
	}

	public function signup(){
        $validations = [
            'first_name' 		     => $this->validation('name'),
			'last_name'       	   	 => $this->validation('name'),
			'email'					 => array_merge($this->validation('email'),[Rule::unique('users_realestate')]),
			'phone'       	   		 => array_merge($this->validation('phone'),[Rule::unique('users_realestate')]),
			'password'       	   	 => $this->validation('password'),
];
        $validator = \Validator::make($this->data->all(), $validations,[
			'first_name.required'			=> 'Please Enter your First Name',        	
			'last_name.required'			=> 'Please Enter your Last Name',      	
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
			'category_id'		=> $this->validation('name'),
            'name' 		        => $this->validation('name'),
			'slug'  			=> array_merge($this->validation('slug_no_space'),[Rule::unique('property')]),
			'property_purpose'	=> $this->validation('name'),
			'property_type'		=> $this->validation('name'),
			'price'  			=> $this->validation('price'),
			'company_id'  		=> $this->validation('name'),
			'featured_image'  	=> $this->validation('photo'),
			'gallery'			=> $this->validation('id'),
			'gallery.*'			=> $this->validation('gallery'),
			'bedrooms'			=> $this->validation('name'),
			'bathroom'			=> $this->validation('name'),
			'garage'			=> $this->validation('name'),
			'area'				=> $this->validation('area'),
			'agent_id'			=> $this->validation('name'),
			'location'			=> $this->validation('name'),
			'pincode'			=> $this->validation('pincode'),
			'possession'		=> $this->validation('id'),
			'description'		=> $this->validation('description'),
			'key_points'		=> $this->validation('key_points'),
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
        	'name.required'     			=> 'Property Name is Required.',
        	'slug.required'     			=> 'Property Slug is Required.',
        	'slug.unique'     				=> 'This Property Slug has already been taken.',
        	'slug.alpha_dash'     			=> 'No spaces allowed in Property slug.The Slug may only contain letters, numbers, dashes and underscores.',
			'property_purpose.required'		=> 'Property Type is required.',
			'property_type.required'		=> 'Property Type is required.',
        	'price.required'				=> 'Price of Property is required.',
        	'price.numeric'					=> 'Price of the Property must be numeric.',
        	'company_id.required'			=> 'Company is required.',
        	'featured_image.required'		=> 'Property Image is required.',
        	'featured_image.mimes'			=> 'Image Should be in .jpg,.jpeg,.png format.',
        	'gallery.*.required' 			=> 'Gallery Images are required.',
			'gallery.*.mimes' 				=> 'Gallery Images should be in jpg,jpeg,png format.',
			'bedrooms.required'				=> 'Number of bedrooms in a Property is required.',
			'bathroom.required'				=> 'Number of bathroom in a Property is required.',
			'garage.required'				=> 'Number of garage in a Property is required.',
			'area.required'					=> 'Area of a Property is required.',
			'area.numeric'					=> 'Area of a Property must be numeric.',
			'agent_id.required'				=> 'Property Agent is required.',
			'location.required'				=> 'Location of a Property is required.',
			'pincode.required'				=> 'Pin Code is required.',
			'possession.required'			=> 'Possession Time is required.',
			'description.required'			=> 'Description of a Property is required.',
			'key_points.required'			=> 'Key Points for a Property is required.',
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
        	'location.required'				=> 'Location of a Slider is required.',
        	'description.required'			=> 'Slider Description is required.',
        ]);
       
        if($this->data->position != 'center'){
        	if(empty($this->data->mobile)){
		    	$validator->after(function ($validator){
				   $validator->errors()->add('mobile', 'Contact Number is required.');
				});
			}        }
		return $validator;
	}

	public function createContactUs($action='add'){
        $validations = [
        	'name' 				=> $this->validation('name'),
			'email'  			=> $this->validation('req_email'),
            'subject' 		    => $this->validation('name'),
            'number' 		    => $this->validation('phone'),
            'message' 		    => $this->validation('name'),
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
    		'name.required' 		=>  'Name is required.',
    		'email.required' 		=>  'E-mail is required.',
    		'subject.required' 		=>  'Subject is required.',
    		'number.required' 		=>  'Mobile Number is required.',
    		'number.numeric' 		=>  'Mobile Number should be numeric.',
    		'number.digits' 		=>  'Mobile Number should not be greater than 10 digits.',
    		'message.required' 		=>  'Message is required.',

    	]);
        return $validator;		
	}

	public function enquiry($action='add'){
        $validations = [
        	'customer_name' 		=> $this->validation('name'),
			'customer_contact'  	=> $this->validation('phone'),
			'email'  				=> $this->validation('req_email'),
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
    		'customer_name.required' 		=>  'Customer Name is required.',
    		'customer_contact.required' 	=>  'Customer Contact is required.',
    		'customer_contact.numeric' 		=>  'Contact Number should be numeric.',
    		'customer_contact.digits' 		=>  'Contact Number should not be greater than 10 digits.',
    		'email.required' 				=>  'Customer E-mail is required.',

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

	public function addTestimonial($action='add')
	{
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

	public function addAgent($action='add')
	{
		$validations = [
        	'name' 				=> $this->validation('name'),
        	'image' 			=> $this->validation('photo'),
        	'designation' 		=> $this->validation('name'),
    	];
    	if($action == 'edit'){
			$validations['image'] 	= $this->validation('photo_null');
		}
		$validator = \Validator::make($this->data->all(), $validations,[
			'name.required'     	=> 'Agent Name is Required.',
			'image.required'		=> 'Agent Image is required.',
        	'image.mimes'			=> 'Image Should be in .jpg,.jpeg,.png format.',
        	'designation.required'	=> 'Agent Description is required.',
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
        	'address' 				=> $this->validation('name'),
        	'email'					=> $this->validation('req_email'),
        	'phone'					=> $this->validation('name'),
    	];
		$validator = \Validator::make($this->data->all(), $validations,[
			'address.required' 				=>  'Please enter your address.',
			'email.required'				=> 	'Please enter your E-mail.',
			'phone.required'				=> 	'Please enter your Contact Number.',
		]);
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
            'name' 		        => $this->validation('name'),
			'slug'  			=> array_merge($this->validation('slug_no_space'),[Rule::unique('project')]),
			'image'  			=> $this->validation('photo'),
			'location'  		=> $this->validation('name'),
			'description'		=> $this->validation('name'),
    	];
		if($action =='edit'){
			$validations['image'] 	= $this->validation('photo_null');
			$validations['slug'] 	= array_merge($this->validation('slug_no_space'),[
				Rule::unique('project')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
		}
        $validator = \Validator::make($this->data->all(), $validations,[
        	'name.required'     			=> 'Project Name is Required.',
        	'slug.required'     			=> 'Project Slug is Required.',
        	'slug.unique'     				=> 'This Project Slug has already been taken.',
        	'slug.alpha_dash'     			=> 'No spaces allowed in project slug.The Slug may only contain letters, numbers, dashes and underscores.',
        	'image.required'				=> 'Project Image is required.',
        	'image.mimes'					=> 'Image Should be in .jpg,.jpeg,.png format.',
        	'location.required'				=> 'Location of a Project is required.',
        	'description.required'			=> 'Project Description is required.',
        ]);
        return $validator;		
	}
}