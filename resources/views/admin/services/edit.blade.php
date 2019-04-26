<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Services</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-service" method="POST" action="{{url('admin/service/'.___encrypt($service['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($service['id'])?$service['id']:''}}">
          </div>
        </div>
        <div class="form-group">
          <label>Service Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
              <span class="image-size">File Size(310X195 pixels)</span>
          </div>
          <div>
            <img style="max-width: 250px;" src="{{url('assets/img/services')}}/{{$service['image']}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label>Service Title:</label>
          <input type="text" class="form-control" placeholder="Enter Service Title..." name="title" value="{{!empty($service['title'])?$service['title']:''}}">
        </div>

        <div class="form-group">
          <label>Service Description:</label>
          <textarea id="description" name="description" rows="6" cols="80">{{!empty($service['description'])?$service['description']:''}}</textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/service')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-service"]' class="btn btn-info pull-right">Submit</button>
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