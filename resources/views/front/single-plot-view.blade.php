
<!-- <section class="sectionDetails">
	<div class ="container-fluid">
		<div class="row">
			<div class="col-md-9 imageDetail">
				<div id="content_s">
					<div class="behind"> </div>
						<img src="{{url('assets/img/properties')}}/{{$property['featured_image']}}" style="width: 100%" alt="">
						<div class="text_s">
							<h2>{{$property['name']}}</h2>
							<p>By <b>{{$property['company']['name']}}</b> • {{$property['location']}}.</p>
							<p><b><i class="fa fa-rupee"></i> {{number_format($property['price'])}}</b> onwards • <b>{{$property['bedrooms']}}</b> BHK <b>{{$property['category']['name']}}</b> • Area:</b> {{number_format($property['area'])}} sqft.</p>
							<ul>
								<li> Possession <span>: {{$property['possession']}}</span></li>
							</ul>
							<span class ="marking">Highlights</span>		
							<ul class="mt-4">
								{!!($property['key_points'])!!}
							</ul>
							<button name="" class="btn btn-md">I am interested</button> 	
		       			</div>
					</div>
				</div>	
				<div class="col-md-3 fixed-top">
					<div id=" " class="">
						<div class="row">
							<div class="margiN col-md-12">	
								<img src="{{url('assets/img/properties/project-logo.jpg')}}"
									class="sids" alt ="logo">
							</div>
						</div>	
						<div class="row">
							<div class="col-md-12">
								<ul class="item_list">
									<li>Properties Availabale </li>
									<li>Overview</li>
									<li>Amenties </li>
									<li>Gallery </li>
									<li>About the Builder </li>
								</ul>
							</div>	
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="detai_l">
									<h6> Want to know more? </h6>
									<input type="text" name="name" placeholder="Enter name " >	
									<input type="email" name="" placeholder = "Enter Email">	
									<input type="text" name="" placeholder= "Mobile ">		
									<button class="btn btn-success "> Connect with Builder</button>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div> 			
</section>
 -->
<div class="right-space">
<nav class="navbar navbar-expand-lg navbar-dark fixed-top nav-down" id="sideNav">
	<a class="navbar-brand js-scroll-trigger mx-auto img-left" href="#page-top">
		
		<span class="d-lg-block img-left">
			<img src="{{url('assets/img/properties/project-logo.jpg')}}" class="sids" alt ="logo">
		</span>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse my-auto" id="navbarSupportedContent">
		<ul class="navbar-nav">
			<!-- <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#properties">Properties Available</a></li> -->
			<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#overview">Overview</a></li>
			<!-- <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#amenities">Amenities</a></li> -->
			<!--<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#specifications">Specifications</a></li>-->
			<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#gallery">Gallery</a></li>
			<li class="nav-item"><a class="nav-link js-scroll-trigger pb-0" href="#aboutus">About the Builder</a></li>
		</ul>
	</div>
	<div class="form-container-box hidden-xs-down">
		<div class="formcontainer">
			<div class="row">
				<div class="col-md-12">
					<div class="detai_l">
						<h6> Want to know more? </h6>
						<input type="text" name="name" placeholder="Enter name " >	
						<input type="email" name="" placeholder = "Enter Email">	
						<input type="text" name="" placeholder= "Mobile ">		
						<button class="btn btn-success "> Connect with Builder</button>
					</div>	
				</div>
			</div>
		</div>
	</div>
</nav>

<div class="container-fluid p-0">
    <section class="content-section-header hero-background d-flex d-column fcw top">
        <div class="z1 blurbox" style="visibility: visible;">
		 <!--Project Snapshot Start-->
			
			<div class="snapshot"><div>
			<h1 class="mb-0">{{$property['name']}}</h1>
			<div class="subheading">
			<span>By <span class="fbold mr-0"> {{$property['company']['name']}}</span></span>
			<span title="{{$property['location']}}">{{$property['location']}}</span>               
			<br><span class="br"> 
			<span class="fbold"><i class="fa fa-rupee"></i>{{number_format($property['price'])}}</span> onwards</span>

			<span><span class="fbold">{{$property['bedrooms']}}</span> BHK {{$property['category']['name']}}</span>
			<span>Area:  <span class="fbold">{{number_format($property['area'])}} {{$property['units']['name']}}</span></span><br>
			<span>Possession:  <span class="fbold">{{$property['possession']}}</span></span>
			</div>
			<div class="highlights">
				<span class="project-highlights">Highlights:</span>
				<ul>
					<li style="width:100%;">{!!($property['key_points'])!!}</li>
				</ul>
			</div>

		<a data-toggle="modal" data-target="#mobileModal" href="#myModal" class="btn1 btn btn-md">I'm Interested</a></div></div>
	
    			</div>
				<div class="hero-img blurbox" style="visibility: visible;">
				<!--Image Slider Max 4 Image Start-->
					<div data-ride="carousel" class="carousel carousel-fade" id="carousel-example-captions">
						<div role="listbox" class="carousel-inner">
							<div class="carousel-item active">
								<div class="slide-1" style="background: url(../assets/img/properties/{{$property['featured_image']}}) top left no-repeat;">
									<!-- <img class="img-fluid img-round" src="{{url('assets/img/properties')}}/{{$property['featured_image']}}" alt="img"> -->
								</div>
							</div>
						</div>
					</div>
				<!--Image Slider End-->
				</div>
		</section>

