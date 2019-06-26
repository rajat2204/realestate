<!-- header section html starts-->
<div class="wrapperIndex">
<header id="hero-area">
  <div class="header_wrapper clearfix">
    <div class="vertical_slides">
      
      <ul class="slides mCustomScrollbar"  id="vertical_slider"  
          data-mcs-theme="dark">
          
          @php
            $slider = \App\Models\Sliders::where('position','left')->where('status','active')->get();
            $count =  \App\Models\Sliders::where('position','left')->where('status','active')->count();
          @endphp
          @if($count>2)
            <marquee onmouseover="stop();" onmouseout="start();" scrollamount="10" scrolldelay="10" direction="down">  
              @foreach($slider as $sliders)
              <li class="item">
                <a href="{{url('sliders')}}/{{($sliders['slug'])}}"><img src="{{url('assets/img/Sliders')}}/{{$sliders['image']}}" alt="slider"></a>
                <div class="sliderwrap clearfix">
                  <p class="slider_title" title="{{$sliders['title']}}">{{str_limit($sliders['title'],8)}}</p>
                  <p class="contact_number">+91-{{$sliders['mobile']}}</p>
                </div>
              </li>
              @endforeach
            </marquee>
          @else

            @foreach($slider as $sliders)
            <li class="item">
              <a href="{{url('sliders')}}/{{($sliders['slug'])}}"><img src="{{url('assets/img/Sliders')}}/{{$sliders['image']}}" alt="slider"></a>
              <div class="sliderwrap clearfix">
                <p class="slider_title" title="{{$sliders['title']}}">{{str_limit($sliders['title'],8)}}</p>
                <p class="contact_number">+91-{{$sliders['mobile']}}</p>
              </div>
            </li>
            @endforeach
            
          @endif
      </ul>
      
    </div>
    <div class="horizontal_slider">
      <div id="hero_slider" class="owl-carousel">
        @php
          $sliders = \App\Models\Sliders::where('position','center')->where('status','active')->get();
        @endphp
        @foreach($sliders as $sliderscenter)
          <div class="item">
            <img src="{{url('assets/img/Sliders')}}/{{$sliderscenter['image']}}" alt="slider">
            <p title="{{strip_tags(html_entity_decode($sliderscenter['description']))}}">{{strip_tags(html_entity_decode(str_limit($sliderscenter['description'],180)))}}</p>
          </div>
        @endforeach
      </div>
    </div>
    <div class="vertical_slides2">
      <ul class="slides mCustomScrollbar"  id="vertical_slider2" 
          data-mcs-theme="dark">
        @php
          $sliderright = \App\Models\Sliders::where('position','right')->where('status','active')->get();
          $count =  \App\Models\Sliders::where('position','right')->where('status','active')->count();
        @endphp
         @if($count>2)
          <marquee onmouseover="stop();" onmouseout="start();" scrollamount="10" scrolldelay="10" direction="down">
          @foreach($sliderright as $slidersrit)
            <li>
              <a href="{{url('sliders')}}/{{($slidersrit['slug'])}}"><img src="{{url('assets/img/Sliders')}}/{{$slidersrit['image']}}" alt="slider"></a>
              <div class="sliderwrap clearfix">
                <p class="slider_title" title="{{$slidersrit['title']}}">{{str_limit($slidersrit['title'],8)}}</p>
                <p class="contact_number">+91-{{$slidersrit['mobile']}}</p>
              </div>
            </li>
          @endforeach
          </marquee>
           @else

            @foreach($sliderright as $slidersrit)
            <li>
              <a href="{{url('sliders')}}/{{($slidersrit['slug'])}}"><img src="{{url('assets/img/Sliders')}}/{{$slidersrit['image']}}" alt="slider"></a>
              <div class="sliderwrap clearfix">
                <p class="slider_title" title="{{$slidersrit['title']}}">{{str_limit($slidersrit['title'],8)}}</p>
                <p class="contact_number">+91-{{$slidersrit['mobile']}}</p>
              </div>
            </li>
          @endforeach
          @endif
      </ul>
    </div>
  </div>
   <div class="header_wrapper_mobile clearfix">
        <div class="vertical_slides_mobile">
            <ul class="slides"  id="vertical_slider3"  class="mCustomScrollbar owl-carousel" 
                data-mcs-theme="dark">
                @php
                $slider = \App\Models\Sliders::where('position','left')->where('status','active')->get();
                $count =  \App\Models\Sliders::where('position','left')->where('status','active')->count();
                @endphp
                @if($count>2)  
                <marquee onmouseover="stop();" onmouseout="start();" scrollamount="10" scrolldelay="10" direction="down">
                @foreach($slider as $sliders)
                <li>
                  <a href="{{url('sliders')}}/{{($sliders['slug'])}}"><img src="{{url('assets/img/Sliders')}}/{{$sliders['image']}}" alt="slider"></a>
                  <div class="sliderwrap clearfix">
                    <p class="slider_title">{{$sliders['title']}}</p>
                    <p class="contact_number">+91-{{$sliders['mobile']}}</p>
                  </div>
                </li>
                @endforeach
              </marquee>
              @else

              @foreach($slider as $sliders)
              <li>
                  <a href="{{url('sliders')}}/{{($sliders['slug'])}}"><img src="{{url('assets/img/Sliders')}}/{{$sliders['image']}}" alt="slider"></a>
                  <div class="sliderwrap clearfix">
                    <p class="slider_title">{{$sliders['title']}}</p>
                    <p class="contact_number">+91-{{$sliders['mobile']}}</p>
                  </div>
                </li>
              @endforeach
              @endif
            </ul>
        </div>
       
        <div class="vertical_slides_mobile2">
            <ul class="slides"  id="vertical_slider4"  class="mCustomScrollbar" 
                data-mcs-theme="dark">
                @php
                $sliderright = \App\Models\Sliders::where('position','right')->where('status','active')->get();
                $count =  \App\Models\Sliders::where('position','left')->where('status','active')->count();
                @endphp
                @if($count>2) 
                <marquee onmouseover="stop();" onmouseout="start();" scrollamount="10" scrolldelay="10" direction="down">
                @foreach($sliderright as $slidersrit)
                  <li>
                    <a href="{{url('sliders')}}/{{($slidersrit['slug'])}}"><img src="{{url('assets/img/Sliders')}}/{{$slidersrit['image']}}" alt="slider"></a>
                    <div class="sliderwrap clearfix">
                      <p class="slider_title">{{$slidersrit['title']}}</p>
                      <p class="contact_number">+91-{{$slidersrit['mobile']}}</p>
                    </div>
                  </li>
                @endforeach
              </marquee>
              @else

              @foreach($sliderright as $slidersrit)
                <li>
                  <a href="{{url('sliders')}}/{{($slidersrit['slug'])}}"><img src="{{url('assets/img/Sliders')}}/{{$slidersrit['image']}}" alt="slider"></a>
                  <div class="sliderwrap clearfix">
                    <p class="slider_title">{{$slidersrit['title']}}</p>
                    <p class="contact_number">+91-{{$slidersrit['mobile']}}</p>
                  </div>
                </li>
              @endforeach
              @endif
            </ul>
        </div>
    </div>
