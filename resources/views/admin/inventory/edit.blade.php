<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Inventory</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-inventory" method="POST" action="{{url('admin/inventory/'.___encrypt($inventory['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($inventory['id'])?$inventory['id']:''}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Select Project Name:</label>
              <select class="form-control" name="project_id" id="project_id">
                <option value="">Select Project Name</option>
                @foreach($project as $projects)
                  <option value="{{!empty($projects['id'])?$projects['id']:''}}" @if($projects['id'] == $inventory['project_id']) selected @endif >{{!empty($projects['name'])?$projects['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Select Category Name:</label>
              <select class="form-control" name="expense_category_id" id="expense_category_id">
                <option value="">Select Category Name</option>
                @foreach($expensecategory as $expensecategories)
                  <option value="{{!empty($expensecategories['id'])?$expensecategories['id']:''}}" @if($expensecategories['id'] == $inventory['expense_category_id']) selected @endif >{{!empty($expensecategories['name'])?$expensecategories['name']:''}}</option>
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
                  <option value="{{!empty($vendors['id'])?$vendors['id']:''}}" @if($vendors['id'] == $inventory['vendor_id']) selected @endif >{{!empty($vendors['name'])?$vendors['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Invoice Number:</label>
          <input type="text" class="form-control" placeholder="Enter Invoice Number..." name="invoice_no" value="{{!empty($inventory['invoice_no'])?$inventory['invoice_no']:''}}">
        </div>

        <div class="form-group">
          <label>Invoice Date:</label>
          <input type="date" class="form-control" placeholder="Enter Invoice Date..." name="invoice_date" value="{{!empty($inventory['invoice_date'])?$inventory['invoice_date']:''}}">
        </div>

        <div class="form-group">
          <label>Quantity:</label>
          <input type="text" class="form-control" placeholder="Quantity..." name="quantity" id="qty" value="{{!empty($inventory['quantity'])?$inventory['quantity']:''}}">
        </div>

        <div class="form-group" style="display: none;">
          <label>Balance:</label>
          <input type="text" class="form-control" placeholder="Enter Balance..." name="balance" id="balance" value="{{!empty($inventory['balance'])?$inventory['balance']:''}}">
        </div>

        <div class="form-group">
          <label>Remarks:</label>
          <textarea name="remarks" id="remarks" rows="6" cols="80">{{!empty($inventory['remarks'])?$inventory['remarks']:''}}</textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/inventory')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-inventory"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
<script type="text/javascript">
  CKEDITOR.replace("remarks")

$(document).ready(function () {
  $("#qty").keyup(function () {
      var value = $(this).val();
      $("#balance").val(value);
  });
});
</script>
@endsection
