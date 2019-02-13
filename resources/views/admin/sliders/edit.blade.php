<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Slider</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-slider" method="POST" action="{{url('admin/sliders/'.___encrypt($slider['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($slider['id'])?$slider['id']:''}}">
          </div>
        </div>
        <div class="form-group">
          <label>Slider Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{url('assets/img/Sliders')}}/{{$slider['image']}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label>Slider Title:</label>
          <input type="text" class="form-control" placeholder="Enter Slider Title..." name="title" value="{{!empty($slider['title'])?$slider['title']:''}}">
        </div>

        <div class="form-group">
          <label>Slider Description:</label>
          <textarea id="description" name="description" rows="6" cols="80">{{!empty($slider['description'])?$slider['description']:''}}</textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/sliders')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-slider"]' class="btn btn-info pull-right">Submit</button>
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