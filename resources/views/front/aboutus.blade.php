<section id="about" class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-12">
          <div class="section-heading wow fadeInUp">
              <h2>{{$static[0]['title']}}</h2>
              <img src="{{url('assets/img/underline.png')}}" alt="line">
          </div>
      </div>
    </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
      <div class="about-image">
        <img src="{{url('assets/img/staticpage')}}/{{$static[0]['image']}}" class="img-responsive" alt=""> 
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="about-text">
          <p>{!! $static[0]['description'] !!}</p>
        </div>
    </div>
  </div>
</section>