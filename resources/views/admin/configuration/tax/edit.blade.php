<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Tax</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-tax" method="POST" action="{{url('admin/tax/edit/'.___encrypt($tax['id']))}}">
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
                  <option value="{{!empty($projects['id'])?$projects['id']:''}}" >{{!empty($tax_name['tax_name'])?$tax-name['tax_name']:''}}</option>
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
{{-- =======
        <div class="form-group">
          <label>Tax Name:</label>
          <input type="text" class="form-control" placeholder="Enter Tax Name..." name="name" value="{{!empty($tax['name'])?$tax['name']:''}}">
>>>>>>> 46a04b79f9b6609ee1aff64eea16625325b849e4
        </div> --}}

        <div class="form-group">
          <label>Tax Percentage:</label>
          <input type="text" class="form-control" placeholder="Enter Tax Percentage..." name="percentage" value="{{!empty($tax['percentage'])?$tax['percentage']:''}}">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/tax')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-tax"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>