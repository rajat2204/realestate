<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Plan</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-plan" method="POST" action="{{url('admin/plans/'.___encrypt($plan['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($plan['id'])?$plan['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>Plan Name:</label>
          <input type="text" class="form-control" placeholder="Enter Plan Name..." name="name" value="{{!empty($plan['name'])?$plan['name']:''}}">
        </div>

        <div class="form-group">
          <label>Plan Installment:</label>
          <input type="text" class="form-control" placeholder="Enter Plan Installment..." name="installment" value="{{!empty($plan['installment'])?$plan['installment']:''}}">
        </div>
        <div class="box-footer">
          <a href="{{url('admin/plans')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-plan"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>