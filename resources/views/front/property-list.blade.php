<section class ="bg property-section" id="property-section">  
  <div class="container">
    <nav >
     <div class="nav nav-tabs" id="nav-tab" role="tablist">
       <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
       <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a> -->
     </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="head_g clearfix">
          @if($count == 1)
            <p>{{$count}} Property</p>
          @else
            <p>{{$count}} Properties</p>
          @endif
        </div>
      @if(!empty($property))
        @foreach($property as  $value) 
          <div class="container ml-0 mr-0 pr-0 pl-0">
           <div id="wraperr">
              <div class ="row">
                <div class="col-lg-2">
                  <div class="boxd">
                    <a href="#viewphotos-{{$value['id']}}" data-toggle="modal">
                      <img src= "{{url('assets/img/properties')}}/{{$value['featured_image']}} " alt="">
                      <span class="bulge">{{count($value['property_gallery'])}} photo(s)</span>
                      <p class="utopia">Posted:{{ ___ago($value['updated_at'])}} </p> 
                    </a>
                  </div>
                </div>
                <div class="col-lg-2 trims">  
                  <div class = "tex_t text-light "> 
                    <i class="fa fa-rupee text-blue"></i>
                      @if(!empty($value['price']))
                        @if($value['property_purpose'] == 'sale')
                          <span>{{number_format($value['price'])}}</span>
                        @else
                          <span>{{number_format($value['price'])}}/month</span>
                        @endif
                      @else
                        <span>N/A</span>
                      @endif
                  </div>
                </div>
    
          <div class="col-lg-8 ">  
            <div class="rowpadding">
              <h6 class="mt-2"><b>{{ucfirst($value['property_type'])}}</b> For <strong>{{ucfirst($value['property_purpose'])}}</strong> in {{$value['location']}}.
              </h6>
              <!-- <span><i class="fa fa-map-marker text "></i>What's near By:</span></h6> -->
            </div>   
            <div class="row">  
              <div class="col-lg-3 sims">
              <span class="text-secondary">Carpet area</span>
              <span class="text-dark">@if(!empty($value['area'])){{$value['area']. ' '}}sqft.@else N/A @endif</span>
              </div>
              <div class="col-lg-3 sims">
              <span class="text-secondary">Status</span>
              <span class="text-dark">@if(!empty($value['possession']))Possession By {{' ' .$value['possession']}}@else N/A @endif</span>
              </div>  
              <div class="col-lg-3 sims">
                <span class="text-secondary">Property Name</span>
                <span class="text-dark">{{$value['name']}}</span>
              </div>
              <div class="col-lg-3 sims">
                <span class="text-secondary">Agent Name</span>
                <span class="text-dark">{{$value['agent']['name']}}</span>
              </div>      
            </div>
            <div class="rowpadding">
              <div class="property-desc">
                <p title="{{strip_tags($value['description'])}}">{{str_limit(strip_tags($value['description']),120)}} </p>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3 sim">
                <button class="btn btn-blue" data-toggle="modal" data-target="#contactModal-{{$value['id']}}">Contact Agent</button>
              </div>
              <div class="col-lg-3 sim disabl">
                <small class=""> Company/Owner Name</small>
                <small>{{$value['company']['name']}}</small>
              </div>    
            </div>  
         
          </div>
        </div>
      
    <div class="modal contact-modal fade" id="contactModal-{{$value['id']}}" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <img src="{{url('assets/img/logo.png')}}" alt="Devdrishti Infrahomes">
             
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-header-btm">
            <span class="modal-title property-name-modal">{{$value['company']['name']}}</span>
            <div>
            <span>Agent: {{$value['agent']['phone']}}</span>
            </div>
          </div>

          <div class="modal-body popupmodal-body">
            <form role="agent-contact" action="{{url('agentcontact')}}" method="POST">
              {{csrf_field()}}
              <div class="form-group">
                <input type="hidden" id="agent_contact" name="agent_contact" class="form-control" value="{{!empty($value['agent']['mobile'])?$value['agent']['mobile']:''}}">
                <div class="row">
                  <div class="col-md-12">
                    <label for="usr">Agent Name:</label>
                    <input name="agent_name" class="form-control m-contact__input" type="text" value="{{!empty($value['agent']['name'])?$value['agent']['name']:''}}" readonly>
                  </div>
                </div>
              </div>
              <div class="form-group m-contact__fieldset">
                <input name="customer_name" class="form-control m-contact__input" type="text">
                <label for="usr" class="contact_label m-contact__label">Name:</label>
              </div>
              <div class="form-group m-contact__fieldset">
                <input name="email" class="form-control m-contact__input" type="email">
                <label for="usr" class="contact_label m-contact__label">Email:</label>
              </div>
              <div class="form-group m-contact__fieldset">
                <input name="customer_contact" class="form-control m-contact__input" type="text">
                <label for="usr" class="contact_label m-contact__label">Mobile Number:</label>
              </div>
              <div class="form-group m-contact__fieldset">
                <select for="usr" class="m-contact__select" name="interested">
                  <option value="">Interest in(optional)</option>
                  <option value="sitevisit">Site Visit</option>
                  <option value="immediatepurchase">Immediate Purchase</option>
                  <option value="homeloan">Home Loan</option>
                </select> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-request="ajax-submit" data-target='[role="agent-contact"]'>Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal modalphotos fade" id="viewphotos-{{$value['id']}}" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div class="propertyName">{{$value['name']}}</div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <div class="modal-body popupmodal-body swiperpopupBox">
            <div class="outer">
              <div id="big" class="owl-carousel bigdata-{{$value['id']}}">
                @foreach($value['property_gallery'] as $property_galleries)
                  <div class="item">
                    
                    <span><img src="{{url('assets/img/PropertyGallery')}}/{{$property_galleries['images']}}" alt="gallery"></span>
                   
                  </div>
                @endforeach
              </div>

              <div id="thumbs-{{$value['id']}}" class="owl-carousel thumbss">
                @foreach($value['property_gallery'] as $property_galleries)
                  <div class="item">
                    <span><img src="{{url('assets/img/PropertyGallery')}}/{{$property_galleries['images']}}" alt="gallery"></span>
                  </div>
                @endforeach
              </div>

            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@section('requirejs')
