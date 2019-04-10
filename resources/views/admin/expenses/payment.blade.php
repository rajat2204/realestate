<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Payment</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-payment" method="POST" action="{{url('admin/expenses/payment/'.___encrypt($expenses['id']))}}">
        {{csrf_field()}}
        <input type="hidden" name="balance" value="{{!empty($expenses['balance'])?$expenses['balance']:''}}">

        <div class="form-group">
          <label>Amount:</label>
          <input type="text" class="form-control" placeholder="Enter Amount..." name="amount">
        </div>
        <input type="hidden" name="expense_id" value="{{!empty($expenses['id'])?$expenses['id']:''}}">

        <div class="form-group">
          <label>Select Payment Type:</label>
            <select class="form-control" name="payment_type" id="payment_type">
              <option value="">Select Payment Type...</option>
              <option value="bank_transfer">Bank Transfer</option>
              <option value="cash">Cash</option>
              <option value="cheque">Cheque</option>
              <option value="paypal">Paypal</option>
              <option value="debit_card">Debit Card</option>
            </select>
        </div>

        <div class="form-group">
          <label>Date:</label>
          <input type="date" class="form-control" name="date">
        </div>

        <div class="form-group">
          <label>Transaction Reference:</label>
          <input type="text" class="form-control" name="remarks" placeholder="Enter Reference...">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/expenses')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-payment"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>