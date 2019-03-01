<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Lead</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-lead" method="POST" action="{!! action('Admin\LeadController@store') !!}">
        {{csrf_field()}}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name:</label>
              <input type="text" class="form-control" placeholder="Enter Name..." name="name">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Address:</label>
              <input type="text" class="form-control" placeholder="Enter Address..." name="address">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>E-mail:</label>
              <input type="email" class="form-control" placeholder="Enter Email..." name="email">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Phone Number:</label>
              <input type="text" class="form-control" placeholder="Enter Phone Number..." name="phone">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Available For:</label>
              <select class="form-control" name="available">
                <option value="">Select Availability</option>
                <option value="sale">Sale</option>
                <option value="rent">Rent</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Property:</label>
              <select class="form-control" name="property_id">
                <option value="">Select Property</option>
                @foreach($property as $properties)
                  <option value="{{!empty($properties['id'])?$properties['id']:''}}">{{!empty($properties['name'])?$properties['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Follow Up:</label>
              <input type="date" class="form-control" name="followup">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Status:</label>
              <select class="form-control" name="status">
                <option value="">Select Status</option>
                <option value="process">In Process</option>
                <option value="visited">Site Visited</option>
                <option value="documents">Documents Collected</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Comments/Remarks:</label>
          <textarea id="description" name="remarks" rows="6" cols="80"></textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/leads')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-lead"]' class="btn btn-info pull-right">Submit</button>
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

CKEDITOR.replace("description");
</script>
@endsection