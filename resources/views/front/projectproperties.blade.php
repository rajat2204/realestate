<section class="featured-properties-section" id="property">
  <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="section-heading wow fadeInUp">
                <h2>Project Properties</h2>
                <img src="{{url('assets/img/underline.png')}}" alt="line">
                <p>Suspendisse dictum enim sit amet libero malesuada feugiat.</p>
            </div>
        </div>
    </div>

    <div class="row">
      @foreach($projectproperty as $projectproperties)
        <div class="col-12 col-md-6 col-xl-4">
          <a href="{{url('properties')}}/{{($projectproperties['slug'])}}">
            <div class="single-featured-property wow fadeInUp" data-wow-delay="100ms">
                <div class="property-thumb">
                    <a href="{{url('properties')}}/{{($projectproperties['slug'])}}"><img src="{{url('assets/img/properties')}}/{{$projectproperties['featured_image']}}" alt="feature"></a>
                    <div class="tag">
                        <span>For {{$projectproperties['property_purpose']}}</span>
                    </div>
                    <!-- <div class="list-price">
                        <p><i class="fa fa-rupee-sign"></i>{{$projectproperties['price']}}</p>
                    </div> -->
                </div>
                <!-- Property Content -->
                <div class="feature-text">
                  <div class="text-center feature-title">
                    <h5>{{$projectproperties['name']}}</h5>
                    <p title="{{$projectproperties['location']}}"><i class="fa fa-map-marker"></i> {{str_limit($projectproperties['location'],40)}}</p>
                  </div>
                  <div class="room-info-warp">
                    <div class="room-info">
                      <div class="rf-left">
                        <p><i class="fa fa-th-large"></i> @if(!empty($projectproperties['area'])) {{number_format($projectproperties['area'])}} Square foot</p>
                      @else N/A @endif
                        <p><i class="fa fa-bed"></i> @if(!empty($projectproperties['bedrooms'])) {{$projectproperties['bedrooms']}} Bedroom(s)</p>
                    @else N/A @endif
                      </div>
                      <div class="rf-right">
                        <p><i class="fa fa-car"></i> @if(!empty($projectproperties['garage'])) {{$projectproperties['garage']}} Garage(s)</p>@else N/A @endif
                        <p><i class="fa fa-bed"></i> @if(!empty($projectproperties['bathroom'])) {{$projectproperties['bathroom']}} Bathroom(s)</p>@else N/A @endif
                      </div>  
                    </div>
                    <div class="room-info">
                      <div class="rf-left">
                        <p><i class="fa fa-user"></i>{{$projectproperties['agent']['name']}}</p>
                      </div>
                      <div class="rf-right">
                        <p><i class="fa fa-clock-o"></i>{{ ___ago($projectproperties['updated_at'])}}</p>
                      </div>  
                    </div>
                  </div>
                  @if(!empty($projectproperties['price']))
                    @if($projectproperties['property_purpose'] == 'sale')
                      <a class="room-price"><i class="fa fa-rupee-sign"></i>{{number_format($projectproperties['price'])}}</a>
                    @else
                      <a class="room-price"><i class="fa fa-rupee-sign"></i>{{number_format($projectproperties['price'])}}/month</a>
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
