<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Tax Percentage</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-taxpercent" method="POST" action="{{url('admin/taxpercent/add')}}">
      {{csrf_field()}}
        <div class="form-group">
          <label>Tax Name:</label>
          <select class="form-control" name="tax_id" id="tax_id">
            <option>Select Tax Name</option>
            @foreach($taxname as $taxnames)
              <option value="{{!empty($taxnames['id'])?$taxnames['id']:''}}">{{!empty($taxnames['name'])?$taxnames['name']:''}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Tax Percentage:</label>
            <input type="text" class="form-control" placeholder="Enter Tax Percentage..." name="percentage">
          </div>
        </div>
        <div class="box-footer">
          <a href="{{url('admin/tax')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-taxpercent"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>