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
        @foreach($service_load as $services)
        <div class="col-lg-4 col-md-6">
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
    </div>
  </div>
</section>