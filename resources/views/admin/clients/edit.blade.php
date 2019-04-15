<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Client</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-client" method="POST" action="{{url('admin/client/'.___encrypt($clients['id']))}}">
      {{csrf_field()}}

      <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($clients['id'])?$clients['id']:''}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Client's Name:</label>
              <input type="text" class="form-control" placeholder="Enter Clients Name..." name="name" value="{{!empty($clients['name'])?$clients['name']:''}}">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Father/Mother/Husband/Wife Name:</label>
              <input type="text" class="form-control" placeholder="Enter Father/Husband/Wife Name..." name="father_name" value="{{!empty($clients['father_name'])?$clients['father_name']:''}}">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Date Of Birth:</label>
              <input type="date" class="form-control" placeholder="Enter Date Of Birth..." name="dob" value="{{!empty($clients['dob'])?$clients['dob']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Client's Mobile Number:</label>
              <input type="text" class="form-control" placeholder="Enter Clients Mobile Number..." name="phone" value="{{!empty($clients['phone'])?$clients['phone']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Client's E-mail:</label>
              <input type="text" class="form-control" placeholder="Enter Clients E-mail..." name="email" value="{{!empty($clients['email'])?$clients['email']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Client's Address:</label>
              <input type="text" class="form-control" placeholder="Enter Clients Address..." name="address" value="{{!empty($clients['address'])?$clients['address']:''}}" id="autocomplete">
              <input type="hidden" name="city" id="city" value="{{!empty($clients['city'])?$clients['city']:''}}">
              <input type="hidden" name="latitude" id="cityLat" value="{{!empty($clients['latitude'])?$clients['latitude']:''}}">
              <input type="hidden" name="longitude" id="cityLng" value="{{!empty($clients['longitude'])?$clients['longitude']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Client's Occupation</label><small>(with detail):</small>
              <input type="text" class="form-control" placeholder="Enter Clients Occupation..." name="occupation" value="{{!empty($clients['occupation'])?$clients['occupation']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>District:</label>
              <input type="text" class="form-control" placeholder="Enter District..." name="district" value="{{!empty($clients['district'])?$clients['district']:''}}">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>State:</label>
              <input type="text" class="form-control" placeholder="Enter State..." name="state" value="{{!empty($clients['state'])?$clients['state']:''}}">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Nationality:</label>
              <input type="text" class="form-control" placeholder="Enter Nationality..." name="nationality" value="{{!empty($clients['nationality'])?$clients['nationality']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Pin Code:</label>
              <input type="text" class="form-control" placeholder="Enter Pincode..." name="pincode" value="{{!empty($clients['pincode'])?$clients['pincode']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>PAN Number:</label>
              <input type="text" class="form-control" placeholder="Enter PAN Number..." name="pan" value="{{!empty($clients['pan'])?$clients['pan']:''}}">
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
                <img style="max-width: 250px;" src="{{url('assets/img/Clients')}}/{{$clients['photo']}}" id="adminimg" alt="No Featured Image Added">
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
                <img style="max-width: 250px;" src="{{url('assets/img/Id Proof')}}/{{$clients['id_proof']}}" id="idimg" alt="No Featured Image Added">
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
                <img style="max-width: 250px;" src="{{url('assets/img/Address Proof')}}/{{$clients['address_proof']}}" id="addressimg" alt="No Featured Image Added">
              </div>
            </div>
          </div>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/client')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-client"]' class="btn btn-info pull-right">Submit</button>
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