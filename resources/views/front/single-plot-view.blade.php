
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
			<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#properties">Properties Available</a></li>
			<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#overview">Overview</a></li>
			<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#amenities">Amenities</a></li>
			<!--<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#specifications">Specifications</a></li>-->
			<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#gallery">Gallery</a></li>
			<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#mapview">Map View</a></li>
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
								<div class="slide-1"></div>
							</div>
						</div>
					</div>
				<!--Image Slider End-->
				</div>
		</section>

<section class="content-section d-flex flex-column" id="properties">
	<div>
		<a class="card-title">Properties <span>You Can Buy</span></a></div>
		<div class="card-section no-mobile-padding">
			<div class="tab-value">
				<ul class="nav nav-tabs unittab">
				    <li class="item"><a data-toggle="tab" href="#1bhk" class="active">2 BHK FLATS</a></li>
				    <li class="item"><a data-toggle="tab" href="#2bhk">3 BHK FLATS </a></li>
				    <li class="item"><a data-toggle="tab" href="#3bhk">4 BHK </a></li>
				</ul>
			</div>
			<div class="tab-content">
			<div id="1bhk" class="tab-pane fade in active show">
				<div class="tab-content">
				<div id="1_bhk_1" class="tab-pane fade in active show">
				<div class="container">
				<div class="tabpaneContainer row ">
				<div class="col-lg-4 col-md-4 col-12">
					<div class="thumbnail">
						<a href="javascript:void(0);" class="jfloorplan">
							<img src="../assets/img/properties/house-map.jpg" alt="house">
						</a>
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-12 nopadding">
				<div class="unit-detail-container">
				<div class="row">
					<ul class="property-type-detaiil">
						<li><i class="fa fa-rupee"></i>2.06 Cr <span>onwards</span></li>
						<li> 2 BHK Flat<span>  2441 sqft</span></li>
					</ul>
				</div>
				<div class="FloorDetail">
					<ul class="col-12 col-sm-12 nopadding nopadding-mobile">
						<li><span>Bedrooms <b> 2</b></span></li>
						<li><span>Bathrooms <b> 3</b></span></li>
						<li><span>Balconies <b> 3</b></span></li>
						<li><span>Servant&nbsp;Room <b> 1</b></span></li>
					</ul>
				</div>
				<div class="uspDetails">
				<ul class="nopadding">
				<li>One of Asia's Largest Residential Skywalk.</li>
				  <li>Over 2,50,000 sq. ft. of Activity Spaces.</li>
				  <li>Low Population Density Project.</li>
				  <li>Club Windchimes with facilities like Mini  Theatre, Bio Diversity Pons, Full Lap Swimming Pool, Gym, Library, Squash Court  and Much More.</li>
				  <li>Adjacent to Delhi Green zone.</li>
				  <li>Near IGI Airport.</li>

				</ul>
				</div>
				<div>
				<a data-toggle="modal" data-target="#mobileModal" href="#myModal" class="cta-btn border-color text-color">Contact Now</a>
				</div>
			</div>
		</div>
