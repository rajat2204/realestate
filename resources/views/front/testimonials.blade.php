<div id="testimonials">
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
        <div class="testimonial">
          <div class="testimonial-image"><img src="{{url('assets/img/testimonials')}}/{{$testimonials['image']}}" alt="testimonial"> </div>
          <div class="testimonial-content">
            <p>"{!! html_entity_decode(strip_tags(!empty($testimonials['description'])?$testimonials['description']:'')) !!}"</p>
            <div class="testimonial-meta">- {{!empty($testimonials['name'])?$testimonials['name']:''}}</div>
          </div>
        </div>
      </div>
        @endforeach
    </div>
  </div>
</div>