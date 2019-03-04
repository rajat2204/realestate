
	<section class ="bg property-section" id="property-section">	
		<div class="container">
			<nav >
			  <div class="nav nav-tabs" id="nav-tab" role="tablist">
			    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
			    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
			  </div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
			  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<div class="head_g clearfix">
					
		 			<p >{{$count}} Apartments/Flats for {{$property_type}} in {{$city}}
		 			</p>
		  				<button class="btn btn-sm btn-default text-dark ">
		  					Sort By
		  				<select class = "hovs">
							<option> Relevence  </option>
							<option> Price -high to low  </option>
							<option> Price -high to low  </option>
							<option> Price -high to low  </option>
						</select>
					</button>
				 </div>
				@if(!empty($property))
				@foreach($property as  $value) 
				<div class="container ml-0 mr-0 pr-0 pl-0">
				  <div id="wraperr">
				  	  		<div class ="row ">
				 	  	  		 	<div class="col-md-2 ">
						  				<div class="boxd">
						  				<img src= "{{url('assets/img/properties')}}/{{$value['featured_image']}} " alt=" ">
						  				<span class="bulge">{{count($value['property_gallery'])}} photo(s)</span> 
										<p class="utopia">Posted:{{ ___ago($value['updated_at'])}} </p>			
						  				</div>
						  			</div>
								 	<div class="col-md-2 trims">	
					   				  <div class ="tex_t text-light ">	

										<i class="fa fa-rupee text-blue" ></i>
										<span>{{number_format($value['price'])}}</span>

						 			  </div>
							  		</div>
							  	
						  <div class="col-md-8 ">		 
							 <div class="row ">
							 	<h6 class="mt-2"><b>1 {{ucfirst($value['property_type'])}}</b> for {{$value['property_purpose']}} in {{$value['location']}}
						  		<span><i class="fa fa-map-marker text "></i>What's near By </span></h6>
							 </div>	 
						  	 <div class="row ">	
						  		<div class="col-md-3 sims">
						  			<span class="text-secondary">Carpet area </span>
						  			<span class="text-dark">{{$value['area']. ' '}}sqft.</span>
						  		</div>
						  		<div class="col-md-3 sims">
						  			<span class="text-secondary">Status</span>
						  			<span class="text-dark">Possession By {{' ' .$value['possession']}}</span>
						  		</div>				
								<div class="col-md-3 sims">
						  			<span class="text-secondary">Property Name</span>
						  			<span class="text-dark">{{$value['name']}}</span>
								</div>
						  		<div class="col-md-3 sims">
						  			<span class="text-secondary">Agent Name</span>
						  			<span class="text-dark">{{$value['agent']['name']}}</span>
						  		</div>		  				  		
						  	</div>
						  	<div class="row">

							<div class="property-desc">
						  		<p title="{{strip_tags($value['description'])}}">{{str_limit(strip_tags($value['description']),80)}} </p>
						  	</div>

						  	</div>
						  	<div class="row">
						  		<div class="col-md-3 sim">
						  			<button class="btn btn-blue">Contact Agent</button>
						  		</div>
		  						<div class="col-md-3 sim ">
		  						<button class="btn btn-outline-default red">View Phone NO.</button>	  			
						  		</div>
						  		<div class="col-md-3 sim">
						  			<i class="fa fa-heart bd text-blue mr-1"></i><small class="sharefeedback">Share Feedback</small>
						  		</div>
						  		<div class="col-md-3 sim disabl">
						  			<small class=""> Company/Owner Name</small>
						  			<small >{{$value['company']['name']}}</small>
						  		</div>			  		
						  	</div>	
					      </div>
					    </div>				      
			     </div>
			 </div>
			    @endforeach
			@endif
			</div>			    
				 <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">  
					  <div class="wrapper">			  	
					  	<div class="row">
					  	
					  	</div>
				      </div>	
				  </div>
			</div>
		</div>
	</section>	