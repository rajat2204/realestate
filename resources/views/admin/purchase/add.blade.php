<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Purchase</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-purchase" method="POST" action="{!! action('Admin\PurchaseController@store') !!}">
        {{csrf_field()}}

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Select Project Name:</label>
                <select class="form-control" name="project_id" id="project_id">
                  <option value="">Select Project</option>
                  @foreach($project as $projects)
                    <option value="{{!empty($projects['id'])?$projects['id']:''}}">{{!empty($projects['name'])?$projects['name']:''}}</option>
                  @endforeach
                </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Select Property Name:</label>
              <select class="form-control" name="property_id" id="properties">
                <option value=" ">Select Property</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Seller Name:</label>
              <input type="text" class="form-control" placeholder="Enter Seller Name..." name="seller_name">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Seller Address:</label>
              <input type="text" class="form-control" placeholder="Enter Seller Address..." name="seller_address">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Seller E-mail:</label>
              <input type="text" class="form-control" placeholder="Enter Seller E-mail..." name="seller_email">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Seller Mobile:</label>
              <input type="text" class="form-control" placeholder="Enter Seller Mobile..." name="seller_mobile">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Property Area(In Sq.ft.):</label>
              <input type="text" class="form-control" placeholder="Enter Property Area(In Sq.ft.)..." name="area">
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label>Property Price:</label>
              <input type="text" class="form-control" placeholder="Enter Property Price..." name="price" id="price">
            </div>
          </div>
        </div>

        <div class="form-group" style="display: none;">
          <label>Balance:</label>
          <input type="text" class="form-control" placeholder="Enter Balance..." name="balance" id="balance">
        </div>

        <div class="form-group">
          <label>Project Description:</label>
          <textarea id="description" name="description" rows="6" cols="80"></textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/purchase')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-purchase"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
<script type="text/javascript">

    CKEDITOR.replace("description");

  $(document).ready(function () {
    $("#price").keyup(function () {
        var value = $(this).val();
        $("#balance").val(value);
    });
});

    $(document).ready(function(){
        $('#project_id').on('change',function(){
            var value = $(this).val();
            $.ajax({
                url:"{{url('admin/property/ajaxproperty?id=')}}"+value,
                type:'POST',
                success:function(data){
                    $('#properties').html(data).prev().css("display","block");
                }
            });
        });
    });
</script>
@endsection