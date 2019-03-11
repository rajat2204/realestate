<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add User</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-user" method="POST" action="{!! action('Admin\UserController@store') !!}">
        {{csrf_field()}}

        <div class="form-group">
          <label>User Level:</label>
          <select class="form-control" name="user_type" id="user_type">
            <option value="">Select User Level</option>
            <option value="accountant">Accountant</option>
            <option value="admin">Administrator</option>
            <option value="manager">Manager</option>
          </select>
        </div>

        <div class="form-group">
          <label>User Name:</label>
          <input type="text" name="username" class="form-control" placeholder="Enter Username...">
        </div>

        <div class="form-group">
          <label>Password:</label>
          <input type="password" name="password" class="form-control" placeholder="Enter Password...">
        </div>

        <div class="form-group">
          <label>Name:</label>
          <input type="text" name="first_name" class="form-control" placeholder="Enter Name...">
        </div>

        <div class="form-group">
          <label>E-mail:</label>
          <input type="email" name="email" class="form-control" placeholder="Enter E-mail...">
        </div>

        <div class="form-group">
          <label>Mobile:</label>
          <input type="text" name="phone" class="form-control" placeholder="Enter Mobile Number...">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/users')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-user"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>