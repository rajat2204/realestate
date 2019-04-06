<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Payment</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-payment" method="POST" action="{{url('admin/deals/makepayment/'.___encrypt($deal['id']))}}">
        {{csrf_field()}}

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name:</label>
              <input type="text" name="name" readonly class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Amount:</label>
              <input type="text" name="amount" readonly class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Extra/Late Amount:</label>
          <input type="text" name="late_amount" placeholder="Enter Extra/Late Amount" class="form-control">
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tax:</label>
              <select class="form-control" name="payment_type" id="payment_type">
                <option value="">Select Tax if Applicable</option>
                @foreach($tax as $taxes)
                  <option value="{{!empty($taxes['id'])?$taxes['id']:''}}">{{!empty($taxes['percentage'])?$taxes['percentage']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Payable Amount:</label>
              <input type="text" name="payable_amount" readonly class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Payment Type:</label>
              <select class="form-control" name="payment_type" id="payment_type">
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
</script>
@endsection