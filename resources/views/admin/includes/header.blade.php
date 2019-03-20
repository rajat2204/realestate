<header class="main-header">
  <!-- Logo -->
  <a href="{{url('admin/home')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>D</b>I</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Devdrishti</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- <a href="{{url('admin/logout')}}" style="float:right" class="logout-menu">
      <span>Sign Out</span>
    </a> -->
    <ul class="nav navbar-nav pull-right toolbar">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown"><i class="fa fa-user"></i><span class="hidden-xs administrator">Administrator <i class="fa fa-caret-down"></i></span></a>
            <ul class="dropdown-menu userinfo arrow">
              <li class="username">
                  <a href="#" class="clearfix">
                    <div class="pull-left"><i class="fa fa-user"></i></div>
                    <div class="pull-right"><h5>Administrator!</h5><small>Logged in as <span class="admin-color">admin</span></small></div>
                  </a>
              </li>
              <li class="userlinks">
                <ul class="dropdown-menu">
                  <!-- <li><a href="/soft/realestate/admin/Users/myProfile">My Profile&nbsp;<i class="pull-right fa fa-pencil"></i></a></li> -->
            <li><a href="{{url('admin/changepassword')}}">Change Password&nbsp;<i class="pull-right fa fa-cog"></i></a></li>
            <li class="divider"></li>
            <li><a href="{{url('admin/logout')}}">Sign Out&nbsp;<i class="pull-right fa fa-power-off"></i></a></li>
                </ul>
              </li>
            </ul>
          </li>         
    </ul>
  </nav>
</header>