</header>
<!-- header section html ends-->

<!-- Notice board sections starts-->
<section class="noticeboard_sec">
  <div class="notice_title">
      <p>Notice Board</p>
  </div>
  <div class="noticeboard_slider">
    <div id="notice_slider" class="owl-carousel">
      @php
        $serial_no = 1;
      @endphp
    @foreach($notice as $notices)
      <div class="item noticeBoxes ">
        <span class="badge badge-light numbering">{{$serial_no++}}</span>
        <p class="more_info" title="{{$notices['text']}}">{{$notices['text']}}</p>
      </div>

    @endforeach

    </div>
    <a class="play">p</a>
      <a class="stop">s</a>
  </div>
</section>
<!-- Notice board sections ends-->

<!-- About Section Start -->
<section id="filter-search" class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="advanced-search-form main-form" id="search">
         {{--  <form role='filter' action="{{url('search/property')}}" class="form-horizontal clearfix" enctype="multipart/form-data" method="post" id="search">
            {{csrf_field()}} --}}
            <div class="form-group" >
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <select class="form-control" name="filter_propertystatus" id="filter_propertystatus">
                    <option value="">Property Type</option>
                    <option value="rent">RENT</option> 
                    <option value="sale">SALE</option> 
                  </select>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">            
                  <select class=" form-control" name="filter_propertycategory" id="filter_propertycategory">
                    <option value="">Property Category</option>
                    @foreach($categories as $category)
                      <option value="{{!empty($category['id'])?$category['id']:''}}">{{!empty($category['name'])?$category['name']:''}}</option>
                    @endforeach
                  </select>
                </div>
              <!--static code start-->
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">            
                  <input type="text" class="form-control" name="filter_city" id="filter_city" value="" placeholder="City">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">            
                  <input type="text" class="form-control" name="filter_address" id="filter_address" value="" placeholder="Address">
                </div>
              </div>
            </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">            
                      <input type="text" class="form-control" name="filter_neighborhood" value="" placeholder="Neighborhood" id="filter_neighborhood">
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">            
                      <input type="text" class="form-control" id="filter_zipcode" name="filter_zipcode" value="" placeholder="Zip code">
                    </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                      <!-- <label for="input-filter_bed_rooms">Bedrooms:</label> -->
                      <select class="form-control" name="filter_bed_rooms" id="input-filter_bed_rooms">
                        <option value="">--Select Bedroom--</option>
                          <option value="1">1</option> 

                          <option value="2">2</option> 

                          <option value="3">3</option> 

                          <option value="4">4</option> 

                          <option value="5">5</option> 

                          <option value="6">6</option> 

                          <option value="7">7</option> 

                          <option value="8">8</option> 

                          <option value="9">9</option> 

                          <option value="10">10</option> 
      
                        </select>
                    </div>
                  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <!-- <label for="input-filter_bath_rooms">Bathrooms:</label> -->
                      <select class="form-control" name="filter_bath_rooms" id="input-filter_bath_rooms">
                        <option value="">--Select Bathroom--</option>
                        <option value="1">1</option>            
                        <option value="2">2</option>            
                        <option value="3">3</option>            
                        <option value="4">4</option>            
                        <option value="5">5</option>            
                        <option value="6">6</option>            
                        <option value="7">7</option>            
                        <option value="8">8</option>            
                        <option value="9">9</option>            
                        <option value="10">10</option>            
                      </select>
                  </div>
                    <!--static code end-->  
                    <!-- <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                      <select name="filter_country_id" id="input-country" class="form-control">
                        <option value="*"> --- Please Select --- </option>
                        <option value="244">Aaland Islands</option>
                        <option value="1">Afghanistan</option>
                        <option value="2">Albania</option>
                      </select>
                    </div> -->
                  <!-- <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <select name="filter_zone_id" value="" id="input-zone" class="form-control">
                    <opetion value=""> --- Please Select --- </option>
                    </slect>
                  </div> -->
                </div>
              </div>
                
                <div class="searchwrap">
                  <button {{-- data-request="ajax-submit" data-target='[role="filter"]' --}} id="search-property" class="btn button_search1 text-right" type="button"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
         {{--  </form> --}}
      </div>
    </div> 
  </div>
