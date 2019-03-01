<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Testimonial</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-testimonial" method="POST" action="{{url('admin/testimonial/'.___encrypt($testimonial['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($testimonial['id'])?$testimonial['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>Testimonial Name:</label>
          <input type="text" class="form-control" placeholder="Enter Testimonial Name..." name="name" value="{{!empty($testimonial['name'])?$testimonial['name']:''}}">
        </div>

        <div class="form-group">
          <label for="image">Testimonial's Featured Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{url('assets/img/testimonials')}}/{{$testimonial['image']}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label>Testimonial Description:</label>
          <textarea id="description" name="description" rows="6" cols="80">{{!empty($testimonial['description'])?$testimonial['description']:''}}</textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/testimonial')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-testimonial"]' class="btn btn-info pull-right">Submit</button>
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
  CKEDITOR.replace("key_points");

</script>
@endsection