<section id="contact" class="contact-section">
  <div class="contact-form">
    <div class="container">
      <div class="row contact-form-area wow fadeInUp" data-wow-delay="0.4s">
        <div class="col-md-12 col-lg-12 col-sm-12">
          <div class="contact-block">
            <h2>Enquiry Form</h2>
            <form id="enquiry" role="enquiry" action="{{url('enquirysubmission')}}" method="POST">
              {{csrf_field()}}
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Shop Name:</label>
                        <input type="text" class="form-control" id="slider_name" name="slider_name" value="{{$slider['title']}}" readonly="">
                      </div>                                 
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Shop Contact:</label>
                        <input type="number" id="slider_contact" class="form-control" name="slider_contact" value="{{$slider['mobile']}}" readonly="">
                      </div> 
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Customer Name:</label>
                    <input type="text" placeholder="Enter your Name..." id="customer_name" class="form-control" name="customer_name">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Customer Contact:</label> 
                        <input type="number" class="form-control" id="customer_contact" placeholder="Enter your Mobile Number..." name="customer_contact">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Customer E-mail:</label> 
                        <input type="email" class="form-control" id="email" placeholder="Enter your E-mail..." name="email">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Message:</label> 
                    <textarea class="form-control" id="message" rows="5" name="message" placeholder="Enter any Message..."></textarea>
                  </div>
                </div>
                  <div class="col-md-12">
                    <button class="btn btn-common" id="submit" type="button" data-request="ajax-submit" data-target='[role="enquiry"]'>Submit Enquiry</button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div> 
                    <div class="clearfix"></div> 
                  </div>
                </div>
              </div>            
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>   
</section>