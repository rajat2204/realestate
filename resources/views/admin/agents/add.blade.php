<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Agent</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-agent" method="POST" action="{!! action('Admin\AgentController@store') !!}">
        {{csrf_field()}}

        <input type="hidden" class="form-control" name="agent_id">
        <div class="form-group">
          <label for="image">Agent's Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="adminimg" alt="No Featured Image Added">
          </div>
       </div> 
       <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Agent Name:</label>
            <input type="text" class="form-control" placeholder="Enter Agents Name..." name="name">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Son/Daughter/Husband/Wife Name:</label>
            <input type="text" class="form-control" placeholder="Enter Agents Son/Daughter/Wife Name..." name="spouse_name">
          </div>
        </div> 
       </div>   
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Agent's DOB:</label>
              <input type="date" class="form-control" placeholder="Enter Agents Date of Birth" name="dob">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>Agent's Adhaar Number:</label>
                <input type="text" class="form-control" placeholder="Enter Agents Adhaar Number" name="adhaar">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>Agent's PAN Number:</label>
                <input type="text" class="form-control" placeholder="Enter Agents PAN Number" name="pan">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Agent's Address:</label>
              <input type="text" class="form-control" placeholder="Enter Agents Address" name="address" id="autocomplete">
              <input type="hidden" name="city" id="city">
              <input type="hidden" name="latitude" id="cityLat">
              <input type="hidden" name="longitude" id="cityLng">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Agent's Post Office:</label>
              <input type="text" class="form-control" placeholder="Enter Agents Post Office" name="post_office">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>Tehsil:</label>
                <input type="text" class="form-control" placeholder="Enter Tehsil" name="tehsil">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>District:</label>
                <input type="text" class="form-control" placeholder="Enter District" name="district">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Agent's PIN:</label>
              <input type="text" class="form-control" placeholder="Enter Agents PIN" name="pin">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Agent's Contact Number:</label>
              <input type="text" class="form-control" placeholder="Enter Agents Contact Number" name="phone">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>E-mail Id:</label>
                <input type="text" class="form-control" placeholder="Enter Agent E-mail Id" name="email">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" placeholder="Enter Agent Password" name="password">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Nominee:</label>
              <input type="text" class="form-control" placeholder="Enter Nominee" name="nominee">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Nominee Relation:</label>
              <input type="text" class="form-control" placeholder="Enter Nominee Relation" name="relation">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
                <label>Nominee Date Of Birth:</label>
                <input type="date" class="form-control" placeholder="Enter Nominee Date Of Birth" name="dob_nominee">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Introducer Name:</label>
              <input type="text" class="form-control" placeholder="Enter Introducer Name" name="introducer_name">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Code:</label>
              <input type="text" class="form-control" placeholder="Enter Code" name="code">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Educational Qualification:</label>
              <input type="text" class="form-control" placeholder="Enter Educational Qualification" name="qualification">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Previous Experience:</label>
              <input type="text" class="form-control" placeholder="Enter Previous Experience" name="experience">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Banker's Name:</label>
              <input type="text" class="form-control" placeholder="Enter Banker's Name" name="banker_name">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Branch:</label>
              <input type="text" class="form-control" placeholder="Enter Branch" name="branch_name">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Account Number:</label>
              <input type="text" class="form-control" placeholder="Enter Account Number" name="account_no">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>IFSC Code:</label>
              <input type="text" class="form-control" placeholder="Enter IFSC Code" name="ifsc">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Executive ID:</label>
              <input type="text" class="form-control" placeholder="Enter Executive ID" name="executive_id">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Rank:</label>
              <input type="text" class="form-control" placeholder="Enter Rank" name="rank">
            </div>
          </div>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/agent')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-agent"]' class="btn btn-info pull-right">Submit</button>
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