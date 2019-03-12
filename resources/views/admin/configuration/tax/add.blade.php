<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Tax</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-tax" method="POST" action="{{url('admin/tax/add')}}">
      {{csrf_field()}}
        <div class="form-row">
            <div class="form-group">
              <label>Tax Name:</label>
              <input type="text" class="form-control" placeholder="Enter Currency Name..." 
              name="tax_name">
            </div>
          </div>
         <div class="form-row">
            <div class="form-group">
              <label>Tax Percentage:</label>
              <input type="text" class="form-control" placeholder="Enter Tax Percentage..." 
              name="tax_percentage">
            </div>
          </div>
        <div class="box-footer">
          <a href="{{url('admin/client')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-tax"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>