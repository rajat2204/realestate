<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add User Level</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-userlevel" method="POST" action="{!! action('Admin\UserController@userLevel') !!}">
        {{csrf_field()}}

        <div class="form-group">
          <label>User Level Name:</label>
          <input type="text" name="level_name" class="form-control" placeholder="Enter User Level Name...">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/userlevel')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-userlevel"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>