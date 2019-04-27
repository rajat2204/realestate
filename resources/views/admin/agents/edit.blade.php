<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">

      <h3 class="box-title">Edit Agent</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body ">
      <form role="edit-agent" method="POST" action="{{url('admin/agent/'.___encrypt($agent['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($agent['id'])?$agent['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label for="image">Agent's Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
              <span class="image-size">File Size(255X270 pixels)</span>
          </div>
          <div>
            <img style="max-width: 250px;" src="{{url('assets/img/agent')}}/{{$agent['image']}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Agent Name:</label>
              <input type="text" class="form-control" placeholder="Enter Agents Name..." name="name" value="{{!empty($agent['name'])?$agent['name']:''}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Son/Daughter/Husband/Wife Name:</label>
              <input type="text" class="form-control" placeholder="Enter Agents Son/Daughter/Wife Name..." name="spouse_name" value="{{!empty($agent['spouse_name'])?$agent['spouse_name']:''}}">
            </div>
          </div> 
        </div>   
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Agent's DOB:</label>
              <input type="date" class="form-control" placeholder="Enter Agents Date of Birth" name="dob" value="{{!empty($agent['dob'])?$agent['dob']:''}}">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>Agent's Adhaar Number:</label>
                <input type="text" class="form-control" placeholder="Enter Agents Adhaar Number" name="adhaar" value="{{!empty($agent['adhaar'])?$agent['adhaar']:''}}">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>Agent's PAN Number:</label>
                <input type="text" class="form-control" placeholder="Enter Agents PAN Number" name="pan" value="{{!empty($agent['pan'])?$agent['pan']:''}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Agent's Address:</label>
              <input type="text" class="form-control" placeholder="Enter Agents Address" name="address" id="autocomplete" value="{{!empty($agent['address'])?$agent['address']:''}}">
              <input type="hidden" name="city" id="city" value="{{!empty($agent['city'])?$agent['city']:''}}">
              <input type="hidden" name="latitude" id="cityLat" value="{{!empty($agent['latitude'])?$agent['latitude']:''}}">
              <input type="hidden" name="longitude" id="cityLng" value="{{!empty($agent['longitude'])?$agent['longitude']:''}}">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Agent's Post Office:</label>
              <input type="text" class="form-control" placeholder="Enter Agents Post Office" name="post_office" value="{{!empty($agent['post_office'])?$agent['post_office']:''}}">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>Tehsil:</label>
                <input type="text" class="form-control" placeholder="Enter Tehsil" name="tehsil" value="{{!empty($agent['tehsil'])?$agent['tehsil']:''}}">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>District:</label>
                <input type="text" class="form-control" placeholder="Enter District" name="district" value="{{!empty($agent['district'])?$agent['district']:''}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Agent's PIN:</label>
              <input type="text" class="form-control" placeholder="Enter Agents PIN" name="pin" value="{{!empty($agent['pin'])?$agent['pin']:''}}">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Agent's Contact Number:</label>
              <input type="text" class="form-control" placeholder="Enter Agents Contact Number" name="phone" value="{{!empty($agent['phone'])?$agent['phone']:''}}">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label>E-mail Id:</label>
                <input type="text" class="form-control" placeholder="Enter Agent E-mail Id" name="email" value="{{!empty($agent['email'])?$agent['email']:''}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Nominee:</label>
              <input type="text" class="form-control" placeholder="Enter Nominee" name="nominee" value="{{!empty($agent['nominee'])?$agent['nominee']:''}}">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Nominee Relation:</label>
              <input type="text" class="form-control" placeholder="Enter Nominee Relation" name="relation" value="{{!empty($agent['relation'])?$agent['relation']:''}}">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label>Nominee Date Of Birth:</label>
                <input type="date" class="form-control" placeholder="Enter Nominee Date Of Birth" name="dob_nominee" value="{{!empty($agent['dob_nominee'])?$agent['dob_nominee']:''}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Introducer Name:</label>
              <input type="text" class="form-control" placeholder="Enter Introducer Name" name="introducer_name" value="{{!empty($agent['introducer_name'])?$agent['introducer_name']:''}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Code:</label>
              <input type="text" class="form-control" placeholder="Enter Code" name="code" value="{{!empty($agent['code'])?$agent['code']:''}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Educational Qualification:</label>
              <input type="text" class="form-control" placeholder="Enter Educational Qualification" name="qualification" value="{{!empty($agent['qualification'])?$agent['qualification']:''}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Previous Experience:</label>
              <input type="text" class="form-control" placeholder="Enter Previous Experience" name="experience" value="{{!empty($agent['experience'])?$agent['experience']:''}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Banker's Name:</label>
              <input type="text" class="form-control" placeholder="Enter Banker's Name" name="banker_name" value="{{!empty($agent['banker_name'])?$agent['banker_name']:''}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Branch:</label>
              <input type="text" class="form-control" placeholder="Enter Branch" name="branch_name" value="{{!empty($agent['branch_name'])?$agent['branch_name']:''}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Account Number:</label>
              <input type="text" class="form-control" placeholder="Enter Account Number" name="account_no" value="{{!empty($agent['account_no'])?$agent['account_no']:''}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>IFSC Code:</label>
              <input type="text" class="form-control" placeholder="Enter IFSC Code" name="ifsc" value="{{!empty($agent['ifsc'])?$agent['ifsc']:''}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Executive ID:</label>
              <input type="text" class="form-control" placeholder="Enter Executive ID" name="executive_id" value="{{!empty($agent['executive_id'])?$agent['executive_id']:''}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Rank:</label>
              <input type="text" class="form-control" placeholder="Enter Rank" name="rank" value="{{!empty($agent['rank'])?$agent['rank']:''}}">
            </div>
          </div>
        </div>
        <div class="box-footer">
          <a href="{{url('admin/agent')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-agent"]' class="btn btn-info pull-right">Submit</button>
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

</script>
@endsection