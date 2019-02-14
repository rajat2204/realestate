<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Agent</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-agent" method="POST" action="{{url('admin/agent/'.___encrypt($agent['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($agent['id'])?$agent['id']:''}}">
          </div>
        </div>

        <div class="form-group">
          <label>Agent Name:</label>
          <input type="text" class="form-control" placeholder="Enter Agents Name..." name="name" value="{{$agent['name']}}">
        </div>

        <div class="form-group">
          <label for="image">Agent's Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{url('assets/img/agent')}}/{{$agent['image']}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label>Agent's Designation:</label>
          <input type="text" class="form-control" placeholder="Enter Designation..." name="designation" value="{{$agent['designation']}}">
        </div>

        <div class="box-footer">
          <a href="{{url('admin/agent')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-agent"]' class="btn btn-info pull-right">Submit</button>
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

</script>
@endsection