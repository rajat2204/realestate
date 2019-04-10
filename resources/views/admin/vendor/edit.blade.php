<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Vendor/Staff</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-vendor" method="POST" action="{{url('admin/vendors/'.___encrypt($vendor['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($vendor['id'])?$vendor['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>Vendor Name:</label>
          <input type="text" class="form-control" placeholder="Enter Vendor Name..." name="name" value="{{!empty($vendor['name'])?$vendor['name']:''}}">
        </div>

        <div class="form-group">
          <label>Vendor Address:</label>
          <input type="text" class="form-control" placeholder="Enter Vendor Address..." name="address" value="{{!empty($vendor['address'])?$vendor['address']:''}}">
        </div>

        <div class="form-group">
          <label>Vendor Contact:</label>
          <input type="text" class="form-control" placeholder="Enter Vendor Contact..." name="contact" value="{{!empty($vendor['contact'])?$vendor['contact']:''}}">
        </div>

        <div class="form-group">
          <label>Vendor Licence Number:</label>
          <input type="text" class="form-control" placeholder="Enter Vendor Licence Number..." name="licence_no" value="{{!empty($vendor['licence_no'])?$vendor['licence_no']:''}}">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/vendors')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-vendor"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>