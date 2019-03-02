<select class="form-control" name="properties">
  <option value=" ">Select Property</option>
  @foreach($property as $properties)
      <option value="{{$properties->id}}">{{!empty($properties->name)?$properties->name:''}}</option>
  @endforeach
</select>