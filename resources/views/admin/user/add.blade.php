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
          <select class="form-control" name="user_level_id" id="user_level_id">
            <option value="">Select User Level</option>
            @foreach($userlevel as $userlevels)
              <option value="{{!empty($userlevels['id'])?$userlevels['id']:''}}">{{!empty($userlevels['level_name'])?$userlevels['level_name']:''}}</option>
            @endforeach
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
        <div class="form-group">
          <label>Menu Permission:</label><br>
          @if(!empty($get_user_menu))
            @foreach($get_user_menu as $menu)
              <input type="checkbox" name="menu[]"  value="{{$menu['id']}}" >{{$menu['name']}}<br>
            @endforeach
          @endif
        </div>
        
        <div class="box-footer">
          <a href="{{url('admin/users')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-user"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>