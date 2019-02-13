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
			'profile_picture'   => ['required','mimes:doc,docx,pdf','max:2048'],
			'pin_code' 			=> ['nullable','max:6','min:4'],
			'type' 	            => ['required','string'],
			'phone' 	        => ['required','string','numeric'],
			'location' 	        => ['required','string'],
			'password'          => ['required','string','max:50'],
			'price'				=> ['required','numeric'],
			'start_from'		=> ['required'],
			'photo'				=> ['required','mimes:jpg,jpeg,png','max:2408'],
			'photomimes'		=> ['mimes:jpg,jpeg,png','max:2408'],
			'photo_null'		=> ['nullable'],
			'slug_no_space'		=> ['required','alpha_dash','max:255'],
			'password_check'	=> ['required'],
			'newpassword'		=> ['required','max:10'],
			'area'				=> ['required','numeric'],
			'gallery'			=> ['required','mimes:jpg,jpeg,png','max:2048'],
			'gallery_null'		=> ['nullable'],
			'url' 				=> ['required','url'],

		];
		return $validation[$key];
	}

	public function login(){
        $validations = [
            'email' 		       => $this->validation('req_email'),
			'password'       	   => $this->validation('password'),
    	];
        $validator = \Validator::make($this->data->all(), $validations,[]);
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

	public function addPlot($action='add'){
		$validations = [
            'name' 		        => $this->validation('name'),
			'slug'  			=> array_merge($this->validation('slug_no_space'),[Rule::unique('plots')]),
			'price'  			=> $this->validation('price'),
			'featured_image'  	=> $this->validation('photo'),
			'gallery'			=> $this->validation('id'),
			'gallery.*'			=> $this->validation('gallery'),
			'property_type'		=> $this->validation('name'),
			'bedrooms'			=> $this->validation('name'),
			'area'				=> $this->validation('area'),
			'location'			=> $this->validation('name'),
			'description'		=> $this->validation('description'),
			'key_points'		=> $this->validation('key_points'),
    	];
    	if($action == 'edit'){
			$validations['featured_image'] 	= $this->validation('photo_null');
			$validations['gallery'] = $this->validation('gallery_null');
			$validations['slug'] = array_merge($this->validation('slug_no_space'),[
				Rule::unique('plots')->where(function($query){
					$query->where('id','!=',$this->data->id);
				})
			]);
		}
    	$validator = \Validator::make($this->data->all(), $validations,[
        	'name.required'     			=> 'Plot Name is Required.',
        	'slug.required'     			=> 'Plot Slug is Required.',
        	'slug.unique'     				=> 'This Plot Slug has already been taken.',
        	'slug.alpha_dash'     			=> 'No spaces allowed in plot slug.The Slug may only contain letters, numbers, dashes and underscores.',
        	'price.required'				=> 'Price of Plot is required.',
        	'price.numeric'					=> 'Price of the plot must be numeric.',
        	'featured_image.required'		=> 'Plot Image is required.',
        	'featured_image.mimes'			=> 'Image Should be in .jpg,.jpeg,.png format.',
        	'featured_image.max' 			=> 'Images should not be greater than 2MB.',
        	'gallery.*.required' 			=> 'Gallery Images are required.',
			'gallery.*.mimes' 				=> 'Gallery Images should be in jpg,jpeg,png format.',
			'gallery.*.max' 				=> 'Gallery Images should not be greater than 2MB.',
			'property_type.required'		=> 'Plot Type is required.',
			'bedrooms.required'				=> 'Number of bedrooms in a plot is required.',
			'area.required'					=> 'Area of a plot is required.',
			'area.numeric'					=> 'Area of a plot must be numeric.',
			'location.required'				=> 'Location of a plot is required.',
			'description.required'			=> 'Description of a Plot is required.',
			'key_points.required'			=> 'Key Points for a plot is required.',
        ]);
        return $validator;
	}

	public function addslider($action='add'){
    	$validations = [
            'image' 		        => $this->validation('photo'),
    	];
		if($action == 'edit'){
			$validations['image'] 	= $this->validation('photo_null');
		}
        $validator = \Validator::make($this->data->all(), $validations,[
        	'image.required'     			=> 'Slider Image is required.',
        	'image.mimes'					=> 'Slider Should be in .jpg,.jpeg,.png format.',
        ]);
		return $validator;
	}

	public function createContactUs($action='add'){
        $validations = [
        	'name' 				=> $this->validation('name'),
			'email'  			=> $this->validation('req_email'),
            'subject' 		    => $this->validation('name'),
            'message' 		    => $this->validation('name'),
    	];
    	
        $validator = \Validator::make($this->data->all(), $validations,[
    		'name.required' 		=>  'Name is required.',
    		'email.required' 		=>  'E-mail is required.',
    		'subject.required' 		=>  'Subject is required.',
    		'message.required' 		=>  'Message is required.',

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
}