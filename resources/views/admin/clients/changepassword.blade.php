<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Change Password</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="changepwd" method="POST" action="{{url('admin/client/'.___encrypt($client['id']).'/changepassword')}}">
      {{csrf_field()}}

        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($client['id'])?$client['id']:''}}">
          </div>
        </div>

            <div class="form-group">
              <label>Old Password:</label>
              <input type="password" class="form-control" placeholder="Enter Old Password..." name="password">
            </div>

            <div class="form-group">
              <label>New Password:</label>
              <input type="password" class="form-control" placeholder="Enter New Password..." name="new_password">
            </div>

            <div class="form-group">
              <label>Re-type New Password:</label>
              <input type="password" class="form-control" placeholder="Re-type New Password..." name="confirm_password">
            </div>

        <div class="box-footer">
          <a href="{{url('admin/client')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="changepwd"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
<script type="text/javascript">

  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#adminimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readid(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#idimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readaddress(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#addressimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection