<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Social Media</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-social" method="POST" action="{{url('admin/social/'.___encrypt($social['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($social['id'])?$social['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>URL:</label>
          <input type="text" class="form-control" placeholder="Enter Social Media URL..." name="url" value="{{!empty($social['url'])?$social['url']:''}}">
          <p>Please use <strong>'http'</strong> with the url.</p>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/social')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-social"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
@endsection