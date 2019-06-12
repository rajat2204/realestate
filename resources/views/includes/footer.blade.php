<!-- Footer Section Start -->
<footer class="footer-area section-padding" id="footer-section">
  <div class="container">
    <div class="wow fadeInDown" data-wow-delay="0.3s">
    <div class="row">
      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12">
        <div class="footer-text">
          <div class="menus_footer">
            <h3>About Real Estate
            </h3>
          </div>
          <div class="footer-about">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <a href="{{url('aboutus')}}" class="showmore">Show More</a>
          </div>
          <ul class="social-icon">
            <li>
              <a class="facebook" href="{{$social[0]['url']}}" target="_blank"><i class="icon-social-facebook"></i></a>
            </li>
            <li>
              <a class="twitter" href="{{$social[1]['url']}}" target="_blank"><i class="icon-social-twitter"></i></a>
            </li>
            <li>
              <a class="instagram" href="{{$social[2]['url']}}" target="_blank"><i class="icon-social-instagram"></i></a>
            </li>
            <li>
              <a class="linkedin" href="{{$social[3]['url']}}" target="_blank"><i class="icon-social-linkedin"></i></a>
            </li>
            <li>
              <a class="google" href="{{$social[4]['url']}}" target="_blank"><i class="icon-social-google"></i></a>
            </li>
            <li>
              <a class="whatsapp" href="https://api.whatsapp.com/send?phone=91{{$contact[0]['whatsapp']}}" target="_blank"><i class="fa fa-whatsapp"></i></a>
            </li>
          </ul>
          
        </div>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12">
        <div class="footer-menu">
          <div class="menus_footer">
            <h3>Other Menus</h3>
          </div>
          <ul class="menus_footer">
            <li><a href="{{url('aboutus')}}"><i class="fa fa-info-circle"></i>About Us</li>
            <li><a href="{{url('privacypolicy')}}"><i class="fa fa-building"></i>Privacy & Policy</a></li>
            <li><a href="{{url('termsandconditions')}}"><i class="fa fa-info"></i></i>Terms & Conditions</a></li>
            <li><a href="{{url('contact')}}"><i class="fa fa-phone"></i>Contact Us</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12">
        <div class="menus_footer">
            <h3>Subscribe Here !!!</h3>
          </div>
          <form role="subscribe" action="{{url('subscribe')}}" method="POST" class="form-inline">
              {{csrf_field()}}
            <div class="subscribe-news">
              <input type="email" name="email" placeholder="Subscribe">
              <div class="subscribe-btn">
                <button type="button" class="btn btn-blue" data-request="ajax-submit" data-target='[role="subscribe"]'><i class="fa fa-bell"></i></button>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
  </div>
</footer>
<!-- </div> -->
<footer class="footer-bottom footer-area">
  <div class="text-center copyright_footer">
     <p>Copyright © <a href="https://www.igniterpro.com/" target="_blank">Igniterpro</a> 2018 All Right Reserved</p>
  </div>
</footer>
<!-- Footer Section End -->

<!-- social icons section -->
<div class="fixed-social-icon">
    <div class="share_with">
       <a class="icon-share" href="javascript:void(0)"></a>
    </div>
    <ul class="social-icon">
        <li>
          <a class="facebook" href="{{$social[0]['url']}}" target="_blank"><i class="icon-social-facebook"></i></a>
        </li>
        <li>
          <a class="twitter" href="{{$social[1]['url']}}" target="_blank"><i class="icon-social-twitter"></i></a>
        </li>
        <li>
          <a class="instagram" href="{{$social[2]['url']}}" target="_blank"><i class="icon-social-instagram"></i></a>
        </li>
        <li>
          <a class="instagram" href="{{$social[3]['url']}}" target="_blank"><i class="icon-social-linkedin"></i></a>
        </li>
        <li>
          <a class="instagram" href="{{$social[4]['url']}}" target="_blank"><i class="icon-social-google"></i></a>
        </li>
        <li>
          <a class="whatsapp" href="https://api.whatsapp.com/send?phone=91{{$contact[0]['whatsapp']}}" target="_blank"><i class="fa fa-whatsapp"></i></a>
        </li>
    </ul>
</div>
<!-- social icons section ends-->

<!-- Go to Top Link -->
<a href="javascript:void(0);" class="back-to-top">
  <i class="icon-arrow-up"></i>
</a>