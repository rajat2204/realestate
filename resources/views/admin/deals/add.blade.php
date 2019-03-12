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

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Plan:</label>
              <select class="form-control" name="plan_id" id="plan_id">
                <option value="">Select Plan</option>
                @foreach($plan as $plans)
                  <option value="{{!empty($plans['id'])?$plans['id']:''}}">{{!empty($plans['name'])?$plans['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Payment Method:</label>
              <select class="form-control" name="payment_method" id="payment_method">
                <option value="">Select Payment Method</option>
                <option value="manually">Manually</option>
                <option value="monthly">Monthly</option>
                <option value="quarterly">Quarterly</option>
                <option value="halfyearly">Half Yearly</option>
                <option value="yearly">Yearly</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Agent:</label><small>(if any)</small>
              <select class="form-control" name="agent_id" id="agent_id">
                <option value="">Select Agent</option>
                @foreach($agent as $agents)
                  <option value="{{!empty($agents['id'])?$agents['id']:''}}">{{!empty($agents['name'])?$agents['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Comments/Remarks:</label>
          <textarea cols="80" rows="6" name="remarks" id="remarks"></textarea>
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
  CKEDITOR.replace("remarks");
</script>
@endsection