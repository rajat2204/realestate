<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Expense Category</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-expensecategory" method="POST" action="{!! action('Admin\ExpenseCategoryController@store') !!}">
      {{csrf_field()}}

        <div class="form-group">
          <label>Expense Category Name:</label>
          <input type="text" class="form-control" placeholder="Enter Expense Category Name..." name="name">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/expensecategories')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-expensecategory"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>