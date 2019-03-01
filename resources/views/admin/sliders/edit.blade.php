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

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Slider Title:</label>
              <input type="text" class="form-control" placeholder="Enter Slider Title..." name="title" value="{{!empty($slider['title'])?$slider['title']:''}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Slider Slug:</label>
              <input type="text" class="form-control" placeholder="Enter Slider Slug..." name="slug" value="{{!empty($slider['slug'])?$slider['slug']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Select Slider Position:</label>
              <select class="form-control" name="position"  id="position">
                <option value="">Select Slider Position</option>
                <option value="left" <?php if($slider['position'] == 'left'){echo("selected");}?>>Left</option>
                <option value="right" <?php if($slider['position'] == 'right'){echo("selected");}?>>Right</option>
                <option value="center" <?php if($slider['position'] == 'center'){echo("selected");}?>>Center</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            @if($slider['position'] != 'center')
              <div class="form-group" id="number">
                <label>Contact Number:</label>
                <input type="text" class="form-control" placeholder="Enter Contact Number..." name="mobile" value="{{!empty($slider['mobile'])?$slider['mobile']:''}}">
              </div>
            @else
              <div class="form-group" id="number" style="display: none;">
                <label>Contact Number:</label>
                <input type="text" class="form-control" placeholder="Enter Contact Number..." name="mobile" value="{{!empty($slider['mobile'])?$slider['mobile']:''}}">
              </div>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label>Location:</label>
          <input type="text" class="form-control" placeholder="Enter Location..." name="location" id="autocomplete" value="{{!empty($slider['location'])?$slider['location']:''}}">
          <input type="hidden" name="city" id="city" value="{{!empty($slider['city'])?$slider['city']:''}}">
          <input type="hidden" name="latitude" id="cityLat" value="{{!empty($slider['latitude'])?$slider['latitude']:''}}">
          <input type="hidden" name="longitude" id="cityLng" value="{{!empty($slider['longitude'])?$slider['longitude']:''}}">
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

  $(document).ready(function(){
    $('#position').on('change', function () {
       if ( this.value == 'center')
        {
          $("#number").hide();
        }
        else
        {
          $("#number").show();
        }
     });
  });
</script>
@endsection