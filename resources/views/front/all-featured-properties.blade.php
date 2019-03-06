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
          <a href="{{url('properties')}}/{{($property_feature['slug'])}}">
            <div class="single-featured-property wow fadeInUp" data-wow-delay="100ms">
                <div class="property-thumb">
                    <a href="{{url('properties')}}/{{($property_feature['slug'])}}"><img src="{{url('assets/img/properties')}}/{{$property_feature['featured_image']}}" alt="feature"></a>
                    <div class="tag">
                        <span>For {{$property_feature['property_purpose']}}</span>
                    </div>
                    <!-- <div class="list-price"> -->
                        <!-- <p><i class="fa fa-rupee-sign"></i>{{$property_feature['price']}}</p> -->
                    <!-- </div> -->
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
                        <p><i class="fa fa-building"></i>@if(!empty($property_feature['area'])) {{number_format($property_feature['area'])}} Square foot</p>
                      @else N/A @endif
                        <p><i class="fa fa-bed"></i> @if(!empty($property_feature['bedrooms'])) {{$property_feature['bedrooms']}} Bedroom(s)</p>
                    @else N/A @endif
                      </div>
                      <div class="rf-right">
                        <p><i class="fa fa-car"></i> @if(!empty($property_feature['garage'])) {{$property_feature['garage']}} Garage(s)</p>@else N/A @endif
                        <p><i class="fa fa-bed"></i> @if(!empty($property_feature['bathroom'])) {{$property_feature['bathroom']}} Bathroom(s)</p>@else N/A @endif
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
                  @if(!empty($property_feature['price']))
                    @if($property_feature['property_purpose'] == 'sale')
                      <a class="room-price"><i class="fa fa-rupee-sign"></i>{{number_format($property_feature['price'])}}</a>
                    @else
                      <a class="room-price"><i class="fa fa-rupee-sign"></i>{{number_format($property_feature['price'])}}/month</a>
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
  </div>
</section>