</section>
<!-- About Section End -->

<!----------- Featured properties starts--------->
<section class="featured-properties-area" id="property">
  <div class="container">
    <div class="row">
      <div class="col-12">
          <div class="section-heading wow fadeInUp">
              <h1>Featured Properties</h1>
              <img src="{{url('assets/img/underline.png')}}" alt="line">
              {{-- <p>Suspendisse dictum enim sit amet libero malesuada feugiat.</p> --}}
          </div>
      </div>
    </div>
    <div class="row">
      @foreach($property as $properties)
      <div class="col-12 col-md-6 col-xl-4">
          <div class="single-featured-property wow fadeInUp" data-wow-delay="100ms">
            <div class="property-thumb">
              <a href="{{url('properties')}}/{{($properties['slug'])}}" target="_blank"><img src="{{url('assets/img/properties')}}/{{$properties['featured_image']}}" alt="feature"></a>
              <div class="tag">
                  <span>For {{$properties['property_purpose']}}</span>
              </div>
              <!-- <div class="list-price">
                  <p><i class="fa fa-rupee-sign"></i>{{$properties['price']}}</p>
              </div> -->
            </div>
            <div class="feature-text">
              <div class="text-center feature-title">
                <h5 title="{{$properties['name']}}">{{str_limit($properties['name'],30)}}</h5>
                <p title="{{$properties['location']}}"><i class="fa fa-map-marker"></i> {{str_limit($properties['location'],40)}}</p>
              </div>
              <div class="room-info-warp">
                <div class="room-info">
                  <div class="rf-left">
                    <p><i class="fa fa-building"></i>@if(!empty($properties['area'])) {{number_format($properties['area'])}} Square foot</p>
                      @else N/A @endif
                    <p><i class="fa fa-bed"></i>@if(!empty($properties['bedrooms'])) {{$properties['bedrooms']}} Bedroom(s)</p>
                    @else N/A @endif
                  </div>
                  <div class="rf-right">
                    <p><i class="fa fa-car"></i>@if(!empty($properties['garage'])) {{$properties['garage']}} Garage(s)</p>@else N/A @endif
                    <p><i class="fa fa-bed"></i>@if(!empty($properties['bathroom'])) {{$properties['bathroom']}} Bathroom(s)</p>@else N/A @endif
                  </div>  
                </div>
                <div class="room-info">
                  <div class="rf-left">
                    <p><i class="fa fa-user"></i>{{$properties['agent']['name']}}</p>
                  </div>
                  <div class="rf-right">
                    <p><i class="fa fa-clock-o"></i>{{ ___ago($properties['updated_at'])}}</p>
                  </div>  
                </div>
              </div>
              @if(!empty($properties['price']))
                @if($properties['property_purpose'] == 'sale')
                  <a class="room-price"><i class="fa fa-rupee-sign"></i>{{number_format($properties['price'])}}</a>
                @else
                  <a class="room-price"><i class="fa fa-rupee-sign"></i>{{number_format($properties['price'])}}/month</a>
                @endif
              @else
                  <a class="room-price"><i class="fa fa-rupee-sign"></i></a>
              @endif
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @if(count($property_featured)>3)
    <div class="text-center m-b-10">
      <a class="btn btn-info" href="{{url('/featuredproperty')}}">Load More</a>
    </div>
    @endif
  </div>
</section>
<!----------- Featured properties Ends--------->

<!-------------- Our services Starts-------------->
<section id="service">
  <div id="services">
    <div class="container">
      <div class="row">
          <div class="col-12">
              <div class="section-heading wow fadeInUp">
                  <h1>Our Services</h1>
                  <img src="{{url('assets/img/underline.png')}}" alt="line">
              </div>
          </div>
      </div>
      <div class="row">
        @foreach($service as $services)
        <div class="col-lg-4 col-md-6">
          <div class="our_services">
              <div class="service-media"> <img src="{{url('assets/img/services')}}/{{$services['image']}}" alt="service"> </div>
              <div class="service-desc">
                <h3>{{$services['title']}}</h3>
                <p title="{{strip_tags($services['description'])}}">{{strip_tags(str_limit($services['description'],85))}}</p>
              </div>
          </div>
        </div>
        @endforeach
      </div>
      @if(count($service_load)>3)
      <div class="text-center m-b-10">
        <a class="btn btn-red" href="{{url('/services')}}">Load More</a>
      </div>
      @endif
    </div>
  </div>
</section>
<!-------------- Our services Starts-------------->

<!-------------- Our Agents Ends-------------->
<section id="agents" class="agent-wrap">
  <div class="container">
    <div class="row">
          <div class="col-12">
              <div class="section-heading wow fadeInUp">
                  <h1>Our Team</h1>
                  <img src="{{url('assets/img/underline.png')}}" alt="line">
                  
              </div>
          </div>
      </div>
      <div>
        <div class="row">
          <div class="col-md-12">
            <div class="owl-carousel" id="our-agent">
              @foreach($agent as $agents)
                <div class="item agentSpace">
                  <div>
                    @if(!empty($agents['image']))
                      <a href="{{url('agentenquiry')}}/{{___encrypt($agents['id'])}}">
                        <img src="{{url('assets/img/agent')}}/{{$agents['image']}}" alt="agent">
                        <div class="team_overlay">
                          <div class="teamname">{{$agents['name']}}</div>
                        </div>
                      </a>
                    @else
                      <img src="{{url('assets/img/dummy_avatar.png')}}" alt="agent">
                    @endif
                  </div>
                  <div class="agentContent">
                    <div class="agent_name">{{$agents['name']}}</div>
                  </div>
                </div>
              @endforeach
              </div>
            </div>
        </div> 
      </div>
  </div>
