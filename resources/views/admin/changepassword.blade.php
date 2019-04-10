<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Change Password</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="change_pwd" method="POST" action="{!! action('Admin\LoginController@adminchangePass',['id' => $admin['id']]) !!}">
        {{csrf_field()}}
        <div class="form-group">
          <label>Current Password:</label>
          <input type="password" class="form-control" placeholder="Enter Current Password..." name="password">
        </div>

        <div class="form-group">
          <label>New Password:</label>
          <input type="password" class="form-control" placeholder="Enter New Password..." name="new_password">
        </div>

        <div class="form-group">
          <label>Re-type new Password:</label>
          <input type="password" class="form-control" placeholder="Re-Enter New Password..." name="confirm_password">
        </div>

        <div class="box-footer">
          <button type="button" data-request="ajax-submit" data-target='[role="change_pwd"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>