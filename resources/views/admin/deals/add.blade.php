<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Deal</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-deal" method="POST" action="{!! action('Admin\DealsController@store') !!}">
        {{csrf_field()}}

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Deal On:</label>
              <select class="form-control" name="client_id" id="client_id">
                <option value="">Select Client Name</option>
                @foreach($client as $clients)
                  <option value="{{!empty($clients['id'])?$clients['id']:''}}">{{!empty($clients['name'])?$clients['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Select Property Type:</label>
              <select class="form-control" name="property_type" id="property_type">
                <option value="">Select Property Type</option>
                <option value="residential">Residential</option>
                <option value="commercial">Commercial</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Select Project:</label>
              <select class="form-control" name="project_id" id="project_id">
                <option value="">Select Project</option>
                @foreach($project as $projects)
                  <option value="{{!empty($projects['id'])?$projects['id']:''}}">{{!empty($projects['name'])?$projects['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Select Property Name:</label>
              <select class="form-control" name="property_id" id="property_id">
                <option value="">Select Property Name</option>
                @foreach($property as $property_name)
                  <option value="{{!empty($property_name['id'])?$property_name['id']:''}}">{{!empty($property_name['name'])?$property_name['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Invoice Number:</label>
              <input type="text" class="form-control" placeholder="Enter Invoice Number..." name="invoice_no">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Invoice Date:</label>
              <input type="date" class="form-control" placeholder="Enter Invoice Date..." name="date">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Area:</label>
              <input type="text" name="area" class="form-control" placeholder="Enter Area...">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Amount:</label>
              <input type="text" name="amount" class="form-control" placeholder="Enter Amount...">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Discount:</label>
              <input type="text" name="discount" class="form-control" placeholder="Enter Discount...">
            </div>
          </div>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/property')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-property"]' class="btn btn-info pull-right">Submit</button>
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
  CKEDITOR.replace("key_points");

</script>
@endsection