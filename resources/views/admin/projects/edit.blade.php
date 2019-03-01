<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Project</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-project" method="POST" action="{{url('admin/project/'.___encrypt($project['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($project['id'])?$project['id']:''}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Project Name:</label>
              <input type="text" class="form-control" placeholder="Enter Project Name..." name="name" value="{{!empty($project['name'])?$project['name']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Project Slug:</label>
              <input type="text" class="form-control" placeholder="Enter Project Slug..." name="slug" value="{{!empty($project['slug'])?$project['slug']:''}}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Project Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{url('assets/img/Projects')}}/{{$project['image']}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label>Location:</label>
          <input type="text" class="form-control" placeholder="Enter Location..." name="location" id="autocomplete" value="{{!empty($project['location'])?$project['location']:''}}">
          <input type="hidden" name="city" id="city" value="{{!empty($project['city'])?$project['city']:''}}">
          <input type="hidden" name="latitude" id="cityLat" value="{{!empty($project['latitude'])?$project['latitude']:''}}">
          <input type="hidden" name="longitude" id="cityLng" value="{{!empty($project['longitude'])?$project['longitude']:''}}">
        </div>

        <div class="form-group">
          <label>Project Description:</label>
          <textarea id="description" name="description" rows="6" cols="80">{{!empty($project['description'])?$project['description']:''}}</textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/project')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-project"]' class="btn btn-info pull-right">Submit</button>
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