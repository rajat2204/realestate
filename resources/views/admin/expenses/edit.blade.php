<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Expense</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-expense" method="POST" action="{{url('admin/expenses/'.___encrypt($expense['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($expense['id'])?$expense['id']:''}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Select Project Name:</label>
              <select class="form-control" name="project_id" id="project_id">
                <option value="">Select Project Name</option>
                @foreach($project as $projects)
                  <option value="{{!empty($projects['id'])?$projects['id']:''}}" @if($projects['id'] == $expense['project_id']) selected @endif >{{!empty($projects['name'])?$projects['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Select Expense Category Name:</label>
              <select class="form-control" name="category_id" id="category_id">
                <option value="">Select Expense Category Name</option>
                @foreach($expensecategory as $expensecategories)
                  <option value="{{!empty($expensecategories['id'])?$expensecategories['id']:''}}" @if($expensecategories['id'] == $expense['category_id']) selected @endif >{{!empty($expensecategories['name'])?$expensecategories['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Select Vendor/Staff Name:</label>
              <select class="form-control" name="vendor_id" id="vendor_id">
                <option value="">Select Vendor/Staff Name</option>
                @foreach($vendor as $vendors)
                  <option value="{{!empty($vendors['id'])?$vendors['id']:''}}" @if($vendors['id'] == $expense['vendor_id']) selected @endif >{{!empty($vendors['name'])?$vendors['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Invoice Number:</label>
          <input type="text" class="form-control" placeholder="Enter Invoice Number..." name="invoice_no" value="{{!empty($expense['invoice_no'])?$expense['invoice_no']:''}}">
        </div>

        <div class="form-group">
          <label>Invoice Date:</label>
          <input type="date" class="form-control" placeholder="Enter Invoice Date..." name="invoice_date" value="{{!empty($expense['invoice_date'])?$expense['invoice_date']:''}}">
        </div>
        <div class="row">
          <div class="col-md-6"> 
            <div class="form-group">
              <label>Invoice Amount:</label>
              <input type="text" class="form-control" placeholder="Enter Invoice Amount..." name="amount" value="{{!empty($expense['amount'])?$expense['amount']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Invoice Due Balance:</label>
              <input type="text" class="form-control" placeholder="Enter Invoice Due Balance..." name="balance" value="{{!empty($expense['balance'])?$expense['balance']:''}}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Remarks:</label>
          <textarea name="remarks" id="remarks" rows="6" cols="80">{{!empty($expense['remarks'])?$expense['remarks']:''}}</textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/expenses')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-expense"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
<script type="text/javascript">
  CKEDITOR.replace("remarks")
</script>
@endsection
