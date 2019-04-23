<section id="contact" class="contact-section">
  <div class="contact-form">
    <div class="container">
      <div class="row contact-form-area wow fadeInUp" data-wow-delay="0.4s">
        <div class="col-md-6 col-lg-6 col-sm-12">
          <div class="contact-block">
            <h2>Contact Form</h2>
            <form id="contactForm" role="contactus" action="{{url('contactussubmission')}}" method="POST">
              {{csrf_field()}}
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                  </div>                                 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="E-mail" id="email" class="form-control" name="email">
                  </div> 
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="Subject" id="msg_subject" class="form-control" name="subject">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" placeholder="Number" id="number" class="form-control" name="number">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group"> 
                    <textarea class="form-control" id="message" placeholder="Message" rows="5" name="message"></textarea>
                  </div>
                  <div class="submit-button">
                    <button class="btn btn-common" id="submit" type="button" data-request="ajax-submit" data-target='[role="contactus"]'>Send Message</button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div> 
                    <div class="clearfix"></div> 
                  </div>
                </div>
              </div>            
            </form>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12">
          <div class="footer-right-area wow fadeIn">
            <h2>Contact Address</h2>
            <div class="footer-right-contact">
              <div class="single-contact">
                <div class="contact-icon">
                  <i class="fa fa-map-marker"></i>
                </div>

                <p>{{!empty($contact[0]['address'])?$contact[0]['address']:''}}</p>
              </div>
              <div class="single-contact">
                <div class="contact-icon">
                  <i class="fa fa-envelope"></i>
                </div>
                <p><a href="mailto:{{!empty($contact[0]['email'])?$contact[0]['email']:''}}">{{!empty($contact[0]['email'])?$contact[0]['email']:''}}</a></p>
              </div>
              <div class="single-contact">
                <div class="contact-icon">
                  <i class="fa fa-phone"></i>
                </div>
                <p><a href="tel:{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}">{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3562.4695622912436!2d80.9487711145173!3d26.761298173035613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfb0c32f4ea69%3A0xed74a8ea3b48faf3!2sSKD+Academy+(CBSE%2C+Vrindavan)!5e0!3m2!1sen!2sin!4v1555930607947!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>   
</section>