<div class="content-wrapper"> 
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Currency</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-currency" method="POST" action="{{url('admin/currencies/store')}}">
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
              <div>
                <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
              </div>
              <div>
                <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="adminimg" alt="No Featured Image Added">
              </div>
            </div>
          </div>

        <div class="box-footer">
          <a href="{{url('admin/currencies')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-currency"]' class="btn btn-info pull-right">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('requirejs')
<script type="text/javascript">

  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#adminimg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
</script>
@endsection