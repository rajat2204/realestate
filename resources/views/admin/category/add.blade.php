<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Property Category</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-category" method="POST" action="{!! action('Admin\CategoryController@store') !!}">
        {{csrf_field()}}
        <div class="form-group">
          <label>Category Name:</label>
          <input type="text" class="form-control" placeholder="Enter Category Name..." name="name">
        </div>

        <div class="form-group">
          <label>Category Slug:</label>
          <input type="text" class="form-control" placeholder="Enter Category Slug..." name="slug">
        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Cancel</button>
          <button type="button" data-request="ajax-submit" data-target='[role="add-category"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>