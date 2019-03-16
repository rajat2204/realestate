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
                <option value="others">Others</option>
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
              <select class="form-control" name="property_id" id="properties">
                <option value="">Select Property Name</option>
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
          <div class="col-md-3">
            <div class="flex-c">
              <div class="form-group m-r-10">
                <label>Area:</label>
                <input type="text" name="area" class="form-control" placeholder="Enter Area..." readonly id="area">
              </div>
              <div class="form-group">
                <label>Units:</label>
                <input type="text" name="unit_name" id="unit_name" placeholder="Enter Unit" readonly class="form-control">
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>Amount:</label>
              <input type="text" name="amount" class="form-control" readonly placeholder="Enter Amount..." id="amount">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Discount<small>(In %):</small></label>
              <input type="text" name="discount" id="discount" class="form-control" placeholder="Enter Discount...">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Balance:</label>
              <input type="text" name="balance" class="form-control payable_balance" placeholder="Enter Balance..." readonly id="payable_balance">
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

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Comments/Remarks:</label>
              <textarea cols="80" rows="6" name="remarks" id="remarks"></textarea>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label></label>
                <p><strong>Area: <span id="area_id"></span></strong></p>
                <p><strong>Amount : <span id="amount_id"></span></strong></p>
                <p><strong>Discount : <span id="new_discount"></span></strong></p>
                <p><strong>Payable Amount : <span id="payable_amount"></span></strong></p>
            </div>
          </div>
        </div>
        <input type="hidden" id="old_amount" name="old_amount">
        <input type="hidden" class="payable_amount" name="payable_amount">
        <input type="hidden" id="unit_id" name="unit_id">
        <div class="box-footer">
          <a href="{{url('admin/deals')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-deal"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
<script type="text/javascript">
  CKEDITOR.replace("remarks");

  $(document).ready(function(){
        $('#project_id').on('change',function(){
            var value = $(this).val();
            $.ajax({
                url:"{{url('admin/property/ajaxproperty?id=')}}"+value,
                type:'POST',
                success:function(data){
                    $('#properties').html(data).prev().css("display","block");
                }
            });
        });
    });

  $(document).ready(function(){
        $('#properties').on('change',function(){
            var value = $(this).val();
            $.ajax({
                url:"{{url('admin/area/ajaxarea?id=')}}"+value,
                type:'POST',
                success:function(data){
                  console.log(data);
                    $('#area').val(data.area);
                    $('#amount').val(data.price);
                    $('#unit_name').val(data.unit_name);
                    $('#area_id').html(data.area);
                    $('#amount_id').html(data.price);
                    $('#old_amount').val(data.price);
                    $('#unit_id').val(data.unit_id);
                    discount_count();
                }
            });
        });
        function discount_count(){
           var amount =  $('#old_amount').val();
            $('#new_discount').html('0');
           $('#payable_amount').html(amount);
           $('.payable_amount').val(amount);
           $('.payable_balance').val(amount);
           $('#payable_balance').html(amount);
        }

         $('#discount').on('keyup',function(){
           // discount_count
            var discount = $('#discount').val();
            var amount = $('#old_amount').val();
            var  payable_amount = (amount-(amount*discount/100));
            $('#new_discount').html(discount);
            $('#payable_amount').html(payable_amount);
            $('.payable_amount').val(payable_amount);
            $('.payable_balance').val(payable_amount);
           $('#payable_balance').html(payable_amount);

         });
    });
</script>
@endsection