</div>
</div>
</div>

		</div>
		</div>


		<!-- <div id="2bhk" class="tab-pane fade show">
		    <div class="sub-tab-container">
		        <ul class="nav nav-tabs owl-carousel owl-unitdetail owl-loaded">   
		        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;"><div class="owl-item"><li class="item"><a data-toggle="tab" class="active" href="#2_bhk_1">2802 sqft</a></li></div><div class="owl-item"><li class="item"><a data-toggle="tab" href="#2_bhk_2">3763 sqft</a></li></div></div></div></div></ul>
		    </div>
 -->
		<!-- <div class="tab-content">
		<div id="2_bhk_1" class="tab-pane fade in active show">
		<div class="container">
		<div class="tabpaneContainer row ">
		<div class="col-lg-4 col-md-4 col-12 nopadding">
		<div class="thumbnail imghvr-zoom-in">
		<a href="assets/img/properties/house-map.jpg" class="js-img-viwer-floorplan">
			<img src="assets/img/properties/house-img.jpg" alt="House" width="100%">
		</a></div>
		</div>
		<div class="col-lg-8 col-md-8 col-12 nopadding">
		<div class="unit-detail-container">
		<div class="row"><ul class="property-type-detaiil">
		<li><i class="fa fa-rupee"></i>2.32 Cr <span>onwards</span>
		</li>
		<li> 3 BHK Flat <span>  2802 sqft</span></li>
		</ul>
		</div>
		<div class="FloorDetail">
		<ul class="col-12 col-sm-12 nopadding nopadding-mobile">
			<li><span>Bedrooms <b> 3</b></span></li>
			<li><span>Bathrooms <b> 4</b></span></li>
			<li><span>Balconies <b> 4</b></span></li>
			<li><span>Servant&nbsp;Room <b> 1</b></span></li>
		</ul>
		</div>
		<div class="uspDetails">
		<ul class="nopadding">
		<li>One of Asia's Largest Residential Skywalk.</li>
		  <li>Over 2,50,000 sq. ft. of Activity Spaces.</li>
		  <li>Low Population Density Project.</li>
		  <li>Club Windchimes with facilities like Mini  Theatre, Bio Diversity Pons, Full Lap Swimming Pool, Gym, Library, Squash Court  and Much More.</li>
		  <li>Adjacent to Delhi Green zone.</li>
		  <li>Near IGI Airport.</li>
		</ul>
		</div>
		<div>
		<a data-toggle="modal" data-target="#mobileModal" href="#myModal" class="cta-btn border-color text-color"">Contact Now</a>
		</div></div></div></div></div></div>

		<div id="2_bhk_2" class="tab-pane fade show">
		<div class="container">
		<div class="tabpaneContainer row ">
		<div class="col-lg-4 col-md-4 col-12 nopadding">
		<div class="thumbnail imghvr-zoom-in">
		<a href="img/floor-plan/3763.jpg" class="js-img-viwer-floorplan" data-caption="3 BHK Flat, 3763 sqft" data-id="raion" data-group="nogroup" data-index="2"><img src="img/floor-plan/3763s.jpg" alt="Ashiana Anmol" width="100%"><i class="sp1 zoom"></i></a></div>
		</div>
		<div class="col-lg-8 col-md-8 col-12 nopadding">
		<div class="unit-detail-container">
			<div class="row">
				<ul class="property-type-detaiil">
					<li><i class="fa fa-rupee"></i> 3.08 Cr <span>onwards</span></li>
					<li> 3 BHK Flat <span>  3763 sqft</span></li>
				</ul>
			</div>
			<div class="FloorDetail">
				<ul class="col-12 col-sm-12 nopadding nopadding-mobile">
					<li><span>Bedrooms <b> 3</b></span></li>
					<li><span>Bathrooms <b> 4</b></span></li>
					<li><span>Balconies <b> 4</b></span></li>
					<li><span>Servant Room <b> 1</b></span></li>
				</ul>
			</div>
			<div class="uspDetails">
				<ul class="nopadding">
				<li>One of Asia's Largest Residential Skywalk.</li>
				  <li>Over 2,50,000 sq. ft. of Activity Spaces.</li>
				  <li>Low Population Density Project.</li>
				  <li>Club Windchimes with facilities like Mini  Theatre, Bio Diversity Pons, Full Lap Swimming Pool, Gym, Library, Squash Court  and Much More.</li>
				  <li>Adjacent to Delhi Green zone.</li>
				  <li>Near IGI Airport.</li>
				</ul>
			</div>
			<div>
				<a data-toggle="modal" data-target="#mobileModal" href="#myModal" class="cta-btn border-color text-color" >Contact Now</a>
			</div>
		</div>

		</div>
		</div> -->


		<div id="3bhk" class="tab-pane fade show">
		    

		<div class="tab-content">
		<div id="3_bhk_1" class="tab-pane fade in active show">
		<div class="container">
		<div class="tabpaneContainer row ">
		<div class="col-lg-4 col-md-4 col-12 nopadding">
		<div class="thumbnail imghvr-zoom-in">
			<a href="javascript:void(0);" class="js-img-viwer-floorplan">
				<img src="../assets/img/properties/house-map.jpg" alt="house" width="100%">
			</a>
		</div>
		</div>
		<div class="col-lg-8 col-md-8 col-12 nopadding">
		<div class="unit-detail-container">
		<div class=""><ul class="property-type-detaiil">
		<li>3.98 Cr <span>onwards</span></li>

		<!--Price on request format-->
		<li> 4 BHK Flat <span>  4857 sqft</span></li>
		<!--<li style="font-weight: normal;">Price on Request<span>&nbsp; </span></li>-->

		</ul>
		</div>
		<div class="FloorDetail">
		<ul class="col-12 col-sm-12 nopadding nopadding-mobile">
		<li><span>Bedrooms <b> 4</b></span></li>
		<li><span>Bathrooms <b> 4</b></span></li>
		<li><span>Balconies <b> 5</b></span></li>
		<li><span>Servant&nbsp;Room <b> 1</b></span></li>

		</ul>
		</div>
		<div class="uspDetails">
		<ul class="nopadding">
		<li>One of Asia's Largest Residential Skywalk.</li>
		  <li>Over 2,50,000 sq. ft. of Activity Spaces.</li>
		  <li>Low Population Density Project.</li>
		  <li>Club Windchimes with facilities like Mini  Theatre, Bio Diversity Pons, Full Lap Swimming Pool, Gym, Library, Squash Court  and Much More.</li>
		  <li>Adjacent to Delhi Green zone.</li>
		  <li>Near IGI Airport.</li>
		</ul>
		</div>
		<div>
		<a data-toggle="modal" data-target="#mobileModal" href="#myModal" class="cta-btn border-color text-color" >Contact Now</a>
		</div></div></div></div></div></div>

		</div>
		</div>

		</div>
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

