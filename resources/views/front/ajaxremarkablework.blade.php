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
