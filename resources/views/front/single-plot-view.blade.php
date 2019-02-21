<section class="sectionDetails">
	<div class ="container-fluid">
		<div class="row">
			<div class="col-md-8 imageDetail">
				<div id="content_s">
					<div class="behind"> </div>
						<img src="{{url('assets/img/properties')}}/{{$property['featured_image']}}" style="width: 100%" alt="">
					<div class="text_s">
						<h2>{{$property['name']}}</h2>
						<p>By <b>Dreamz Infrarealty Pvt</b> Ltd • {{$property['location']}} </p>
						<p><b> {{number_format($property['price'])}}</b> onwards • 2 <b>BHK Flats • Area:</b> {{number_format($property['area'])}} sqm</p>
						<ul ><li> Possession <span>: Mar 2022</span></li></h6></p>
						<span class ="marking">Highlights</span>		
						<ul  class="mt-4">
							<li>{{strip_tags($property['key_points'])}}</li>
						</ul>
						<button name ="" class ="btn btn-md">I am interested </button> 	
	       			</div>
					</div>
				</div>	
				<div class="col-md-4 ">
					<div id="content_s ">
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
									<li>Specifications </li>
									<li>Gallery </li>
									<li>Map view </li>
									<li>About the Builder </li>
								</ul>
							</div>	
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="detai_l">
									<h4> Want to know more? </h4>
									<div class="form-row">
										<input type="text" class="form-control" name="name" placeholder ="Name"> 
									</div>
										<div class="form-row">
										<input type="email" class="form-control" name="email" placeholder ="Email"> 
									</div>
									<div class="form-row">
										<input type="text" name="name" class="form-control" placeholder ="Mobile"> 
									</div>
									<button class="btn btn-block btn-success btn-md"> Connect with Advertiser</button>
								</div>	
							</div>
						</div>
					</div>
				</div>	
		</div> 
	</div>
</section>