<section class="content-section d-flex flex-column" id="amenities">
<div>
<a class="card-title"> <span>Exclusive </span> Amenities</a>
<div class="card-section">
<div class="amenities-box">
<!--<div class="white-gradient"></div>-->
<!-- <div class="owl-carousel owl-amenities"> -->
	
		<div class="row">
			<ul class="amenities-list">
				<li>
				    <div class="amenties-title">Sports</div>
				</li>
				<li>
					<span class="icon-meditation-area"></span><span class="am-txt">Meditation Centre</span>
				</li>
				<li><span class="icon icon-jogging-strolling-track"></span>
					<span class="am-txt">Jogging / Walking Track</span>
				</li>
				<li>
					<span class="icon-meditation-area"></span><span class="am-txt">Meditation Centre</span>
				</li>
				<li><span class="icon-jogging-strolling-track"></span>
					<span class="am-txt">Jogging / Walking Track</span>
				</li>
			</ul>
		</div>
	
	
		<div class="row">
			<ul class="amenities-list">
				<li>
				    <div class="amenties-title">Sports</div>
				</li>
				<li>
					<span class="icon icon-meditation-area"></span><span class="am-txt">Meditation Centre</span>
				</li>
				<li><span class="icon icon-jogging-strolling-track"></span>
					<span class="am-txt">Jogging / Walking Track</span>
				</li>
				<li>
					<span class="icon icon-meditation-area"></span><span class="am-txt">Meditation Centre</span>
				</li>
				<li><span class="icon icon-jogging-strolling-track"></span>
					<span class="am-txt">Jogging / Walking Track</span>
				</li>
			</ul>
		</div>
	
	
		<div class="row">
			<ul class="amenities-list">
				<li>
				    <div class="amenties-title">Sports</div>
				</li>
				<li>
					<span class="icon icon-meditation-area"></span><span class="am-txt">Meditation Centre</span>
				</li>
				<li><span class="icon icon-jogging-strolling-track"></span>
					<span class="am-txt">Jogging / Walking Track</span>
				</li>
				<li>
					<span class="icon icon-meditation-area"></span><span class="am-txt">Meditation Centre</span>
				</li>
				<li><span class="icon icon-jogging-strolling-track"></span>
					<span class="am-txt">Jogging / Walking Track</span>
				</li>
			</ul>
		</div>
	
	
		<div class="row">
			<ul class="amenities-list">
				<li>
				    <div class="amenties-title">Sports</div>
				</li>
				<li>
					<span class="icon icon-meditation-area"></span><span class="am-txt">Swimming Pool</span>
				</li>
				<li><span class="icon icon-jogging-strolling-track"></span>
					<span class="am-txt">Jogging / Walking Track</span>
				</li>
				<li>
					<span class="icon icon-meditation-area"></span><span class="am-txt">Meditation Centre</span>
				</li>
				<li><span class="icon icon-jogging-strolling-track"></span>
					<span class="am-txt">Jogging / Walking Track</span>
				</li>
			</ul>
		</div>
	
