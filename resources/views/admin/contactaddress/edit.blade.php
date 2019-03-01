<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Contact Address</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-contact" method="POST" action="{{url('admin/contact/'.___encrypt($contact['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($contact['id'])?$contact['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>Contact Address:</label>
          <input type="text" class="form-control" placeholder="Enter Contact Address..." name="address" value="{{!empty($contact['address'])?$contact['address']:''}}">
        </div>

        <div class="form-group">
          <label>Contact Email:</label>
          <input type="email" class="form-control" placeholder="Enter Contact Email..." name="email" value="{{!empty($contact['email'])?$contact['email']:''}}">
        </div>

        <div class="form-group">
          <label>Contact Number:</label>
          <input type="text" class="form-control" placeholder="Enter Contact Number..." name="phone" value="{{!empty($contact['phone'])?$contact['phone']:''}}">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/contact')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-contact"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>