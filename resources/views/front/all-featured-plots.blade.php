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
          @foreach($plot_featured as $plot_feature)
          <div class="col-12 col-md-6 col-xl-4">
            <a href="{{url('plot')}}/{{___encrypt($plot_feature['id'])}}">
              <div class="single-featured-property wow fadeInUp" data-wow-delay="100ms">
                  <!-- Property Thumbnail -->
                  <div class="property-thumb">
                      <img src="{{url('assets/img/plots')}}/{{$plot_feature['featured_image']}}" alt="feature">

                      <div class="tag">
                          <span>For {{$plot_feature['property_type']}}</span>
                      </div>
                      <div class="list-price">
                          <p><i class="fa fa-rupee-sign"></i>{{$plot_feature['price']}}</p>
                      </div>
                  </div>
                  <!-- Property Content -->
                  <div class="feature-text">
                    <div class="text-center feature-title">
                      <h5>{{$plot_feature['name']}}</h5>
                      <p title="{{$plot_feature['location']}}"><i class="fa fa-map-marker"></i> {{str_limit($plot_feature['location'],40)}}</p>
                    </div>
                    <div class="room-info-warp">
                      <div class="room-info">
                        <div class="rf-left">
                          <p><i class="fa fa-th-large"></i> {{$plot_feature['area']}} Square foot</p>
                          <p><i class="fa fa-bed"></i> {{$plot_feature['bedrooms']}} Bedrooms</p>
                        </div>
                        <div class="rf-right">
                          <p><i class="fa fa-car"></i> {{$plot_feature['garage']}} Garages</p>
                          <p><i class="fa fa-bed"></i> {{$plot_feature['bathroom']}} Bathrooms</p>
                        </div>  
                      </div>
                      <div class="room-info">
                        <div class="rf-left">
                          <p><i class="fa fa-user"></i>{{$plot_feature['agent']['name']}}</p>
                        </div>
                        <div class="rf-right">
                          <p><i class="fa fa-clock-o"></i>{{ ___ago($plot_feature['updated_at'])}}</p>
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
