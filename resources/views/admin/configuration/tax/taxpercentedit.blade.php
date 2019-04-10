<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Tax Percent</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-taxpercent" method="POST" action="{{url('admin/taxpercent/edit/'.___encrypt($taxpercent['id']))}}">
        {{csrf_field()}}
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($taxpercent['id'])?$taxpercent['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>Tax Name:</label>
          <select class="form-control" name="tax_id" id="tax_id">
            <option value="">Select Tax Name</option>
            @foreach($taxname as $taxnames)
              <option value="{{!empty($taxnames['id'])?$taxnames['id']:''}}" @if($taxnames['id'] == $taxpercent['tax_id']) selected @endif >{{!empty($taxnames['name'])?$taxnames['name']:''}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Tax Percentage:</label>
            <input type="text" class="form-control" placeholder="Enter Tax Percentage..." name="percentage" value="{{!empty($taxpercent['percentage'])?$taxpercent['percentage']:''}}">
          </div>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/tax')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-taxpercent"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>