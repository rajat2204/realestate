<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Vendor/Staff</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-vendor" method="POST" action="{!! action('Admin\VendorController@store') !!}">
        {{csrf_field()}}
        <div class="form-group">
          <label>Vendor Name:</label>
          <input type="text" class="form-control" placeholder="Enter Vendor Name..." name="name">
        </div>

        <div class="form-group">
          <label>Vendor Address:</label>
          <input type="text" class="form-control" placeholder="Enter Vendor Address..." name="address">
        </div>

        <div class="form-group">
          <label>Vendor Contact:</label>
          <input type="text" class="form-control" placeholder="Enter Vendor Contact..." name="contact">
        </div>

        <div class="form-group">
          <label>Vendor Licence Number:</label>
          <input type="text" class="form-control" placeholder="Enter Vendor Licence Number..." name="licence_no">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/vendors')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-vendor"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>