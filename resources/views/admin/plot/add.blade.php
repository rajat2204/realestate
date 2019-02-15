<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Add Plot</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form role="add-plot" method="POST" action="{!! action('Admin\PlotController@store') !!}">
        {{csrf_field()}}

        <div class="form-group">
          <label>Select Category:</label>
          <select class="form-control" name="category_id" id="category_id">
            <option value="">Select Category</option>
            @foreach($category as $categories)
              <option value="{{!empty($categories->id)?$categories->id:''}}">{{!empty($categories->name)?$categories->name:''}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Plot Name:</label>
          <input type="text" class="form-control" placeholder="Enter Plot Name..." name="name">
        </div>

        <div class="form-group">
          <label>Plot Slug:</label>
          <input type="text" class="form-control" placeholder="Enter Plot Slug..." name="slug">
        </div>

        <div class="form-group">
          <label>Plot Price:</label>
          <input type="text" class="form-control" placeholder="Enter Plot Value..." name="price">
        </div>

        <div class="form-group">
          <label for="image">Plot Featured Image:</label>
          <div>
              <input onchange="readURL(this)" id="uploadFile" accept="image/*" name="featured_image" type="file">
          </div>
          <div>
            <img style="max-width: 250px;" src="{{asset('assets/img/avatar.png')}}" id="adminimg" alt="No Featured Image Added">
          </div>
        </div>

        <div class="form-group">
          <label for="image">Plot Gallery Images:</label>
          <div>
              <input type="file" id="gallery" accept="image/*" name="gallery[]" multiple/>
              <br>
              <p class="small-label">Multiple Image Allowed</p>
          </div>
        </div>

        <div class="form-group">
          <label>Select Plot Type:</label>
          <select class="form-control" name="property_type">
            <option value="">Select Plot Type</option>
            <option value="sale">Sale</option>
            <option value="rent">Rent</option>
          </select>
        </div>

        <div class="form-group">
          <label>Bedrooms:</label>
          <select class="form-control" name="bedrooms">
            <option value="">Select Bedrooms</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
          </select>
        </div>

        <div class="form-group">
          <label>Bathrooms:</label>
          <select class="form-control" name="bathroom">
            <option value="">Select Bathrooms</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
          </select>
        </div>

        <div class="form-group">
          <label>Garage:</label>
          <select class="form-control" name="garage">
            <option value="">Select Garage</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
          </select>
        </div>

        <div class="form-group">
          <label>Plot Area:</label>
          <input type="text" class="form-control" placeholder="Enter Plot Area..." name="area">
        </div>

        <div class="form-group">
          <label>Plot Location:</label>
          <input type="text" class="form-control" placeholder="Enter Plot Location..." name="location" id="autocomplete">
          <input type="hidden" name="city" id="city">
          <input type="hidden" name="latitude" id="cityLat">
          <input type="hidden" name="longitude" id="cityLng">
        </div>

        <div class="form-group">
          <label>Select Agent:</label>
          <select class="form-control" name="agent_id" id="agent_id">
            <option value="">Select Agent</option>
            @foreach($agent as $agents)
              <option value="{{!empty($agents->id)?$agents->id:''}}">{{!empty($agents->name)?$agents->name:''}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Plot Description:</label>
          <textarea id="description" name="description" rows="6" cols="80"></textarea>
        </div>

        <div class="form-group">
          <label>Key Points:</label>
          <textarea id="key_points" name="key_points" rows="6" cols="80"></textarea>
        </div>

        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="featured" value="1" id="id">
              Add to featured Properties
            </label>
          </div>
        </div>

        <div class="box-footer">
          <a href="{{url('admin/plot')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-plot"]' class="btn btn-info pull-right">Submit</button>
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