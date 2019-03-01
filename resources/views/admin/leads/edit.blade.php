<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Lead</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-lead" method="POST" action="{{url('admin/leads/'.___encrypt($lead['id']))}}">
        {{csrf_field()}}

        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($lead['id'])?$lead['id']:''}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name:</label>
              <input type="text" class="form-control" placeholder="Enter Name..." name="name" value="{{!empty($lead['name'])?$lead['name']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Address:</label>
              <input type="text" class="form-control" placeholder="Enter Address..." name="address" value="{{!empty($lead['address'])?$lead['address']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>E-mail:</label>
              <input type="email" class="form-control" placeholder="Enter Email..." name="email" value="{{!empty($lead['email'])?$lead['email']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Phone Number:</label>
              <input type="text" class="form-control" placeholder="Enter Phone Number..." name="phone" value="{{!empty($lead['phone'])?$lead['phone']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Available For:</label>
              <select class="form-control" name="available">
                <option value="">Select Availability</option>
                <option value="sale" <?php if($lead['available'] == 'sale'){echo("selected");}?>>Sale</option>
                <option value="rent" <?php if($lead['available'] == 'rent'){echo("selected");}?>>Rent</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Property:</label>
              <select class="form-control" name="property_id">
                <option value="">Select Property</option>
                @foreach($property as $properties)
                  <option value="{{!empty($properties['id'])?$properties['id']:''}}" @if($properties['id'] == $lead['property_id']) selected @endif>{{!empty($properties['name'])?$properties['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Follow Up:</label>
              <input type="date" class="form-control" name="followup" value="{{!empty($lead['followup'])?$lead['followup']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Status:</label>
              <select class="form-control" name="status">
                <option value="">Select Status</option>
                <option value="in process" <?php if($lead['status'] == 'in process'){echo("selected");}?>>In Process</option>
                <option value="site visited" <?php if($lead['status'] == 'site visited'){echo("selected");}?>>Site Visited</option>
                <option value="documents collected" <?php if($lead['status'] == 'documents collected'){echo("selected");}?>>Documents Collected</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Comments/Remarks:</label>
          <textarea id="description" name="remarks" rows="6" cols="80">{{!empty($lead['remarks'])?$lead['remarks']:''}}</textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/leads')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-lead"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
<script type="text/javascript">
  CKEDITOR.replace("description");
</script>
@endsection