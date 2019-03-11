<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Client</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-currency" method="POST" action="{!! action('Admin\ConfigurationController@') !!}">
      {{csrf_field()}}
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Client's Name:</label>
              <input type="text" class="form-control" placeholder="Enter Clients Name..." name="name">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Father/Husband/Wife Name:</label>
              <input type="text" class="form-control" placeholder="Enter Father/Husband/Wife Name..." name="father_name">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Date Of Birth:</label>
              <input type="date" class="form-control" placeholder="Enter Date Of Birth..." name="dob">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Client's Mobile Number:</label>
              <input type="text" class="form-control" placeholder="Enter Clients Mobile Number..." name="phone">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Client's E-mail:</label>
              <input type="text" class="form-control" placeholder="Enter Clients E-mail..." name="email">
            </div>
          </div>


        <div class="box-footer">
          <a href="{{url('admin/client')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-client"]' class="btn btn-info pull-right">Submit</button>
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