</section>
<!-------------- Our Agents Ends-------------->

<!-- Portfolio Section Starts-->
<section id="gallery" class="gallery-wrap">
  <div class="container"> 
    <div class="row">
      <div class="col-12">
        <div class="section-heading wow fadeInUp">
            <h1>Our Remarkable Works</h1>
            <img src="{{url('assets/img/underline.png')}}" alt="line">
        </div>
      </div>
    </div>       
    
    <div class="row">
      <div class="col-md-12">
        <div class="controls text-center">
          <button class="filter active btn btn-common filter_type" id="all" data-filter="all">All</button>
          <button class="filter btn btn-common filter_type" id="flat" data-filter="flats">Flats </button>
          <button class="filter btn btn-common filter_type" id="plot" data-filter="plots">Plots</button>
          <button class="filter btn btn-common filter_type" id="house" data-filter="houses">Houses</button>
        </div>
      </div>
      <div class="col-md-12 remarkablework" >
        <div id="portfolio" class="row wow fadeInDown" data-wow-delay="0.4s">
          @foreach($remarkablework as $remarkableworks)
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
              <div class="portfolio-item" style="visibility: visible; animation-delay: 300ms; animation-name: fadeIn;">
                <div class="shot-item">
                  <img src="{{url('assets/img/properties')}}/{{$remarkableworks['featured_image']}}" alt="projects"/>  
                  <div class="overlay">
                    <div class="icons">
                      <a class="lightbox preview" href="{{url('assets/img/properties')}}/{{$remarkableworks['featured_image']}}">
                        <i class="icon-eye"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Portfolio Section Ends -->
  
<!-- testimonial section html -->

{{-- <div id="testimonials">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-heading wow fadeInUp">
          <h1>Testimonials</h1>
          <img src="{{url('assets/img/underline.png')}}" alt="line">
        </div>
      </div>
    </div>
    <div class="row">
      @foreach($testimonial as $testimonials)
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="testimonial testimonial-front">
          <div class="testimonial-image"><img src="{{url('assets/img/testimonials')}}/{{$testimonials['image']}}" alt="testimonial"> </div>
          <div class="testimonial-content">
            <p>"{!! html_entity_decode(strip_tags(!empty($testimonials['description'])?$testimonials['description']:'')) !!}"</p>
            <div class="testimonial-meta">- {{!empty($testimonials['name'])?$testimonials['name']:''}}</div>
          </div>
        </div>
      </div>
        @endforeach
    </div>
    @if(count($testimonial_load)>3)
      <div class="text-center">
        <a class="btn btn-red" href="{{url('/testimonials')}}">Load More</a>
      </div>
    @endif
  </div>
</div> --}}
<section class="review-section set-bg" style="background-image: url(assets/img/review-bg.jpg); background-size: cover;">
      
      <div class="review_head">
        <small>Review</small>
      </div>
        <div class="container">
          <div class="text-left testimonialHead"><h1>Testimonial</h1></div>
          <div class="review-slider owl-carousel owl-loaded owl-drag">
              @foreach($testimonial as $testimonials)
             <div class="review-item text-white">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="clint-pic set-bg"><img src="{{url('assets/img/testimonials')}}/{{$testimonials['image']}}" alt="testimonial"></div>
                    </div>
                    <div class="col-md-9">
                        <h5 style="font-weight:600;font-size:23px;">- {{!empty($testimonials['name'])?$testimonials['name']:''}}</h5>
                        {{-- <span>CEP’s Director</span> --}}
                        <p>"{!! html_entity_decode(strip_tags(!empty($testimonials['description'])?$testimonials['description']:'')) !!}"</p> 
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
            
    </section>
<!-- testimonial section end -->

