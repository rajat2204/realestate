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