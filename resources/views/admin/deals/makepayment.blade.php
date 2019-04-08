<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Payment</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-payment" method="POST" action="{{url('admin/deals/makepayment/'.___encrypt($deal['id']))}}">
        {{csrf_field()}}
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="deal_id" class="form-control" value="{{!empty($deal['id'])?$deal['id']:''}}">
            <input type="hidden" id="id" name="payment_plan_id" class="form-control" value="{{!empty($deal_payment['id'])?$deal_payment['id']:''}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name:</label>
              <input type="text" name="name" value="{{$deal_payment['name']}}" readonly class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Amount:</label>
              <input type="text" name="amount" value="{{$deal_payment['amount']}}" readonly class="form-control">
              <input type="hidden" id="real_amount" value="{{$deal_payment['amount']}}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Extra/Late Amount:</label>
          <input type="text" id="late_amount" name="late_amount" placeholder="Enter Extra/Late Amount" class="form-control">
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Tax Name:</label>
              <select class="form-control" name="tax_id" id="tax_id">
                <option value="">Select Tax if Applicable</option>
                @foreach($tax as $taxes)
                  <option value="{{!empty($taxes['id'])?$taxes['id']:''}}">{{!empty($taxes['name'])?$taxes['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tax Percentage:</label>
              <select class="form-control" name="tax_percent_id" id="tax_percent_id">
                <option value="">Select Tax Percentage</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Taxable Amount:</label>
              <input type="hidden" name="" value="">
              <input type="text" name="taxable_amount" id="taxable_amount" class="form-control" readonly>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Payable Amount:</label>
              <input type="text" id="payable_amount" name="payable_amount" value="{{$deal_payment['amount']}}" readonly class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Payment Type:</label>
              <select class="form-control" name="payment_type" id="payment_type" onchange="check_dd();">
                <option value="">Select Payment Type</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="cash">Cash</option>
                <option value="cheque">Cheque</option>
                <option value="paypal">PayPal</option>
                <option value="debit_card">Debit Card</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row" id="cheque_div" style="display: none;">
          <div class="col-md-6">
            <div class="form-group">
              <label>Cheque Number:</label>
              <input type="text" name="cheque_no" placeholder="Please Enter Cheque Number" class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Bank Name:</label>
              <input type="text" name="bank_name" placeholder="Please Enter Bank Name" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Payment Date:</label>
          <input type="date" name="date" class="form-control">
        </div>
        <div class="form-group">
          <label>Transaction Reference:</label>
          <textarea cols="80" rows="6" id="remarks" name="remarks"></textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/deals')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-payment"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
<script type="text/javascript">
  CKEDITOR.replace("remarks");

  $(document).ready(function(){
        $('#tax_id').on('change',function(){
            var value = $(this).val();
            $.ajax({
                url:"{{url('admin/tax/ajaxtax?id=')}}"+value,
                type:'POST',
                success:function(data){
                    $('#tax_percent_id').html(data).prev().css("display","block");
                }
            });
        });
    });

  function check_dd() {
    if(document.getElementById('payment_type').value == "cheque") {
        document.getElementById('cheque_div').style.display = 'block';
    } else {
        document.getElementById('cheque_div').style.display = 'none';
    }
}

  $(document).ready(function(){
    $('#late_amount').keyup(function(){
      var late_amount= $(this).val();
      var real_amount= $('#real_amount').val();
      // var payable_amount= $('#payable_amount').val();

      if(late_amount.length > 0)
      {
        var total_amount = Number(real_amount) + Number(late_amount);
        $('#payable_amount').val(total_amount);
      }
      else
      {
         $('#payable_amount').val(real_amount);
      }
    });

    $('#tax_percent_id').change(function(){
      var taxable = $('#tax_percent_id').find(":selected").text();
      var real_amount= $('#real_amount').val();
      var total_taxable_amount = ((parseFloat(real_amount)* parseFloat(taxable))/100);
      $('#taxable_amount').val(parseInt(total_taxable_amount));
      var amount =parseInt(total_taxable_amount);
      var payable_amount = $('#payable_amount').val();
      total_amount = parseInt(total_taxable_amount) + parseInt(payable_amount);
      $('#payable_amount').val(parseInt(total_amount));
      $('#real_amount').val(parseInt(total_amount));
    });
  });
</script>
@endsection