<!-- </div> -->

<!-- <div class="item">
<div class="row">
<ul class="amenities-list">
<li><span class="icon icon-tennis"></span><span class="am-txt">Billards &amp; Table Tennis Room</span></li>
<li><span class="icon icon-cards-room"></span><span class="am-txt">Cards Room</span></li>
<li><span class="icon icon-kids-play-area"></span><span class="am-txt">Children’s Play Areas</span></li>

</ul>
</div>
</div>
<div class="item">
<div class="row">
<ul class="amenities-list">
<li><span class="icon icon-badminton-court"></span><span class="am-txt">Badminton Court</span></li>

<li>
    <div class="amenties-title">Leisure</div>
</li>
<li><span class="icon icon-banquet-hall"></span><span class="am-txt">Banquet And Party Halls</span></li>


</ul>
</div>
</div></div>
<div class="item">
<div class="row">
<ul class="amenities-list">


<li><span class="icon icon-Barbeque-Pit"></span><span class="am-txt">Outdoor Barbecue Area</span></li>
<li><span class="icon icon-event-space-amphitheatre"></span><span class="am-txt">Mini Theatre</span></li>
<li><span class="icon icon-coffee-lounge-restaurant"></span><span class="am-txt">Restaurant </span></li>

</ul>
</div>
</div></div><div class="item">
<div class="row">
<ul class="amenities-list">

<li><span class="icon icon-power-backup"></span><span class="am-txt">Central Power Back-up </span></li>

<li>
    <div class="amenties-title">Security</div>
</li>
<li><span class="icon icon-security"></span><span class="am-txt">Security </span></li>



</ul>
</div>
</div></div><div class="item">
<div class="row">
<ul class="amenities-list">


<li><span class="icon icon-intercom-facility"></span><span class="am-txt">Intercom Facility </span></li>

<li><div class="amenties-title">Environment</div>
</li>
<li><span class="icon icon-park"></span><span class="am-txt">Landscaped gardens</span></li>


</ul> -->
<!-- </div> -->

</div>
</div>
</section>


