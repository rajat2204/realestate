<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Inventory</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-inventory" method="POST" action="{!! action('Admin\InventoryController@store') !!}">
        {{csrf_field()}}

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Select Project Name:</label>
              <select class="form-control" name="project_id" id="project_id">
                <option value="">Select Project Name</option>
                @foreach($project as $projects)
                  <option value="{{!empty($projects['id'])?$projects['id']:''}}">{{!empty($projects['name'])?$projects['name']:''}}</option>
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
                  <option value="{{!empty($expensecategories['id'])?$expensecategories['id']:''}}">{{!empty($expensecategories['name'])?$expensecategories['name']:''}}</option>
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
                  <option value="{{!empty($vendors['id'])?$vendors['id']:''}}">{{!empty($vendors['name'])?$vendors['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Invoice Number:</label>
          <input type="text" class="form-control" placeholder="Enter Invoice Number..." name="invoice_no">
        </div>

        <div class="form-group">
          <label>Invoice Date:</label>
          <input type="date" class="form-control" placeholder="Enter Invoice Date..." name="invoice_date">
        </div>

        <div class="form-group">
          <label>Quantity:</label>
          <input type="text" class="form-control" placeholder="Enter Quantity..." name="quantity">
        </div>

        <div class="form-group">
          <label>Remarks:</label>
          <textarea name="remarks" id="remarks" rows="6" cols="80"></textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/expenses')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-expense"]' class="btn btn-info pull-right">Submit</button>
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
