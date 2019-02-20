<section class="featured-properties-section" id="property">
  <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="section-heading wow fadeInUp">
                <h2>All Properties</h2>
                <img src="{{url('assets/img/underline.png')}}" alt="line">
                <p>Suspendisse dictum enim sit amet libero malesuada feugiat.</p>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($property as $properties)
        <div class="col-12 col-md-6 col-xl-4">
          <a href="{{url('properties')}}/{{($properties['slug'])}}">
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
                <!-- Property Content -->
                <div class="feature-text">
                  <div class="text-center feature-title">
                    <h5>{{$properties['name']}}</h5>
                    <p title="{{$properties['location']}}"><i class="fa fa-map-marker"></i> {{str_limit($properties['location'],40)}}</p>
                  </div>
                  <div class="room-info-warp">
                    <div class="room-info">
                      <div class="rf-left">
                        <p><i class="fa fa-th-large"></i> {{$properties['area']}} Square foot</p>
                        <p><i class="fa fa-bed"></i> {{$properties['bedrooms']}} Bedrooms</p>
                      </div>
                      <div class="rf-right">
                        <p><i class="fa fa-car"></i> {{$properties['garage']}} Garages</p>
                        <p><i class="fa fa-bed"></i> {{$properties['bathroom']}} Bathrooms</p>
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
                  @if($properties['property_purpose'] == 'sale')
                    <a class="room-price"><i class="fa fa-rupee-sign"></i>{{number_format($properties['price'])}}</a>
                  @else
                    <a class="room-price"><i class="fa fa-rupee-sign"></i>{{number_format($properties['price'])}}/month</a>
                  @endif
                </div>
            </div>
            </a>
        </div>
        @endforeach
    </div>
  </div>
</section>
