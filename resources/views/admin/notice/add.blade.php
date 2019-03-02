<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Notice</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-notice" method="POST" action="{!! action('Admin\NoticeController@store') !!}">
        {{csrf_field()}}
        <div class="form-group">
          <label>Notice Text:</label>
          <input type="text" class="form-control" placeholder="Enter Notice Text..." name="text">
        </div>

        <div class="form-group">
          <label>Notice Slug:</label>
          <input type="text" class="form-control" placeholder="Enter Notice Slug..." name="slug">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/notice')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-notice"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>