<section class="content-section d-flex flex-column" id="overview">
	<a class="card-title">Overview</a>
	<div class="card-section  padding30">
		<div class="container nopadding">
			<div class="row">
				<div class="col-md-5 img-overview">
				<img class="img-fluid img-round" src="{{url('assets/img/properties')}}/{{$property['featured_image']}}" alt="img">
				</div>
				<div class="col-lg-7 col-md-7 col-12 nopadding nopadding-mobile mml-10">
				<!-- <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 160px;"><div class="overview overview-text" style="overflow: hidden; width: 100%; height: 160px;"> -->
					<p>
					{!!($property['description'])!!}
					</p>

				</div>
			</div>
		</div>
		<div class="roundborder overview-detail mt-30">
			<ul class="over-detail">
				<!--<li>Total Units <span class="s-bold"> 5344 Units  </span></li>-->
				<li> Available Units <span class="s-bold">  575 Units </span></li>
				<li> Total No. of Towers <span class="s-bold">  7 Towers</span></li>
				<li> Total No. of Floors <span class="s-bold">  27 Floors</span></li>
				<li> Furnishing <span class="s-bold">  Semifurnished</span></li>
				<li> Project Area <span class="s-bold">  23.40 Acres</span></li>
				<li class="dash-top"></li>
				<li> Launch Year <span class="s-bold"> 2012</span></li>
				<li> Open Space <span class="s-bold">  60%</span></li>
				<li> Approved by <span class="s-bold"> HSVP </span></li>
				<li> OC/CC* <span class="s-bold"> Yes/Yes</span></li>
			</ul>
		</div>
	</div>
</section>


<section class="content-section flex-column" id="gallery">
  <div><a class="card-title"> <span>Take a </span> Closer Look</a>
    <div class="card-section">
      <div class="gallery-box  padding30 nopadding-mobile">
      	<div id="galley">
       		<ul class="smartphotoWrapper" id="gallery">
           	@foreach($property['property_gallery'] as $property['property_galleries'])
	          	<li class="brick">
	             	<span class="thumb1">
		             		<a href="{{url('assets/img/Property Gallery')}}/{{$property['property_galleries']['images']}}" class="js-img-viwer"">
		             		<img src="{{url('assets/img/Property Gallery')}}/{{$property['property_galleries']['images']}}" alt="gallery">
		             		</a>
	             	</span>
	            </li>
            @endforeach
    			</ul>
				</div>
			</div>
    </div>
  </div>
</section>


<section class="content-section  flex-column" id="aboutus">
	<div>
	<a class="card-title"> <span>Know About </span> Builder</a>
		<div class="card-section padding30">
			<div class="container nopadding">
				<div class="row nopadding">
					<div class="col nopadding roundborder builder-logo">
						<img class="my-auto img-fluid" src="{{url('assets/img/company')}}/{{$property['company']['image']}}" alt="Developers">
					</div>
					<div class="col-lg-9 col-md-9 col-12 nopadding pl-4">
						<p>{!! $property['company']['description'] !!}</p>
					</div>
				</div>
			</div>
			<div class="row nopadding mt-4">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12 nopadding">
				<span class="developer-title">Site Address</span>
					<div class="address-box roundborder mr-4">
					{{$property['location']}}
					</div>
				</div>
				<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-12 nopadding">
					<span class="developer-title">Corporate Address</span>
					<div class="address-box roundborder">
						Plot No. 18, 2nd Floor, Institutional Area , Gurugram, Delhi NCR, <br>
						122001, India.
					</div>
				</div> -->
			</div>
		</div>
	</div>
	
</section>


<!-- <div class="mobile-contact">
<div class="row">
<div class="col-6 nopadding">
<span class="builder-name">Contact Builder</span>
<span class="builder-contact">+91-99xxxxxx15</span></div>
<div class="col-6 nopadding"><a data-toggle="modal" data-target="#mobileModal" href="#myModal" class="mobile-fix-cta" onclick="fireGaForMicrosite('CTA4')">Get Phone Number</a></div>
</div>
</div>
<div class="modal fade" id="mobileModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<button type="button" class="close close-mobile-modal" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true"><img src="img/icons/close.svg" height="18" width="18"></span>
</button>
<div class="modal-body nopadding">
<iframe id="GB_frame" class="iframe5" src="contact.html"></iframe>
</div>
</div>
</div>
</div>
    </div> -->
