
<div class="right-space">
<nav class="navbar navbar-expand-lg navbar-dark fixed-top nav-down" id="sideNav">
	<div class="navbar-brand1 js-scroll-trigger mx-auto img-left" href="#page-top">
		<span class="d-lg-block img-left singleLogo">
			<a href="{{url('/')}}" class="navbar-brand"><img src="{{url('assets/img/company')}}/{{$property['company']['image']}}" alt="gallery" height="100"></a>
		</span>
	</div>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#overview">Overview</a></li>
			<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#gallery">Gallery</a></li>
			<li class="nav-item"><a class="nav-link js-scroll-trigger pb-0" href="#aboutus">About the Builder</a></li>
		</ul>
	</div>
	<div class="form-container-box hidden-xs-down">
		<form role="plotenquiryform" action="{{url('plotenquiryform')}}" method="POST">
				{{csrf_field()}}
			<div class="formcontainer">
				<div class="row">
					<div class="col-md-12">
						<div class="detai_l">
							<h6> Want to know more? </h6>
							<input type="hidden" id="id" name="id" value="{{!empty($property['id'])?$property['id']:''}}">
							<input type="text" name="name" placeholder="Enter name">	
							<input type="email" name="email" placeholder="Enter Email">	
							<input type="text" name="mobile" placeholder="Mobile ">		
							<button type="button" class="btn btn-red" data-request="ajax-submit" data-target='[role="plotenquiryform"]'> Connect with Builder</button>
						</div>	
					</div>
				</div>
			</div>
		</form>
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

		<a data-toggle="modal" href="#interestedModal" class="btn1 btn btn-md">I'm Interested</a></div></div>
	
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
					<span class="image-overview">
						<img class="img-fluid img-round" src="{{url('assets/img/properties')}}/{{$property['featured_image']}}" alt="img">
					</span>
				</div>
				<div class="col-lg-7 col-md-7 col-12 nopadding nopadding-mobile mml-10 propertyDescription">
				<!-- <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 160px;"><div class="overview overview-text" style="overflow: hidden; width: 100%; height: 160px;"> -->
					<p>
					{!!($property['description'])!!}
					</p>

				</div>
			</div>
		</div>
		<!-- <div class="roundborder overview-detail mt-30">
			<ul class="over-detail"> -->
				<!--<li>Total Units <span class="s-bold"> 5344 Units  </span></li>-->
				<!-- <li> Available Units <span class="s-bold">  575 Units </span></li>
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
		</div> -->
	</div>
</section>


<!-- <section class="content-section d-flex flex-column" id="amenities">
<div>
<a class="card-title"> <span>Exclusive </span> Amenities</a>
<div class="card-section">
<div class="amenities-box"> -->
<!--<div class="white-gradient"></div>-->
<!-- <div class="owl-carousel owl-amenities"> -->
	
		<!-- <div class="row">
			<div class="col-md-12">
				<ul class="amenities-list">
					<li>
					    <div class="amenties-title">Sports</div>
					</li>
					<li>
						<i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Meditation Centre</span>
					</li>
					<li><i class="fa fa-bell icon-meditation-area"></i></span>
						<span class="am-txt">Jogging / Walking Track</span>
					</li>
					<li>
						<i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Game Area</span>
					</li>
					
				</ul>
			</div>
		</div>
	
	
		<div class="row">
			<div class="col-md-12">
				<ul class="amenities-list">
					<li>
					    <div class="amenties-title">Sports</div>
					</li>
					<li>
						<i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Meditation Centre</span>
					</li>
					<li><i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Jogging / Walking Track</span>
					</li>
					<li>
						<i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Meditation Centre</span>
					</li>	
				</ul>
			</div>
		</div>
	
	
		<div class="row">
			<div class="col-md-12">
				<ul class="amenities-list">
					<li>
					    <div class="amenties-title">Sports</div>
					</li>
					<li>
						<i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Meditation Centre</span>
					</li>
					<li><i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Jogging / Walking Track</span>
					</li>
					<li>
						<i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Meditation Centre</span>
					</li>	
				</ul>
			</div>
		</div>
	
	
		<div class="row">
			<div class="col-md-12">
				<ul class="amenities-list">
					<li>
					    <div class="amenties-title">Sports</div>
					</li>
					<li>
						<i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Swimming Pool</span>
					</li>
					<li><i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Jogging / Walking Track</span>
					</li>
					<li>
						<i class="fa fa-bell icon-meditation-area"></i>
						<span class="am-txt">Meditation Centre</span>
					</li>		
				</ul>
			</div>
		</div>
	


</div>
</div>
</section> -->


<section class="content-section flex-column" id="gallery">
  <div><a class="card-title"> <span>Take a </span> Closer Look</a>
    <div class="card-section">
      	<div class="gallery-box  padding30 nopadding-mobile">
      		<div id="galley">
	       		<ul class="smartphotoWrapper" id="gallery">
	             	@foreach($property['property_gallery'] as $property['property_galleries'])
		          	<li class="brick">
		             	<span class="thumb1">
		             		<a href="{{url('assets/img/PropertyGallery')}}/{{$property['property_galleries']['images']}}" class="js-img-viwer">			
			             		<img src="{{url('assets/img/PropertyGallery')}}/{{$property['property_galleries']['images']}}" alt="gallery">
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
					<div class="col-md-3 nopadding roundborder builder-logo">
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
			</div>
		</div>
	</div>
	
</section>
<!-- interested in -->
<div class="modal contact-modal fade" id="interestedModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <img src="{{url('assets/img/logo.png')}}" alt="Devdrishti Infrahomes" height="60">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
     

      <div class="modal-body popupmodal-body">
        <form role="plotenquiry" action="{{url('plotenquiry')}}" method="POST">
					{{csrf_field()}}
          <div class="formcontainer">
						<div class="row">
							<div class="col-md-12">
								<div class="detai_l">
									<h6 style="text-align: center;margin-top: 20px;"> Want to know more? </h6>
									<input type="hidden" id="id" name="id" value="{{!empty($property['id'])?$property['id']:''}}">
									<input type="text" name="name" placeholder="Enter name">	
									<input type="email" name="email" placeholder = "Enter Email">	
									<input type="text" name="mobile" placeholder= "Mobile ">		
									<button type="button" class="btn btn-red" data-request="ajax-submit" data-target='[role="plotenquiry"]'> Connect with Builder</button>
								</div>	
							</div>
						</div>
					</div>
        </form>
      </div>
    </div>
  </div>
</div>

