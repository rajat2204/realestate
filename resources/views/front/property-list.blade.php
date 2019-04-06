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
  <!-- <button class="btn btn-sm btn-default text-dark ">
  Sort By
  <select class = "hovs">
<option> Relevence  </option>
<option> Price -high to low  </option>
<option> Price -high to low  </option>
<option> Price -high to low  </option>
</select>
</button> -->
</div>
@if(!empty($property))
@foreach($property as  $value) 
<div class="container ml-0 mr-0 pr-0 pl-0">
 <div id="wraperr">
    <div class ="row ">
    <div class="col-md-2 ">
  <div class="boxd">
    <a href="#viewphotos" data-toggle="modal">
      <img src= "{{url('assets/img/properties')}}/{{$value['featured_image']}} " alt="">
      <span class="bulge">{{count($value['property_gallery'])}} photo(s)</span>
      <p class="utopia">Posted:{{ ___ago($value['updated_at'])}} </p> 
    </a>
    
  </div>
  </div>
<div class="col-md-2 trims">  
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
  
 <div class="col-md-8 ">  
<div class="row ">
<h6 class="mt-2"><b>{{ucfirst($value['property_type'])}}</b> For <strong>{{ucfirst($value['property_purpose'])}}</strong> in {{$value['location']}}.
  <span><i class="fa fa-map-marker text "></i>What's near By:</span></h6>
</div>   
  <div class="row ">  
  <div class="col-md-3 sims">
  <span class="text-secondary">Carpet area</span>
  <span class="text-dark">@if(!empty($value['area'])){{$value['area']. ' '}}sqft.@else N/A @endif</span>
  </div>
  <div class="col-md-3 sims">
  <span class="text-secondary">Status</span>
  <span class="text-dark">@if(!empty($value['possession']))Possession By {{' ' .$value['possession']}}@else N/A @endif</span>
  </div>  
<div class="col-md-3 sims">
  <span class="text-secondary">Property Name</span>
  <span class="text-dark">{{$value['name']}}</span>
</div>
  <div class="col-md-3 sims">
  <span class="text-secondary">Agent Name</span>
  <span class="text-dark">{{$value['agent']['name']}}</span>
  </div>      
  </div>
<div class="row">

<div class="property-desc">
  <p title="{{strip_tags($value['description'])}}">{{str_limit(strip_tags($value['description']),80)}} </p>
  </div>

  </div>
  <div class="row">
  <div class="col-md-3 sim">
  <button class="btn btn-blue" data-toggle="modal" data-target="#contactModal">Contact Agent</button>
  </div>

  <!-- <div class="col-md-3 sim ">
  <button class="btn btn-outline-default red" data-toggle="modal" data-target="#vienumberModal">View Phone NO.</button>   
  </div>
  <div class="col-md-3 sim">
  <i class="fa fa-heart bd text-blue mr-1"></i><small class="sharefeedback">Share Feedback</small>
  </div> -->
  <div class="col-md-3 sim disabl">
  <small class=""> Company/Owner Name</small>
  <small >{{$value['company']['name']}}</small>
  </div>    
  </div>  
     </div>
   </div>      
    </div>
</div>
   @endforeach
@endif
</div>
<div class="modal contact-modal fade" id="contactModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <img src="{{url('assets/img/logo.jpg')}}" alt="Devdrishti Infrahomes">
         
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-header-btm">
        <span class="modal-title property-name-modal">{{$value['company']['name']}}</span>
        <div>
        <span>Agent: {{$value['agent']['mobile']}}</span>
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

{{-- modal second --}} 
<div class="modal contact-modal fade" id="vienumberModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <img src="{{url('assets/img/logo.jpg')}}" alt="Devdrishti Infrahomes">
         
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-header-btm">
        <span class="modal-title property-name-modal">Aarohan Infra Developers Pvt. Ltd.</span>
        <div>
        <span>Builder +91-97XXXXXXX11</span>
        </div>
      </div>

      <div class="modal-body popupmodal-body">
        <form role="signup" action="{{url('signup')}}" method="POST">
          {{csrf_field()}}
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <input name="selectoption"  class="" type="radio">
                <label for="usr">Individual:</label>
              </div>
              <div class="col-md-6">
               <input name="selectoption" class="" type="radio">
                <label for="usr">Agent:</label>
              </div>
            </div>
          </div>
          <div class="form-group m-contact__fieldset">
           
            <input name="name" class="form-control m-contact__input" type="text">
            <label for="usr" class="contact_label m-contact__label">Name:</label>
          </div>
          <div class="form-group m-contact__fieldset">
            <input name="email" class="form-control m-contact__input" type="email">
            <label for="usr" class="contact_label m-contact__label">Email:</label>
          </div>
          <div class="form-group m-contact__fieldset">
            <input name="phone" class="form-control m-contact__input" type="text">
            <label for="usr" class="contact_label m-contact__label">Mobile Number:</label>
          </div>
          <div class="form-group m-contact__fieldset">
            <select for="usr" class="m-contact__select">Interest in(optional):
            <option>Visit</option>
            <option>Visit</option>
            <option>Visit</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-request="ajax-submit" data-target='[role="signup"]'>Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- end modal --}}  

  
</div>
</div>
</section>
<div class="modal modalphotos fade" id="viewphotos" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div class="propertyName">Dearmzz Property</div>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <div class="modal-body popupmodal-body swiperpopupBox">
            <div class="outer">
              <div id="big" class="owl-carousel owl-theme">
                <div class="item">
                  <span><img src="{{asset('assets/img/PropertyGallery/TK155444866615538649301550311336slider7.jpg')}}"></span>
                </div>
                <div class="item">
                  <span><img src="{{asset('assets/img/PropertyGallery/ls155444866615529042721551848170project-overview-img.jpg')}}"></span>
                </div>
                <div class="item">
                  <span><img src="{{asset('assets/img/PropertyGallery/uW1554448666155386497215503087661.jpg')}}"></span>
                </div>  
              </div>
              <div id="thumbs" class="owl-carousel owl-theme">
                <div class="item">
                  <span><img src="{{asset('assets/img/PropertyGallery/TK155444866615538649301550311336slider7.jpg')}}"></span>
                </div>
                <div class="item">
                  <span><img src="{{asset('assets/img/PropertyGallery/ls155444866615529042721551848170project-overview-img.jpg')}}"></span>
                </div>
                <div class="item">
                  <span><img src="{{asset('assets/img/PropertyGallery/uW1554448666155386497215503087661.jpg')}}"></span>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>