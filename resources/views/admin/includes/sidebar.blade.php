<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('assets/img/logo.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Devdrishti Infrahomes</p>
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu nav_active_menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{url('admin/home')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/categories')}}">
            <i class="fa fa-tasks"></i> <span>Main Categories</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/project')}}">
            <i class="fa fa-folder-open"></i> <span>Projects</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/purchase')}}">
            <i class="fa fa-shopping-cart"></i> <span>Purchase</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/property')}}">
            <i class="fa fa-fw fa-file-image-o"></i> <span>Properties</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/plans')}}">
            <i class="fa fa-briefcase"></i> <span>Plans</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-rocket fa-fw"></i> <span>Leads</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/leads')}}"><i class="fa fa-tasks"></i>Admin Lead</a></li>
            <li><a href="{{url('admin/contactleads')}}"><i class="fa fa-envelope"></i>Enquiry Leads</a></li>
          </ul>
        </li>
        <li>
          <a href="{{url('admin/client')}}">
            <i class="fa fa-users fa-fw"></i><span>Clients</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Expense/Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/expensecategories')}}"><i class="fa fa-tasks"></i>Expense Categories</a></li>
            <li><a href="{{url('admin/vendors')}}"><i class="fa fa-industry"></i>Vendor/Staff</a></li>
            <li><a href="{{url('admin/expenses')}}"><i class="fa fa-money"></i>Expenses</a></li>
            <li><a href="{{url('admin/inventory')}}"><i class="fa fa-shopping-cart"></i>Inventory</a></li>
          </ul>
        </li>
        <li>
          <a href="{{url('admin/agent')}}">
            <i class="fa fa-user-secret"></i><span>Agents</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/company')}}">
            <i class="fa fa-building"></i><span>Company</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/sliders')}}">
            <i class="fa fa-sliders"></i> <span>Sliders</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/notice')}}">
            <i class="fa fa-bell"></i> <span>Notice</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/static_pages')}}">
            <i class="fa fa-sliders"></i> <span>Static Pages</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/social')}}">
            <i class="fa fa-fw fa-linkedin-square"></i> <span>Social Media</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs fa-fw"></i> <span>Configurations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/configuration')}}">General</a></li>
            <li><a href="{{url('admin/currencies')}}">Currency</a></li>
            <li><a href="{{url('admin/tax')}}">Tax</a></li>
            <li><a href="{{url('admin/units')}}">Units</a></li>
            <li><a href="{{url('admin/logo')}}">Organizational Logo</a></li>
          </ul>
        </li>
        <li>
          <a href="{{url('admin/testimonial')}}">
            <i class="fa fa-fw fa-quote-right"></i> <span>Testimonials</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/service')}}">
            <i class="fa fa-bandcamp"></i> <span>Services</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/contact')}}">
            <i class="fa fa-phone"></i> <span>Contact Address</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/changepassword')}}">
            <i class="fa fa-key"></i> <span>Change Password</span>
          </a>
        </li>
        <li>
        <li>
          <a href="{{url('admin/help')}}">
            <i class="fa fa-question-circle"></i><span>Help</span>
          </a>
        </li>
        <li>
          <a href="{{url('admin/logout')}}">
            <i class="fa fa-fw fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>