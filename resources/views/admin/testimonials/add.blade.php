<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Testimonial</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-testimonial" method="POST" action="{!! action('Admin\TestimonialController@store') !!}">
        {{csrf_field()}}
        <div class="form-group">
          <label>Testimonial Name:</label>
          <input type="text" class="form-control" placeholder="Enter Testimonial Name..." name="name">
        </div>

        <div class="form-group">
          <label for="image">Testimonial's Featured Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
              <span class="image-size">File Size(64X64 pixels)</span>
          </div>
          <div>
            <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label>Testimonial Description:</label>
          <textarea id="description" name="description" rows="6" cols="80"></textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/testimonial')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-testimonial"]' class="btn btn-info pull-right">Submit</button>
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