<!-- Contact Section Start -->
<section id="contact" class="contact-section">
  <div class="contact-form">
    <div class="container">
      <div class="row contact-form-area wow fadeInUp" data-wow-delay="0.4s">
        <div class="col-md-6 col-lg-6 col-sm-12">
          <div class="contact-block">
            <h2>Contact Form</h2>
            <form id="contactForm" role="contactus" action="{{url('contactussubmission')}}" method="POST">
              {{csrf_field()}}
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                  </div>                                 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="E-mail" id="email" class="form-control" name="email">
                  </div> 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="Subject" id="msg_subject" class="form-control" name="subject">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="Number" id="msg_number" class="form-control" name="number">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group"> 
                    <textarea class="form-control" id="message" placeholder="Message" rows="5" name="message"></textarea>
                  </div>
                  <div class="submit-button">
                    <button class="btn btn-common btn-red" id="submit" type="button" data-request="ajax-submit" data-target='[role="contactus"]'>Send Message</button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div> 
                    <div class="clearfix"></div> 
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12">
          <!-- <div class="footer-right-area wow fadeIn">
            <h2>Contact Address</h2>
            <div class="footer-right-contact">
              <div class="single-contact">
                <div class="contact-icon">
                  <i class="fa fa-map-marker"></i>
                </div>

                <p>{{!empty($contact[0]['address'])?$contact[0]['address']:''}}</p>
              </div>
              <div class="single-contact">
                <div class="contact-icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <p><a href="mailto:{{!empty($contact[0]['email'])?$contact[0]['email']:''}}">{{!empty($contact[0]['email'])?$contact[0]['email']:''}}</a></p>
              </div>
              <div class="single-contact">
                <div class="contact-icon">
                  <i class="fa fa-phone"></i>
                </div>
                <p><a href="tel:{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}">+91-{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}</a></p>
              </div>
              <div class="single-contact">
                <div class="contact-icon">
                  <i class="fa fa-whatsapp"></i>
                </div>
                <p><a href="tel:{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}">+91-{{!empty($contact[0]['whatsapp'])?$contact[0]['whatsapp']:''}}</a></p>
              </div>
            </div>
          </div> -->
           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3562.4695622912436!2d80.9487711145173!3d26.761298173035613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfb0c32f4ea69%3A0xed74a8ea3b48faf3!2sSKD+Academy+(CBSE%2C+Vrindavan)!5e0!3m2!1sen!2sin!4v1555930607947!5m2!1sen!2sin" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <!-- <div class="col-md-12">
          
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3562.4695622912436!2d80.9487711145173!3d26.761298173035613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfb0c32f4ea69%3A0xed74a8ea3b48faf3!2sSKD+Academy+(CBSE%2C+Vrindavan)!5e0!3m2!1sen!2sin!4v1555930607947!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div> -->
      </div>
    </div>
  </div>   
</section>
</div>
@section('requirejs')
<script type="text/javascript">
  $(document).ready(function(){
    $(".filter_type").click(function(){
      var $value = $(this).attr("id");
          $.ajax({
              type: 'POST',
              url: "{{url('remarkablework')}}",
              data:{value:$value},
              success: function(data) {
                $(".remarkablework").html(data);
              }
          });
      });
  });

  $("#search-property").click(function(){

    var filter_propertystatus = $("#filter_propertystatus").children("option:selected").val();
    var filter_propertycategory = $("#filter_propertycategory").children("option:selected").val();
    var filter_city = $("#filter_city").val();
    var filter_address = $("#filter_address").val();
    var filter_neighborhood = $("#filter_neighborhood").val();
    var filter_zipcode = $("#filter_zipcode").val();
    var filter_bed_rooms = $("#input-filter_bed_rooms").children("option:selected").val();
    var filter_bath_rooms = $("#input-filter_bath_rooms").children("option:selected").val();
    var $urlstring = "search/property?propertystatus="+filter_propertystatus+"&propertycategory="+filter_propertycategory+"&city="+filter_city+"&address="+filter_address+"&neighborhood="+filter_neighborhood+"&zipcode="+filter_zipcode+"&bed_rooms="+filter_bed_rooms+"&bath_rooms="+filter_bath_rooms;

    
    window.location.href="{{url('/')}}"+"/"+$urlstring;

    
   
  });
</script>
@endsection