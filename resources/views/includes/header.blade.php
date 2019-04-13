@php 
  if(\Auth::user() && \Auth::user()->user_type=='super-admin'){
  \Auth::logout();
}
@endphp
<header id="header-wrap">
        <div class="header_strip">
          <div class="phone_header">
              <i class="fa fa-phone"></i>
              <a href="tel:{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}">+91-{{!empty($contact[0]['phone'])?$contact[0]['phone']:''}}</a>
          </div>
          <ul class="shubhX">
            <li><a href="{{url('/agentdashboard')}}">Dashboard</a></li>
            @if(Auth::user())
              <p>Hello,{{ Auth::user()->first_name}}&nbsp;&nbsp;</p>
              <span><a href="{{url('/logout')}}" class="text-warning"><i class="fa fa-sign-out"></i><span>Logout</span></a></span>
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
                      <li class="nav-item @if(Request::segment(1)=='projects') active @endif">
                        <a class="nav-link" href="{{url('/projects')}}">
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
                        <a class="nav-link" href="#search">
                          <i class="fa fa-search"></i>
                        </a>
                      </li>
                    </ul>
                </div>
              </div>

            <!-- Mobile Menu Start -->
            <ul class="onepage-nev mobile-menu">
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
                <a class="nav-link" href="{{url('/projects')}}">
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
                <a class="nav-link" href="#search">
                  <i class="fa fa-search"></i>
                </a>
              </li>
            </ul>
            <!-- Mobile Menu End -->
        </nav>
        <!-- Navbar End -->
      </header>

<div class="modal modalWrapper fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-header-btm">
        <h3 class="modal-title">Signup</h3>
      </div>
      <div class="modal-body popupmodal-body">
        <form role="signup" action="{{url('signup')}}" method="POST">
          {{csrf_field()}}
          <ul class="signlist">
            <li class="sign-list">
                <input name="signup"  class="" type="radio" value="customer">customer
            </li>
            <li class="sign-list">
                <input name="signup"  class="" type="radio" value="agent">Agent
            </li>
          </ul>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="usr">First Name:</label>
                <input name="first_name" placeholder="Enter your name..." class="form-control" type="text">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="usr">Last Name:</label>
                <input name="last_name" placeholder="Enter your name..." class="form-control" type="text">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="usr">Email:</label>
            <input name="email" placeholder="Enter your E-mail..." class="form-control" type="email">
          </div>
          <div class="form-group">
            <label for="usr">Mobile Number:</label>
            <input name="phone" placeholder="Enter your mobile number" class="form-control" type="text">
          </div>
          <div class="form-group">
            <label for="usr">Password:</label>
            <input name="password" placeholder="Enter your password" class="form-control" type="password">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-request="ajax-submit" data-target='[role="signup"]'>Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sign In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('login')}}" role="login">
        {{csrf_field()}}
        <div class="container far27" >
          <ul class="signlist">
            <li class="sign-list">
                <input name="login"  class="" type="radio" value="customer">
                customer
            </li>
            <li class="sign-list">
                <input name="login"  class="" type="radio" value="agent">
                Agent
            </li>
          </ul>
          <div class="form-row ">
            <div class="form-group col-md-12">
              <label >Username:</label>
              <input type ="text" placeholder ="Enter your Number"  class="form-control" name ="phone">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12 ">
              <label> Password:</label>
              <input type ="password" placeholder ="Enter Password "  class="form-control" name ="password">
            </div>
          </div>
         </div>
        </div>  
        <div class="modal-footer">
          <button type="button" class="btn btn-success btn-sm " data-request="ajax-submit" data-target='[role="login"]'>Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
