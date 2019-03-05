<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Property</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-property" method="POST" action="{{url('admin/static_pages/'.___encrypt($staticpage['id']))}}">
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
              <input type="text" class="form-control" placeholder="Enter Title Name..." name="name" value="{{!empty($staticpage['title'])?$staticpage['title']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Slug:</label>
              <input type="text" class="form-control" placeholder="Enter Slug..." name="slug" value="{{!empty($staticpage['slug'])?$staticpage['slug']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Image:</label>
              <img src ="" alt= >
              {{!empty($staticpage['image'])?$staticpage['image']:''}}">
            </div>
          </div>

         <div class="col-md-6">
            <div class="form-group">
              <label>Description :</label>
              <input type="text" class="form-control" placeholder="Enter Description..." name="slug" value="{{!empty($staticpage['description'])?$staticpage['description']:''}}">
            </div>
          </div>
        </div> 
       </div>


        <div class="box-footer">
          <a href="{{url('admin/property')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-property"]' class="btn btn-info pull-right">Submit</button>
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