<script type="text/javascript">
   $(document).ready(function() {
    var number={{$value['id']}};
        var bigimage = $('.bigdata-'+ number);
        var thumbs = $('#thumbs-'+ number);
        alert(thumbs);
        //var totalslides = 10;

        var syncedSecondary = true;

        bigimage
          .owlCarousel({
          items: 1,
          slideSpeed: 2000,
          nav: true,
          autoplay: true,
          dots: false,
          loop: true,
          responsiveRefreshRate: 200,
          navText: [
            '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
          ]
        })
          .on("changed.owl.carousel", syncPosition);

        thumbs
          .on("initialized.owl.carousel", function() {
          thumbs
            .find(".owl-item")
            .eq(0)
            .addClass("current");
        })
          .owlCarousel({
          items: 4,
          dots: true,
          nav: true,
          
          smartSpeed: 200,
          slideSpeed: 500,
          slideBy: 4,
          responsiveRefreshRate: 100
        })
          .on("changed.owl.carousel", syncPosition2);

        function syncPosition(el) {
          //if loop is set to false, then you have to uncomment the next line
          //var current = el.item.index;

          //to disable loop, comment this block
          var count = el.item.count - 1;
          var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

          if (current < 0) {
            current = count;
          }
          if (current > count) {
            current = 0;
          }
          //to this
          thumbs
            .find(".owl-item.active")
            .removeClass("current")
            .eq(current)
            .addClass("current");
          var onscreen = thumbs.find(".owl-item.active").length - 1;
          var start = thumbs
          .find(".owl-item.active")
          .first()
          .index();
          var end = thumbs
          .find(".owl-item.active")
          .last()
          .index();

          if (current > end) {
            thumbs.data("owl.carousel").to(current, 100, true);
          }
          if (current < start) {
            thumbs.data("owl.carousel").to(current - onscreen, 100, true);
          }
        }

        function syncPosition2(el) {
          if (syncedSecondary) {
            var number = el.item.index;
            bigimage.data("owl.carousel").to(number, 100, true);
          }
        }
        thumbs.on("click", ".owl-item", function(e) {
          e.preventDefault();
          var number = $(this).index();
          bigimage.data("owl.carousel").to(number, 300, true);
        });
      });
</script>
@endsection
@endforeach
@endif
</div>
</div>
</div>
</section>


