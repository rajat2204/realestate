<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Deal</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-deal" method="POST" action="{{url('admin/deals/'.___encrypt($deal['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($deal['id'])?$deal['id']:''}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Invoice Number:</label>
              <input type="text" class="form-control" placeholder="Enter Invoice Number..." name="invoice_no" value="{{$deal['invoice_no']}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Invoice Date:</label>
              <input type="date" class="form-control" placeholder="Enter Invoice Date..." name="date" value="{{$deal['date']}}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Comments/Remarks:</label>
          <textarea cols="80" rows="6" name="remarks" id="remarks">{{$deal['remarks']}}</textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/deals')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-deal"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
<script type="text/javascript">
  CKEDITOR.replace('remarks');
</script>
@endsection