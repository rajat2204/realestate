<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Plan</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-plan" method="POST" action="{!! action('Admin\PlanController@store') !!}">
        {{csrf_field()}}
          <div class="form-group">
            <label>Plan Name:</label>
            <input type="text" class="form-control" placeholder="Enter Plan Name..." name="name">
          </div>

          <div class="form-group">
            <label>Plan Installment:</label>
            <input type="text" class="form-control" placeholder="Enter Plan Installment..." name="installment">
          </div>
          <div class="box-footer">
            <a href="{{url('admin/plans')}}" class="btn btn-default">Cancel</a>
            <button type="button" data-request="ajax-submit" data-target='[role="add-plan"]' class="btn btn-info pull-right">Submit</button>
          </div>
      </form>
    </div>
  </div>
</div>