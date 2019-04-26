<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Project</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-project" method="POST" action="{!! action('Admin\ProjectController@store') !!}">
        {{csrf_field()}}

        <div class="form-group">
          <label>Company Name:</label>
          <select class="form-control" name="company_id" id="company_id">
            <option value="">Company Name</option>
            @foreach($company as $companies)
              <option value="{{!empty($companies['id'])?$companies['id']:''}}">{{!empty($companies['name'])?$companies['name']:''}}</option>
            @endforeach
          </select>
        </div>

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

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Location:</label>
              <input type="text" class="form-control" placeholder="Enter Location..." name="location" id="autocomplete">
              <input type="hidden" name="city" id="city">
              <input type="hidden" name="latitude" id="cityLat">
              <input type="hidden" name="longitude" id="cityLng">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Nearest Location:</label>
              <input type="text" class="form-control" placeholder="Enter Nearest Location..." name="nearest_location">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Project Image:</label>
              <div>
                <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="image" type="file">
                <span class="image-size">File Size(358X220 pixels)</span>
              </div>
              <div>
                <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="adminimg" alt="No Featured Image Added">
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Project Layout Plan:</label>
              <div>
                  <input onchange="readURLLayout(this)" id="layoutplan" accept="image/*" name="layout" type="file">
                  <span class="image-size">File Size(358X220 pixels)</span>
              </div>
              <div>
                <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="layoutimg" alt="No Featured Image Added">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Project Location Map:</label>
              <div>
                  <input onchange="readURLLocation(this)" id="locationmap" accept="image/*" name="locationmap" type="file">
                  <span class="image-size">File Size(358X220 pixels)</span>
              </div>
              <div>
                <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="mapimg" alt="No Featured Image Added">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>How to reach:</label>
              <textarea id="reach" name="reach" rows="6" cols="80"></textarea>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Why Purchase:</label>
              <textarea id="purchase" name="purchase" rows="6" cols="80"></textarea>
            </div>
          </div>
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
    function readURLLayout(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#layoutimg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    function readURLLocation(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#mapimg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    CKEDITOR.replace("reach");
    CKEDITOR.replace("purchase");
    CKEDITOR.replace("description");
</script>
@endsection