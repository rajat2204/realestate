<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Project</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-project" method="POST" action="{!! action('Admin\ProjectController@store') !!}">
        {{csrf_field()}}

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Project Name:</label>
              <input type="text" class="form-control" placeholder="Enter Project Name..." name="name">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Project Slug:</label>
              <input type="text" class="form-control" placeholder="Enter Project Slug..." name="slug">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Project Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label>Location:</label>
          <input type="text" class="form-control" placeholder="Enter Location..." name="location" id="autocomplete">
          <input type="hidden" name="city" id="city">
          <input type="hidden" name="latitude" id="cityLat">
          <input type="hidden" name="longitude" id="cityLng">
        </div>

        <div class="form-group">
          <label>Project Description:</label>
          <textarea id="description" name="description" rows="6" cols="80"></textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/project')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-project"]' class="btn btn-info pull-right">Submit</button>
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