<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">

      <h3 class="box-title">Edit Cheque</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body ">
      <form role="edit-cheque" method="POST" action="{{url('admin/allcheques/'.___encrypt($cheques['id']))}}">
        {{csrf_field()}}
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($cheques['id'])?$cheques['id']:''}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Client Name</label>
              <input type="text" name="client_id" class="form-control" disabled value="{{!empty($cheques['client']['name'])?$cheques['client']['name']:''}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Client Contact</label>
              <input type="text" name="phone" class="form-control" disabled value="{{!empty($cheques['client']['phone'])?$cheques['client']['phone']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Payment Name</label>
              <input type="text" name="name" class="form-control" disabled value="{{!empty($cheques['name'])?$cheques['name']:''}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Payment Amount</label>
              <input type="text" name="amount" class="form-control" disabled value="{{!empty($cheques['amount'])?$cheques['amount']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Invoice Number</label>
              <input type="text" name="invoice_no" class="form-control" disabled value="{{!empty($cheques['invoice_no'])?$cheques['invoice_no']:''}}">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Cheque Number</label>
              <input type="text" name="cheque_no" class="form-control" disabled value="{{!empty($cheques['cheque_no'])?$cheques['cheque_no']:''}}">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Bank Name</label>
              <input type="text" name="bank_name" class="form-control" disabled value="{{!empty($cheques['bank_name'])?$cheques['bank_name']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Status</label>
              <select name="status" id="status" class="form-control">
                <option value="">Select Status</option>
                <option value="clear">Cleared</option>
                <option value="bounce">Bounced</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </div>
          </div>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/allcheques')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-cheque"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
@endsection