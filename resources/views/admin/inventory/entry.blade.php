<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Entry</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-entry" method="POST" action="{{url('admin/inventory/entry/'.___encrypt($inventory['id']))}}">
        {{csrf_field()}}
        <input type="hidden" name="balance" value="{{!empty($inventory['balance'])?$inventory['balance']:''}}">
        
        <div class="form-group">
          <label>Quantity:</label>
          <input type="text" class="form-control" placeholder="Enter Quantity..." name="qty" id="qty">
        </div>
        <input type="hidden" name="inventory_id" value="{{!empty($inventory['id'])?$inventory['id']:''}}">

        <div class="form-group">
          <label>Invoice Date:</label>
          <input type="date" class="form-control" placeholder="Enter Invoice Date..." name="date">
        </div>

        <div class="form-group">
          <label>Remarks:</label>
          <textarea name="remarks" id="remarks" rows="6" cols="80"></textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/inventory')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-entry"]' class="btn btn-info pull-right">Submit</button>
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
