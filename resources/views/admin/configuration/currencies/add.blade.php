<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Currency</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-currency" method="POST" action="{!! action('Admin\ConfigurationController@currencyAdd') !!}">
      {{csrf_field()}}
        <div class="form-row">
            <div class="form-group">
              <label>Currency Name:</label>
              <input type="text" class="form-control" placeholder="Enter Currency Name..." 
              name="currency_name">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>Upload Currency (Less or equal to 50* 50):</label>
              <input type="file"  placeholder="Enter Currency Image..." name="image">
            </div>
          </div>

        <div class="box-footer">
          <a href="{{url('admin/client')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-currency"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>