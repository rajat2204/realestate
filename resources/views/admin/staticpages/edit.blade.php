<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Static Page</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-static" method="POST" action="{{url('admin/static_pages/'.___encrypt($staticpage['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($staticpage['id'])?$staticpage['id']:''}}">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Title :</label>
              <input type="text" class="form-control" placeholder="Enter Title Name..." name="title" value="{{!empty($staticpage['title'])?$staticpage['title']:''}}" readonly>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Slug:</label>
              <input type="text" class="form-control" placeholder="Enter Slug..." name="slug" value="{{!empty($staticpage['slug'])?$staticpage['slug']:''}}">
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="image">Static Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{url('assets/img/staticpage')}}/{{$staticpage['image']}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label>Description :</label>
          <textarea id="description" name="description" rows="6" cols="80">{{!empty($staticpage['description'])?$staticpage['description']:''}}</textarea>
        </div>
        </div> 
       </div>

        <div class="box-footer">
          <a href="{{url('admin/static_pages')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-static"]' class="btn btn-info pull-right">Submit</button>
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