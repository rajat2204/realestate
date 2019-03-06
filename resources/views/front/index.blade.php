<!-- header section html starts-->
<header id="hero-area">
  <div class="header_wrapper clearfix">
    <div class="vertical_slides">
      <ul class="slides"  id="vertical_slider"  class="mCustomScrollbar" 
          data-mcs-theme="dark">
          @php
            $slider = \App\Models\Sliders::where('position','left')->where('status','active')->get();
          @endphp  
          @foreach($slider as $sliders)
          <li>
            <a href="{{url('sliders')}}/{{($sliders['slug'])}}"><img src="{{url('assets/img/Sliders')}}/{{$sliders['image']}}" /></a>
            <div class="sliderwrap clearfix">
              <p class="slider_title">{{$sliders['title']}}</p>
              <p class="contact_number">+91-{{$sliders['mobile']}}</p>
            </div>
          </li>
          @endforeach
      </ul>
    </div>
    <div class="horizontal_slider">
      <div id="hero_slider" class="owl-carousel">
        @php
          $sliders = \App\Models\Sliders::where('position','center')->where('status','active')->get();
        @endphp
        @foreach($sliders as $sliderscenter)
          <div class="item">
            <img src="{{url('assets/img/Sliders')}}/{{$sliderscenter['image']}}" />
            <p>{{strip_tags($sliderscenter['description'])}}</p>
          </div>
        @endforeach
      </div>
    </div>
    <div class="vertical_slides2">
      <ul class="slides"  id="vertical_slider2"  class="mCustomScrollbar" 
          data-mcs-theme="dark">
        @php
          $sliderright = \App\Models\Sliders::where('position','right')->where('status','active')->get();
        @endphp
        @foreach($sliderright as $slidersrit)
          <li>
            <a href="{{url('sliders')}}/{{($slidersrit['slug'])}}"><img src="{{url('assets/img/Sliders')}}/{{$slidersrit['image']}}" /></a>
            <div class="sliderwrap clearfix">
              <p class="slider_title">{{$slidersrit['title']}}</p>
              <p class="contact_number">+91-{{$slidersrit['mobile']}}</p>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  <!-- for mobile -->
           <div class="header_wrapper_mobile clearfix">
              <div class="vertical_slides_mobile">
                  <ul class="slides"  id="vertical_slider"  class="mCustomScrollbar" 
                      data-mcs-theme="dark">
                      <li>
                          <img src="assets/img/gallery/slide1.jpg" />
                          <p>Asian Paints</p>
                      </li>
                      <li>
                          <img src="assets/img/gallery/slide2.jpg" />
                          <p>RR Cables</p>
                      </li>
                      <li>
                          <img src="assets/img/gallery/slide3.jpg" />
                          <p>CP Tiles</p>
                      </li>
                      <li>
                          <img src="assets/img/gallery/slide4.jpg" />
                          <p>Water Purifier</p>
                      </li>
                  </ul>
              </div>
             
              <div class="vertical_slides_mobile2">
                  <ul class="slides"  id="vertical_slider2"  class="mCustomScrollbar" 
                      data-mcs-theme="dark">
                      <li>
                          <img src="assets/img/gallery/slide1.jpg" />
                          <p>Asian Paints</p>
                      </li>
                      <li>
                          <img src="assets/img/gallery/slide2.jpg" />
                          <p>RR Cables</p>
                      </li>
                      <li>
                          <img src="assets/img/gallery/slide3.jpg" />
                          <p>CP Tiles</p>
                      </li>
                      <li>
                          <img src="assets/img/gallery/slide4.jpg" />
                          <p>Water Purifier</p>
                      </li>
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
      <div class="item clearfix">
        <span class="badge badge-light numbering">{{$serial_no++}}</span>
        <p class="float-left">{{$notices['text']}}</p>
      </div>
    @endforeach
    </div>
  </div>
</section>
<!-- Notice board sections ends-->

<!-- About Section Start -->
<section id="filter-search" class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="advanced-search-form main-form">
          <form role='filter' action="{{url('search/property')}}" class="form-horizontal" enctype="multipart/form-data" method="post">
            {{csrf_field()}}
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <select class="form-control" name="filter_propertystatus">
                    <option value="">Property Type</option>
                    <option value="rent">RENT</option> 
                    <option value="sale">SALE</option> 
                  </select>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">            
                  <select class=" form-control" name="filter_propertycategory">
                    <option value="">Property Category</option>
                    @foreach($categories as $category)
                      <option value="{{!empty($category['id'])?$category['id']:''}}">{{!empty($category['name'])?$category['name']:''}}</option>
                    @endforeach
                  </select>
                </div>
              <!--static code start-->
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">            
                  <input type="text" class="form-control" name="filter_city" value="" placeholder="City">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">            
                  <input type="text" class="form-control" name="filter_address" value="" placeholder="Address">
                </div>
              </div>
            </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">            
                      <input type="text" class="form-control" name="filter_neighborhood" value="" placeholder="Neighborhood">
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">            
                      <input type="text" class="form-control" name="filter_zipcode" value="" placeholder="Zip code">
                    </div>
                    <!--static code end-->  
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                      <select name="filter_country_id" id="input-country" class="form-control">
                        <option value="*"> --- Please Select --- </option>
                        <option value="244">Aaland Islands</option>
                        <option value="1">Afghanistan</option>
                        <option value="2">Albania</option>
                      </select>
                    </div>
                  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <select name="filter_zone_id" value="" id="input-zone" class="form-control">
                    <option value=""> --- Please Select --- </option>
                    </select>
                  </div>
                </div>
              </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <label for="input-filter_range">Price:</label>
                    <div class="attribute price-filter">
                    
                      <input type="hidden" name="route" value="property/category">
                      
                        
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
                      <label for="input-area"> Area:(<span class="sub">Sq Ft</span>)</label>
                      <div class="attribute price-filter">
                        <input type="hidden" name="route" value="property/category">

                      </div>
                    </div>
                    <!--static code end-->  
                  
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                      <label for="input-filter_bed_rooms">Bedrooms:</label>
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
                    <label for="input-filter_bath_rooms">Bathrooms:</label>
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
                </div>
              </div>
                <div class="searchwrap">
                  <button {{-- data-request="ajax-submit" data-target='[role="filter"]' --}} class="btn button_search1 text-right" type="submit" ><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
          </form>
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
              <h2>Featured Properties</h2>
              <img src="{{url('assets/img/underline.png')}}" alt="line">
              <p>Suspendisse dictum enim sit amet libero malesuada feugiat.</p>
          </div>
      </div>
    </div>
    <div class="row">
      @foreach($property as $properties)
      <div class="col-12 col-md-6 col-xl-4">
          <div class="single-featured-property wow fadeInUp" data-wow-delay="100ms">
            <div class="property-thumb">
              <a href="{{url('properties')}}/{{($properties['slug'])}}"><img src="{{url('assets/img/properties')}}/{{$properties['featured_image']}}" alt="feature"></a>
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
    @if(count($property_featured)>6)
    <div class="text-center">
      <a class="btn btn-info" href="{{url('/featuredproperty')}}">Load More..</a>
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
                  <h2>Our Services</h2>
                  <img src="{{url('assets/img/underline.png')}}" alt="line">
              </div>
          </div>
      </div>
      <div class="row">
        @foreach($service as $services)
        <div class="col-md-4 col-sm-6">
          <div class="our_services">
              <div class="service-media"> <img src="{{url('assets/img/services')}}/{{$services['image']}}" alt="service"> </div>
              <div class="service-desc">
                <h3>{{$services['title']}}</h3>
                <p>{{strip_tags($services['description'])}}</p>
              </div>
          </div>
        </div>
        @endforeach
      </div>
      @if(count($service_load)>6)
      <div class="text-center">
        <a class="btn btn-info" href="{{url('/services')}}">Load More..</a>
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
                  <h2>Our Agents</h2>
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
                    <img src="{{url('assets/img/agent')}}/{{$agents['image']}}" alt="agent">
                    <div class="overlay"></div>
                  </div>
                  <div class="agentContent">
                    <div class="agent_name">{{$agents['name']}}</div>
                    <div class="agent_name">{{$agents['designation']}}</div>
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
            <h2>Our Remarkable Works</h2>
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
              <div class="portfolio-item">
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

<!-- Background Section Starts -->
<!-- <section class="review-section set-bg" style="background-image: url(assets/img/review-bg.jpg); background-size: cover;">
  <div class="container">
    <div class="review-slider owl-carousel owl-loaded owl-drag">
      <div class="review-item text-white">
        <p>“Leramiz was quick to understand my needs and steer me in the right direction. Their professionalism and warmth made the process of finding a suitable home a lot less stressful than it could have been. Thanks, agent Tony Holland.”</p>
        <h5>Stacy Mc Neeley</h5>
        <span>CEP’s Director</span>
        <div class="clint-pic set-bg" data-setbg="img/review/1.jpg" style="background-image: url(assets/img/testimonials/1.jpg);"></div>
      </div>
      <div class="review-item text-white">
        <p>“Leramiz was quick to understand my needs and steer me in the right direction. Their professionalism and warmth made the process of finding a suitable home a lot less stressful than it could have been. Thanks, agent Tony Holland.”</p>
        <h5>Stacy Mc Neeley</h5>
        <span>CEP’s Director</span>
        <div class="clint-pic set-bg" data-setbg="img/review/1.jpg" style="background-image: url(assets/img/testimonials/1.jpg);"></div>
      </div>
    </div>
  </div>
</section> -->
<!-- Background Section Ends -->
  
<!-- testimonial section html -->
<div id="testimonials">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-heading wow fadeInUp">
          <h2>Testimonials</h2>
          <img src="{{url('assets/img/underline.png')}}" alt="line">
        </div>
      </div>
    </div>
    <div class="row">
      @foreach($testimonial as $testimonials)
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="testimonial">
          <div class="testimonial-image"><img src="{{url('assets/img/testimonials')}}/{{$testimonials['image']}}" alt=""> </div>
          <div class="testimonial-content">
            <p>"{{strip_tags(!empty($testimonials['description'])?$testimonials['description']:'')}}"</p>
            <div class="testimonial-meta">- {{!empty($testimonials['name'])?$testimonials['name']:''}}</div>
          </div>
        </div>
      </div>
        @endforeach
    </div>
  </div>
</div>
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
                 <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" placeholder="Subject" id="msg_subject" class="form-control" name="subject">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group"> 
                    <textarea class="form-control" id="message" placeholder="Message" rows="5" name="message"></textarea>
                  </div>
                  <div class="submit-button">
                    <button class="btn btn-common" id="submit" type="button" data-request="ajax-submit" data-target='[role="contactus"]'>Send Message</button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div> 
                    <div class="clearfix"></div> 
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12">
          <div class="footer-right-area wow fadeIn">
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
                <p><a href="tel:{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}">{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4165.321812020541!2d77.38378970022572!3d28.61164902546254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5aa32ba7abd%3A0x348f1dd49387e0a7!2sMainee+Steel+Works+Private+Limited!5e0!3m2!1sen!2sin!4v1543673481681" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>   
</section>

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
</script>
@endsection