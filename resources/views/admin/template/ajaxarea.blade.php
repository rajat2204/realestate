<div class="col-md-3">
	<div class="flex-c">
	  <div class="form-group m-r-10">
	    <label>Area:</label>
	    <input type="text" name="area" class="form-control" placeholder="Enter Area..." disabled id="area" value="$area->area">
	  </div>
	  <div class="form-group">
	    <label>Units:</label>
	    <input type="text" name="unit_name" id="unit_name" placeholder="Enter Unit" disabled class="form-control">
	  </div>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	  <label>Amount:</label>
	  <input type="text" name="amount" class="form-control" disabled placeholder="Enter Amount..." id="amount" value="{{$area->price}}">
	</div>
</div>