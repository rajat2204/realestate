<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Plot</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-plot" method="POST" action="{{url('admin/plot/'.___encrypt($plot['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($plot['id'])?$plot['id']:''}}">
          </div>
        </div>
        <div class="form-group">
          <label>Select Category:</label>
          <select class="form-control" name="category_id" id="category_id">
            <option value="">Select Category</option>
            @foreach($category as $categories)
              <option value="{{!empty($categories['id'])?$categories['id']:''}}" @if($categories['id'] == $plot['category_id']) selected @endif >{{!empty($categories['name'])?$categories['name']:''}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Plot Name:</label>
          <input type="text" class="form-control" placeholder="Enter Plot Name..." name="name" value="{{!empty($plot['name'])?$plot['name']:''}}">
        </div>

        <div class="form-group">
          <label>Plot Slug:</label>
          <input type="text" class="form-control" placeholder="Enter Plot Slug..." name="slug" value="{{!empty($plot['slug'])?$plot['slug']:''}}">
        </div>

        <div class="form-group">
          <label>Plot Price:</label>
          <input type="text" class="form-control" placeholder="Enter Plot Value..." name="price" value="{{!empty($plot['price'])?$plot['price']:''}}">
        </div>

        <div class="form-group">
          <label for="image">Plot Featured Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="featured_image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{url('assets/img/plots')}}/{{$plot['featured_image']}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
            <div>
                <div class="checkbox">
                    <label><input type="checkbox" name="galdel" value="1"/>
                        Delete Old Gallery Images</label>
                </div>
            </div>
        </div>

        <div class="form-group">
          <label for="image">Plot Gallery Images:</label>
          <div>
            @if(!empty($gallery))
              @foreach($gallery as $images)
                <img style="max-width: 250px;" src="{{url('assets/img/Plot Gallery')}}/{{$images['images']}}" id="adminimg">
              @endforeach
            @endif
              <input type="file" id="gallery" accept="image/*" name="gallery[]" multiple/>
              <br>
              <p class="small-label">Multiple Image Allowed</p>
          </div>
        </div>

        <div class="form-group">
          <label>Select Plot Type:</label>
          <select class="form-control" name="property_type">
            <option value="">Select Plot Type</option>
            <option <?php if($plot['property_type'] == 'sale'){echo("selected");}?>>sale</option>
            <option <?php if($plot['property_type'] == 'rent'){echo("selected");}?>>rent</option>
          </select>
        </div>

        <div class="form-group">
          <label>Bedrooms:</label>
          <select class="form-control" name="bedrooms">
            <option value="">Select Bedrooms</option>
            <option <?php if($plot['bedrooms'] == '1'){echo("selected");}?>>1</option>
            <option <?php if($plot['bedrooms'] == '2'){echo("selected");}?>>2</option>
            <option <?php if($plot['bedrooms'] == '3'){echo("selected");}?>>3</option>
            <option <?php if($plot['bedrooms'] == '4'){echo("selected");}?>>4</option>
            <option <?php if($plot['bedrooms'] == '5'){echo("selected");}?>>5</option>
            <option <?php if($plot['bedrooms'] == '6'){echo("selected");}?>>6</option>
            <option <?php if($plot['bedrooms'] == '7'){echo("selected");}?>>7</option>
            <option <?php if($plot['bedrooms'] == '8'){echo("selected");}?>>8</option>
          </select>
        </div>

        <div class="form-group">
          <label>Bathrooms:</label>
          <select class="form-control" name="bathroom">
            <option value="">Select Bathrooms</option>
            <option <?php if($plot['bathroom'] == '1'){echo("selected");}?>>1</option>
            <option <?php if($plot['bathroom'] == '2'){echo("selected");}?>>2</option>
            <option <?php if($plot['bathroom'] == '3'){echo("selected");}?>>3</option>
            <option <?php if($plot['bathroom'] == '4'){echo("selected");}?>>4</option>
            <option <?php if($plot['bathroom'] == '5'){echo("selected");}?>>5</option>
            <option <?php if($plot['bathroom'] == '6'){echo("selected");}?>>6</option>
            <option <?php if($plot['bathroom'] == '7'){echo("selected");}?>>7</option>
            <option <?php if($plot['bathroom'] == '8'){echo("selected");}?>>8</option>
          </select>
        </div>

        <div class="form-group">
          <label>Garage:</label>
          <select class="form-control" name="garage">
            <option value="">Select Garage</option>
            <option <?php if($plot['garage'] == '1'){echo("selected");}?>>1</option>
            <option <?php if($plot['garage'] == '2'){echo("selected");}?>>2</option>
            <option <?php if($plot['garage'] == '3'){echo("selected");}?>>3</option>
            <option <?php if($plot['garage'] == '4'){echo("selected");}?>>4</option>
            <option <?php if($plot['garage'] == '5'){echo("selected");}?>>5</option>
            <option <?php if($plot['garage'] == '6'){echo("selected");}?>>6</option>
            <option <?php if($plot['garage'] == '7'){echo("selected");}?>>7</option>
            <option <?php if($plot['garage'] == '8'){echo("selected");}?>>8</option>
          </select>
        </div>

        <div class="form-group">
          <label>Plot Area:</label>
          <input type="text" class="form-control" placeholder="Enter Plot Area..." name="area" value="{{!empty($plot['area'])?$plot['area']:''}}">
        </div>

        <div class="form-group">
          <label>Plot Location:</label>
          <input type="text" class="form-control" placeholder="Enter Plot Location..." name="location" value="{{!empty($plot['location'])?$plot['location']:''}}" id="autocomplete">
          <input type="hidden" name="city" id="city" value="{{!empty($plot['city'])?$plot['city']:''}}">
          <input type="hidden" name="latitude" id="cityLat" value="{{!empty($plot['latitude'])?$plot['latitude']:''}}">
          <input type="hidden" name="longitude" id="cityLng" value="{{!empty($plot['longitude'])?$plot['longitude']:''}}">
        </div>

        <div class="form-group">
          <label>Select Agent:</label>
          <select class="form-control" name="agent_id" id="agent_id">
            <option value="">Select Agent</option>
            @foreach($agent as $agents)
              <option value="{{!empty($agents['id'])?$agents['id']:''}}" @if($agents['id'] == $plot['agent_id']) selected @endif >{{!empty($agents['name'])?$agents['name']:''}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Plot Description:</label>
          <textarea id="description" name="description" rows="6" cols="80">{{!empty($plot['description'])?$plot['description']:''}}</textarea>
        </div>

        <div class="form-group">
          <label>Key Points:</label>
          <textarea id="key_points" name="key_points" rows="6" cols="80">{{!empty($plot['key_points'])?$plot['key_points']:''}}</textarea>
        </div>

        <div class="form-group">
          <div class="checkbox">
            <label>
              @if($plot['featured'] == 1)
                <input type="checkbox" name="featured" value="1" id="id" checked>
                Add to featured Properties
            </label>
              @else
                <label>
                  <input type="checkbox" name="featured" value="1" autocomplete="off">
                  Add to featured Properties
                </label>
                @endif
          </div>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/plot')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="edit-plot"]' class="btn btn-info pull-right">Submit</button>
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