<header id="header-wrap">
  <div class="header_strip">
      <div class="phone_header">
          <i class="fa fa-phone"></i>
          <a href="tel:{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}">{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}</a>
      </div>
      <ul class="shubhX">
        @if(Auth::user())
          <p>Hello,{{ Auth::user()->first_name }}&nbsp;&nbsp;</p>
          <span>  <a href="javascript:void(0);" class="text-warning">
            <i class="fa fa-sign-out " ></i><span>Logout</span>
          </a></span>
        @else
          <li><button type="button" class="primary-btn" data-toggle="modal" data-target="#myModal">Sign Up</button></li>
          <li><button type="button" class="primary-btn" data-toggle="modal" data-target="#exampleModalCenter">Log In</button></li>
        @endif
      </ul>
  </div>
  
  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar indigo">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="javascript:void(0);main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="icon-menu"></span>
            <span class="icon-menu"></span>
            <span class="icon-menu"></span>
          </button>
          <a href="{{url('/')}}" class="navbar-brand"><img src="{{url('assets/img/logo.jpg')}}" alt="Devdrishti Infrahomes"></a>
        </div> 
         <div class="collapse navbar-collapse" id="main-navbar">
              <ul class="onepage-nev navbar-nav mr-auto w-100 justify-content-end clearfix">
                <li class="nav-item @if(Request::segment(1)=='') active @endif">
                  <a class="nav-link" href="{{url('/')}}">
                    Home
                  </a>
                </li>
                <li class="nav-item @if(Request::segment(1)=='aboutus') active @endif">
                  <a class="nav-link" href="{{url('aboutus')}}">
                    About Us
                    <!-- <i class="fa fa-search"></i> -->
                  </a>
                </li>
                <li class="nav-item @if(Request::segment(1)=='properties') active @endif">
                  <a class="nav-link" href="{{url('/properties')}}">
                    Properties
                  </a>
                </li>
                <li class="nav-item @if(Request::segment(1)=='services') active @endif">
                  <a class="nav-link" href="{{url('/services')}}">
                    Services
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="javascript:void(0);">
                    Projects
                  </a>
                </li>
                <li class="nav-item @if(Request::segment(1)=='testimonials') active @endif">
                  <a class="nav-link" href="{{url('/testimonials')}}">
                    Testimonials
                  </a>
                </li>
                <li class="nav-item @if(Request::segment(1)=='contact') active @endif">
                  <a class="nav-link" href="{{url('/contact')}}">
                    Contact Us
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="javascript:void(0);-search">
                    <i class="fa fa-search"></i>
                  </a>
                </li>
              </ul>
         </div>
      </div>
  </nav>
  <!-- Navbar End -->
</header>