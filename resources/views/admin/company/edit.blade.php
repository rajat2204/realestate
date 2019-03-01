<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Company</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-company" method="POST" action="{{url('admin/company/'.___encrypt($company['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($company['id'])?$company['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>Company Name:</label>
          <input type="text" class="form-control" placeholder="Enter Category Name..." name="name" value="{{!empty($company['name'])?$company['name']:''}}">
        </div>

        <div class="form-group">
          <label>Company's Slug:</label>
          <input type="text" class="form-control" placeholder="Enter Company Slug..." name="slug" value="{{!empty($company['slug'])?$company['slug']:''}}">
        </div>

        <div class="form-group">
          <label for="image">Company's Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{url('assets/img/Company')}}/{{$company['image']}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label>Description:</label>
          <textarea id="description" name="description" rows="6" cols="80">{{!empty($company['description'])?$company['description']:''}}</textarea>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/company')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-company"]' class="btn btn-info pull-right">Submit</button>
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