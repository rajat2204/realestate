<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Expense Category</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-expensecategory" method="POST" action="{{url('admin/expensecategories/'.___encrypt($expensecategory['id']))}}">
      {{csrf_field()}}

      <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($expensecategory['id'])?$expensecategory['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>Expense Category Name:</label>
          <input type="text" class="form-control" placeholder="Enter Expense Category Name..." name="name" value="{{!empty($expensecategory['name'])?$expensecategory['name']:''}}">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/expensecategories')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-expensecategory"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>