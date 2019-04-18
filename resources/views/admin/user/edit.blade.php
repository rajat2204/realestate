<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit User</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-user" method="POST" action="{{url('admin/users/'.___encrypt($user['id']))}}">
        {{csrf_field()}}

        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($user['id'])?$user['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>User Level:</label>
          <select class="form-control" name="user_level_id" id="user_level_id">
            <option value="">Select User Level</option>
            @foreach($userlevel as $userlevels)
              <option value="{{!empty($userlevels['id'])?$userlevels['id']:''}}" @if($userlevels['id'] == $user['user_level_id']) selected @endif >{{!empty($userlevels['level_name'])?$userlevels['level_name']:''}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>User Name:</label>
          <input type="text" name="username" class="form-control" placeholder="Enter Username..." value="{{!empty($user['username'])?$user['username']:''}}">
        </div>

        <div class="form-group">
          <label>Name:</label>
          <input type="text" name="first_name" class="form-control" placeholder="Enter Name..." value="{{!empty($user['first_name'])?$user['first_name']:''}}">
        </div>

        <div class="form-group">
          <label>E-mail:</label>
          <input type="email" name="email" class="form-control" placeholder="Enter E-mail..." value="{{!empty($user['email'])?$user['email']:''}}">
        </div>

        <div class="form-group">
          <label>Mobile:</label>
          <input type="text" name="phone" class="form-control" placeholder="Enter Mobile Number..." value="{{!empty($user['phone'])?$user['phone']:''}}">
        </div>
        <div class="form-group">
          <label>Menu Permission:</label><br>
          @if(!empty($get_user_menu))
            @foreach($get_user_menu as $menu)
              @if(in_array($menu['id'],json_decode($visible_menu['menu_visibility'])))
                <input type="checkbox" name="menu[]"  value="{{$menu['id']}}" checked="">{{$menu['name']}}<br>
              @else
                <input type="checkbox" name="menu[]"  value="{{$menu['id']}}" >{{$menu['name']}}<br>
              @endif
            @endforeach
          @endif
        </div>
        <div class="box-footer">
          <a href="{{url('admin/users')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-user"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>