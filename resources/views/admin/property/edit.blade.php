<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Property</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="edit-property" method="POST" action="{{url('admin/property/'.___encrypt($property['id']))}}">
        {{csrf_field()}}
        <input type="hidden" value="PUT" name="_method">
        <div class="col-md-12">
          <div class="form-group">
            <input type="hidden" id="id" name="id" class="form-control" value="{{!empty($property['id'])?$property['id']:''}}">
          </div>
        </div>
        <div class="form-group">
          <label>Select Category:</label>
          <select class="form-control" name="category_id" id="category_id">
            <option value="">Select Category</option>
            @foreach($category as $categories)
              <option value="{{!empty($categories['id'])?$categories['id']:''}}" @if($categories['id'] == $property['category_id']) selected @endif >{{!empty($categories['name'])?$categories['name']:''}}</option>
            @endforeach
          </select>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Property Name:</label>
              <input type="text" class="form-control" placeholder="Enter Property Name..." name="name" value="{{!empty($property['name'])?$property['name']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Property Slug:</label>
              <input type="text" class="form-control" placeholder="Enter Property Slug..." name="slug" value="{{!empty($property['slug'])?$property['slug']:''}}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Select Property Purpose:</label>
              <select class="form-control" name="property_purpose">
                <option value="">Select Property Purpose</option>
                <option <?php if($property['property_purpose'] == 'sale'){echo("selected");}?>>Sale</option>
                <option <?php if($property['property_purpose'] == 'rent'){echo("selected");}?>>Rent</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Select Property Type:</label>
              <select class="form-control" name="property_type">
                <option value="">Select Property Type</option>
                <option <?php if($property['property_type'] == 'flat'){echo("selected");}?>>Flat</option>
                <option <?php if($property['property_type'] == 'plot'){echo("selected");}?>>Plot</option>
                <option <?php if($property['property_type'] == 'house'){echo("selected");}?>>House</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Property Price:</label>
              <input type="text" class="form-control" placeholder="Enter Property Value..." name="price" value="{{!empty($property['price'])?$property['price']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Property Company:</label>
              <select class="form-control" name="company_id" id="company_id">
                <option value="">Select Company</option>
                @foreach($company as $companies)
                  <option value="{{!empty($companies['id'])?$companies['id']:''}}" @if($companies['id'] == $property['company_id']) selected @endif >{{!empty($companies['name'])?$companies['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="image">Property Featured Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="featured_image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{url('assets/img/properties')}}/{{$property['featured_image']}}" id="adminimg" alt="No Featured Image Added">
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
          <label for="image">Property Gallery Images:</label>
          <div>
            @if(!empty($gallery))
              @foreach($gallery as $images)
                <img style="max-width: 250px;" src="{{url('assets/img/Property Gallery')}}/{{$images['images']}}" id="adminimg">
              @endforeach
            @endif
              <input type="file" id="gallery" accept="image/*" name="gallery[]" multiple/>
              <br>
              <p class="small-label">Multiple Image Allowed</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Bedrooms:</label>
              <select class="form-control" name="bedrooms">
                <option value="">Select Bedrooms</option>
                <option <?php if($property['bedrooms'] == '1'){echo("selected");}?>>1</option>
                <option <?php if($property['bedrooms'] == '2'){echo("selected");}?>>2</option>
                <option <?php if($property['bedrooms'] == '3'){echo("selected");}?>>3</option>
                <option <?php if($property['bedrooms'] == '4'){echo("selected");}?>>4</option>
                <option <?php if($property['bedrooms'] == '5'){echo("selected");}?>>5</option>
                <option <?php if($property['bedrooms'] == '6'){echo("selected");}?>>6</option>
                <option <?php if($property['bedrooms'] == '7'){echo("selected");}?>>7</option>
                <option <?php if($property['bedrooms'] == '8'){echo("selected");}?>>8</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Bathrooms:</label>
              <select class="form-control" name="bathroom">
                <option value="">Select Bathrooms</option>
                <option <?php if($property['bathroom'] == '1'){echo("selected");}?>>1</option>
                <option <?php if($property['bathroom'] == '2'){echo("selected");}?>>2</option>
                <option <?php if($property['bathroom'] == '3'){echo("selected");}?>>3</option>
                <option <?php if($property['bathroom'] == '4'){echo("selected");}?>>4</option>
                <option <?php if($property['bathroom'] == '5'){echo("selected");}?>>5</option>
                <option <?php if($property['bathroom'] == '6'){echo("selected");}?>>6</option>
                <option <?php if($property['bathroom'] == '7'){echo("selected");}?>>7</option>
                <option <?php if($property['bathroom'] == '8'){echo("selected");}?>>8</option>
              </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Garage:</label>
              <select class="form-control" name="garage">
                <option value="">Select Garage</option>
                <option <?php if($property['garage'] == '1'){echo("selected");}?>>1</option>
                <option <?php if($property['garage'] == '2'){echo("selected");}?>>2</option>
                <option <?php if($property['garage'] == '3'){echo("selected");}?>>3</option>
                <option <?php if($property['garage'] == '4'){echo("selected");}?>>4</option>
                <option <?php if($property['garage'] == '5'){echo("selected");}?>>5</option>
                <option <?php if($property['garage'] == '6'){echo("selected");}?>>6</option>
                <option <?php if($property['garage'] == '7'){echo("selected");}?>>7</option>
                <option <?php if($property['garage'] == '8'){echo("selected");}?>>8</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Property Area:</label>
              <input type="text" class="form-control" placeholder="Enter Property Area..." name="area" value="{{!empty($property['area'])?$property['area']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Select Agent:</label>
              <select class="form-control" name="agent_id" id="agent_id">
                <option value="">Select Agent</option>
                @foreach($agent as $agents)
                  <option value="{{!empty($agents['id'])?$agents['id']:''}}" @if($agents['id'] == $property['agent_id']) selected @endif >{{!empty($agents['name'])?$agents['name']:''}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Property Location:</label>
              <input type="text" class="form-control" placeholder="Enter Property Location..." name="location" value="{{!empty($property['location'])?$property['location']:''}}" id="autocomplete">
              <input type="hidden" name="city" id="city" value="{{!empty($property['city'])?$property['city']:''}}">
              <input type="hidden" name="latitude" id="cityLat" value="{{!empty($property['latitude'])?$property['latitude']:''}}">
              <input type="hidden" name="longitude" id="cityLng" value="{{!empty($property['longitude'])?$property['longitude']:''}}">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Pin Code:</label>
              <input type="text" class="form-control" placeholder="Enter Pin Code..." name="pincode" value="{{$property['pincode']}}">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Possession Date:</label>
          <input type="date" class="form-control" name="possession" value="{{$property['possession']}}">
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Property Description:</label>
              <textarea id="description" name="description" rows="6" cols="80">{{!empty($property['description'])?$property['description']:''}}</textarea>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Key Points:</label>
              <textarea id="key_points" name="key_points" rows="6" cols="80">{{!empty($property['key_points'])?$property['key_points']:''}}</textarea>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="checkbox">
            <label>
              @if($property['featured'] == 1)
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