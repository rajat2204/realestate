<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Units</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-units" method="POST" action="{{url('admin/units/edit/'.___encrypt($units['id']))}}">
        {{csrf_field()}}
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($units['id'])?$units['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>Units Name:</label>
          <input type="text" class="form-control" placeholder="Enter Units Name..." name="name" value="{{!empty($units['name'])?$units['name']:''}}">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/units')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-units"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>