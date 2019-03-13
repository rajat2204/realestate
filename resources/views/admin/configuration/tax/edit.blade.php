<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Tax</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-inventory" method="POST" action="{{url('admin/tax/'.___encrypt($tax['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($tax['id'])?$tax['id']:''}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Select Tax Name:</label>
              <select class="form-control" name="tax_id" id="tax_id">
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
