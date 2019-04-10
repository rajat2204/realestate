<select class="form-control" name="tax_percent_id" id="tax_percent_id">
	<option value="">Select Tax Percentage</option>
	@foreach($tax as $taxes)
      <option value="{{$taxes->id}}">{{!empty($taxes->percentage)?$taxes->percentage:''}}</option>
  	@endforeach
</select>