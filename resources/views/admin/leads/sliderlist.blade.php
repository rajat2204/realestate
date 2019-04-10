<div class="content-wrapper">
	<!-- <ol class="breadcrumb">
		<li><a href="{{url('admin/home')}}">
			<em class="fa fa-home"></em>
		</a></li>
		<li class="active">Agents</li>
	</ol> -->
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Slider Leads</h1>
		</div>
	</div><!--/.row-->
	<div class="page-content">
		
		<div class="row">
			<div class="col-md-12">
				
				<div class="portlet light">
					<!-- <div class="portlet-title">
						<div class="actions">
							<a href="{{url('admin/leads/create')}}" class="btn btn-default btn-circle">
							<i class="fa fa-plus"></i>
							<span class="hidden-480">
							Add Leads</span>
							</a>
						</div>
					</div> -->
					<div class="portlet-body">
						<div class="table-container">
							<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
								{!! $html->table() !!}
							</table>
						</div>
					</div>
				</div>
				<!-- End: life time stats -->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
</div>

@section('requirejs')
{!! $html->scripts()!!}
@endsection