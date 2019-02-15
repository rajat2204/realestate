<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Slider</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-slider" method="POST" action="{!! action('Admin\SliderController@store') !!}">
        {{csrf_field()}}
        <div class="form-group">
          <label>Slider Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label>Slider Title:</label>
          <input type="text" class="form-control" placeholder="Enter Slider Title..." name="title">
        </div>

        <div class="form-group">
          <label>Slider Description:</label>
          <textarea id="description" name="description" rows="6" cols="80"></textarea>
        </div>

        <div class="form-group">
          <label>Select Slider Position:</label>
          <select class="form-control" name="position">
            <option value="">Select Slider Position</option>
            <option value="left">Left</option>
            <option value="right">Right</option>
            <option value="center">Center</option>
          </select>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/sliders')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-slider"]' class="btn btn-info pull-right">Submit</button>
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

    CKEDITOR.replace("description");
</script>
@endsection