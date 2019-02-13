<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="{{url('admin/home')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="active">
          <a href="{{url('admin/categories')}}">
            <i class="fa fa-fw fa-sitemap"></i> <span>Main Categories</span>
          </a>
        </li>
        <li class="active">
          <a href="{{url('admin/plot')}}">
            <i class="fa fa-fw fa-file-image-o"></i> <span>Plot</span>
          </a>
        </li>
        <li class="active">
          <a href="{{url('admin/sliders')}}">
            <i class="fa fa-fw fa-sliders"></i> <span>Sliders</span>
          </a>
        </li>
        <li class="active">
          <a href="{{url('admin/social')}}">
            <i class="fa fa-fw fa-linkedin-square"></i> <span>Social Media</span>
          </a>
        </li>
        <li class="active">
          <a href="{{url('admin/testimonial')}}">
            <i class="fa fa-fw fa-quote-right"></i> <span>Testimonials</span>
          </a>
        </li>
        <li class="active">
          <a href="{{url('admin/logout')}}">
            <i class="fa fa-fw fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>