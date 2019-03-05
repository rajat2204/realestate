<section class="bg project-section">
	<div class="container">
		<div class="peojectnameList">
			<ul class="list-project">
				<li>
					<a href="javascript:void(0);">Home</a>
				</li>
				<li>
					<a href="javascript:void(0);">New Projects in Lucknow</a>
				</li>
			</ul>
		</div>
		<div class="projects_list">
			<div class="projectLocation clearfix">
				<div class="project-heading float-left">
					<h2>Projects</h2>
				</div>
				<div class="project-right float-right">
					<button class="btn btn-sm btn-default text-dark ">
	  					Sort By
		  				<select class = " hovs">
							<option>Relevence</option>
							<option>Price -high to low</option>
							<option>Price -high to low</option>
							<option>Price -high to low</option>
						</select>
					</button>
				</div>
			</div>
			@foreach($project as $projects)
				<div class="projectsWrapper">
						<div class="row">
							<div class="col-md-4 pd-right-none">
								<div class="imgProject">
									<img src="{{url('assets/img/projects')}}/{{$projects['image']}}" alt="project">
								</div>
							</div>
							<div class="col-md-8">
								<div class="clearfix">
									<div class="project-description float-left">
										<h3>{{$projects['name']}}</h3>
										<p>{{$projects['location']}}</p>
										<p>By Intra developers</p>
									</div>
									<div class="project-pric float-right">
										<h3><i class="fa fa-rupee"></i>40 Lacs - 50 Lacs</h3>
									</div>
								</div>
								<div class="project-content">
									<p>{!!strip_tags($projects['description'])!!}</p>
								</div>
								<ul class="projectContent">
									<li>1 BHK Flat</li>
									<li>1200 - 13850 sqft</li>
									<li><i class="fa fa-rupee"></i>56Lac - 73Lac</li>
									<li><a href="javascript:void(0);" class="btn-blue contactNow">Contact Now</a></li>
								</ul>
								<ul class="projectContent">
									<li>2 BHK Flat</li>
									<li>1350 - 1380 sqft</li>
									<li><i class="fa fa-rupee"></i>56Lac - 73Lac</li>
									<li><a href="javascript:void(0);" class="btn-blue contactNow">Contact Now</a></li>
								</ul>
							</div>
						</div>
				</div>
			@endforeach
		</div>
		<div>
			
		</div>
	</div>
</section>