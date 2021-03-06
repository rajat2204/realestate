<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <!-- <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li> -->
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{\App\Models\PropertyCategories::count()}}</h3>
            <p>Categories</p>
          </div>
          <div class="icon">
            <i class="fa fa-tasks"></i>
          </div>
          <a href="{{url('admin/categories')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ \App\Models\Company::count() }}</h3>
            <p>Company</p>
          </div>
          <div class="icon">
            <i class="fa fa-building"></i>
          </div>
          <a href="{{url('admin/company')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ \App\Models\Project::count() }}</h3>
            <p>Project</p>
          </div>
          <div class="icon">
            <i class="fa fa-folder-open"></i>
          </div>
          <a href="{{url('admin/project')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ \App\Models\Property::count() }}</h3>
            <p>Properties</p>
          </div>
          <div class="icon">
            <i class="fa fa-fw fa-file-image-o"></i>
          </div>
          <a href="{{url('admin/property')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ \App\Models\Purchase::count() }}</h3>
            <p>Purchases</p>
          </div>
          <div class="icon">
            <i class="fa fa-shopping-cart"></i>
          </div>
          <a href="{{url('admin/purchase')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ \App\Models\Plans::count() }}</h3>
            <p>Plans</p>
          </div>
          <div class="icon">
            <i class="fa fa-briefcase"></i>
          </div>
          <a href="{{url('admin/plans')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ \App\Models\Agents::count() }}</h3>
            <p>Agents</p>
          </div>
          <div class="icon">
            <i class="fa fa-user-secret"></i>
          </div>
          <a href="{{url('admin/agent')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ \App\Models\Clients::count() }}</h3>
            <p>Clients</p>
          </div>
          <div class="icon">
            <i class="fa fa-users fa-fw"></i>
          </div>
          <a href="{{url('admin/client')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ \App\Models\Deals::count() }}</h3>
            <p>Deals</p>
          </div>
          <div class="icon">
            <i class="fa fa-thumbs-up fa-fw"></i>
          </div>
          <a href="{{url('admin/deals')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->


      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ \App\Models\Sliders::count() }}</h3>
            <p>Sliders</p>
          </div>
          <div class="icon">
            <i class="fa fa-sliders"></i>
          </div>
          <a href="{{url('admin/sliders')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ \App\Models\Notice::count() }}</h3>
            <p>Notice</p>
          </div>
          <div class="icon">
            <i class="fa fa-bell"></i>
          </div>
          <a href="{{url('admin/notice')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ \App\Models\SocialMedia::count() }}</h3>
            <p>Social Media</p>
          </div>
          <div class="icon">
            <i class="fa fa-fw fa-linkedin-square"></i>
          </div>
          <a href="{{url('admin/social')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ \App\Models\Testimonials::count() }}</h3>
            <p>Testimonials</p>
          </div>
          <div class="icon">
            <i class="fa fa-fw fa-quote-right"></i>
          </div>
          <a href="{{url('admin/testimonial')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ \App\Models\Services::count() }}</h3>
            <p>Services</p>
          </div>
          <div class="icon">
            <i class="fa fa-bandcamp"></i>
          </div>
          <a href="{{url('admin/service')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->