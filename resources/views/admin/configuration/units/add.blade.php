<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Tax</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-units" method="POST" action="{{url('admin/units/create')}}">
      {{csrf_field()}}
        <div class="form-row">
          <div class="form-group">
            <label>Unit Name:</label>
            <input type="text" class="form-control" placeholder="Enter Unit Name..." name="name">
          </div>
        </div>
        <div class="box-footer">
          <a href="{{url('admin/units')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-units"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>