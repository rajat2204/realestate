<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Client</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-client" method="POST" action="{!! action('Admin\ClientController@store') !!}">
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

          <div class="col-md-4">
            <div class="form-group">
              <label>Client's Password:</label>
              <input type="text" class="form-control" placeholder="Enter Client's Password..." name="password">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Client's Address:</label>
              <input type="text" class="form-control" placeholder="Enter Clients Address..." name="address">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Client's Occupation</label><small>(with detail):</small>
              <input type="text" class="form-control" placeholder="Enter Clients Occupation..." name="address">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>District:</label>
              <input type="text" class="form-control" placeholder="Enter District..." name="district">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>State:</label>
              <input type="text" class="form-control" placeholder="Enter State..." name="state">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Nationality:</label>
              <input type="text" class="form-control" placeholder="Enter Nationality..." name="nationality">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Pin Code:</label>
              <input type="text" class="form-control" placeholder="Enter Pincode..." name="pincode">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>PAN Number:</label>
              <input type="text" class="form-control" placeholder="Enter PAN Number..." name="pan">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="image">Client's Image:</label>
              <div>
                <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="photo" type="file">
              </div>
              <div>
                <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="adminimg" alt="No Featured Image Added">
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="image">Client's Identity Proof:</label>
              <div>
                <input onchange="readid(this)" id="uploadid" accept="image/*" name="id_proof" type="file">
              </div>
              <div>
                <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="idimg" alt="No Featured Image Added">
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="image">Client's Address Proof:</label>
              <div>
                <input onchange="readaddress(this)" id="uploadaddress" accept="image/*" name="address_proof" type="file">
              </div>
              <div>
                <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="addressimg" alt="No Featured Image Added">
              </div>
            </div>
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