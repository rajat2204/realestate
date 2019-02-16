<section class="featured-properties-section" id="property">
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
          @foreach($property_featured as $property_feature)
          <div class="col-12 col-md-6 col-xl-4">
            <a href="{{url('property')}}/{{___encrypt($property_feature['id'])}}">
              <div class="single-featured-property wow fadeInUp" data-wow-delay="100ms">
                  <!-- Property Thumbnail -->
                  <div class="property-thumb">
                      <img src="{{url('assets/img/properties')}}/{{$property_feature['featured_image']}}" alt="feature">

                      <div class="tag">
                          <span>For {{$property_feature['property_type']}}</span>
                      </div>
                      <div class="list-price">
                          <p><i class="fa fa-rupee-sign"></i>{{$property_feature['price']}}</p>
                      </div>
                  </div>
                  <!-- Property Content -->
                  <div class="feature-text">
                    <div class="text-center feature-title">
                      <h5>{{$property_feature['name']}}</h5>
                      <p title="{{$property_feature['location']}}"><i class="fa fa-map-marker"></i> {{str_limit($property_feature['location'],40)}}</p>
                    </div>
                    <div class="room-info-warp">
                      <div class="room-info">
                        <div class="rf-left">
                          <p><i class="fa fa-th-large"></i> {{$property_feature['area']}} Square foot</p>
                          <p><i class="fa fa-bed"></i> {{$property_feature['bedrooms']}} Bedrooms</p>
                        </div>
                        <div class="rf-right">
                          <p><i class="fa fa-car"></i> {{$property_feature['garage']}} Garages</p>
                          <p><i class="fa fa-bed"></i> {{$property_feature['bathroom']}} Bathrooms</p>
                        </div>  
                      </div>
                      <div class="room-info">
                        <div class="rf-left">
                          <p><i class="fa fa-user"></i>{{$property_feature['agent']['name']}}</p>
                        </div>
                        <div class="rf-right">
                          <p><i class="fa fa-clock-o"></i>{{ ___ago($property_feature['updated_at'])}}</p>
                        </div>  
                      </div>
                    </div>
                    <a href="javascript:void(0);" class="room-price"><i class="fa fa-rupee-sign"></i>1,600/month</a>
                  </div>
              </div>
              </a>
          </div>
          @endforeach
      </div>
  </div>
</section>
