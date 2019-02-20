<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Notice</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-notice" method="POST" action="{{url('admin/notice/'.___encrypt($notice['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($notice['id'])?$notice['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>Notice Text:</label>
          <input type="text" class="form-control" placeholder="Enter Notice Text..." name="text" value="{{!empty($notice['text'])?$notice['text']:''}}">
        </div>

        <div class="form-group">
          <label>Notice Slug:</label>
          <input type="text" class="form-control" placeholder="Enter Notice Slug..." name="slug" value="{{!empty($notice['slug'])?$notice['slug']:''}}">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/notice')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-notice"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>