<section class="content-section flex-column" id="gallery">
    <div><a class="card-title"> <span>Take a </span> Closer Look</a>
      <div class="card-section">
        <div class="gallery-box  padding30 nopadding-mobile">
          	<div id="galley">
           		<ul class="smartphotoWrapper" id="gallery">
	            	<li class="brick">
		             	<span class="thumb1"> 
		             		<a href="../assets/img/gallery/slider7.jpg" class="js-img-viwer"">
		             			<img src="../assets/img/gallery/slider7.jpg" alt="gallery">
		             		</a> 
		             	</span>
		             	
		             </li>
		             <li class="brick">
		             	<span class="thumb1">
		             	 <a href="../assets/img/gallery/slider7.jpg" class="js-img-viwer"">
		             	 	<img src="../assets/img/gallery/slider7.jpg" alt="gallery">
		             	 </a> 
		             	</span>
		             </li>
		             <li class="brick">
		             	<span class="thumb4"> 
		             		<a href="../assets/img/gallery/slider7.jpg" class="js-img-viwer"">
		             			<img src="../assets/img/gallery/slider7.jpg" alt="gallery">
		             		</a> 
		             	</span>
		             	
		             </li>
		             
		            <li class="brick">
		            	<span class="thumb1">
		            		<a href="../assets/img/gallery/slider7.jpg" class="js-img-viwer"">
		            			<img src="../assets/img/gallery/slider7.jpg" alt="gallery">
		            		</a>
		            	</span>
		            </li>
		            <li class="brick">
		            	<span class="thumb1">
		            		<a href="../assets/img/gallery/slider7.jpg" class="js-img-viwer"">
		            			<img src="../assets/img/gallery/slider7.jpg" alt="gallery">
		            		</a>
		            	</span>
		            </li>
        		</ul>
    		</div>
		</div>
		<div class="row view-all-photo-box">               
		    <div class="col-md-12 text-center m-b-20">
		        <a href="javascript:void(0);" class="js-img-viwer cta-btn-gallery border-color text-color" data-id="raion" data-group="nogroup" data-index="8">View All Photos</a>
		    </div>
		    
		</div>
      </div>
    </div>
  </section>
<section class="content-section  flex-column" id="mapview">
	<div>
	<a class="card-title">Map <span>View </span> </a>
		<div class="card-section">
			<div class="tab-value">
				<ul class="nav nav-tabs unittab">
					<li><a href="javascript:void(0);"> Location Map</a></li>
				</ul>
			</div>
			<div class="tabContent">
				<div id="locationadvantage" class="">
					<div class="row padding30">
						<div class="col-lg-4 nopadding hidden-xs">
							<div class="roundborder location-ad-img">
								
							</div>
						</div>
						<div class="col-lg-8 col-12 no-mobile-padding">
							<ul class="advantage">
								<li>Close Proximity to Delhi.</li>
								<li>Near IGI Airport.</li>
								<li>Adjacent to Delhi Green zone.</li>
							</ul>
						</div>
					</div>
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
						<img class="my-auto img-fluid" src="../assets/img/services/1550063716ab1549887525FsD6.png" alt="Developers">
					</div>
					<div class="col-lg-9 col-md-9 col-12 nopadding pl-4">
						<p>
						Experion is a 100% FDI funded real estate developer backed by Experion Holdings Pte. Ltd., Singapore, the real estate investing arm of the $2.5 billion AT Holdings group of companies. Other businesses of AT Holdings include Construction, Oil &amp; Gas, Renewable Energy and Asset Management.<br>

						At Experion we believe that good experiences foster enduring relationships. We offer transparency in transaction, thought-leadership in action, customer insight in our developments and thus, transform every relationship into positive, engaging and memorable experiences that people would love to come back to.<br>

						With substantial Development Rights across various locations in India, Experion is developing townships, group-housing projects, commercial landmarks, organized retail destinations, hotels and resorts across Andhra Pradesh, Delhi NCR, Goa, Haryana, Maharashtra, Punjab, Tamil Nadu and Uttar Pradesh.
						</p>
					</div>
				</div>
			</div>
			<div class="row nopadding mt-4">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12 nopadding">
				<span class="developer-title">Site Address</span>
					<div class="address-box roundborder mr-4">
					Sector 112, Gurugram.
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12 nopadding">
					<span class="developer-title">Corporate Address</span>
					<div class="address-box roundborder">
						Plot No. 18, 2nd Floor, Institutional Area , Gurugram, Delhi NCR, <br>
						122001, India.
					</div>
				</div>

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
