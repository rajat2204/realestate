<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Tax</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-tax" method="POST" action="{{url('admin/tax/edit/'.___encrypt($tax['id']))}}">
        {{csrf_field()}}
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($tax['id'])?$tax['id']:''}}">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Tax Name:</label>
            <input type="text" class="form-control" placeholder="Enter Tax Name..." name="name" value="{{!empty($tax['name'])?$tax['name']:''}}">
          </div>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/tax')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-tax"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>