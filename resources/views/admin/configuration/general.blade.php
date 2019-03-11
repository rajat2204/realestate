<div class="content-wrapper">
  <div class="box box-warning">
    <div class="box-body order_b">
    <!-- /.box-header -->
   	<h3 class="h2 dije text-secondary" >Configuration Option</h3>
	   <form role="add-property" method="POST" action="{!!action('Admin\ConfigurationController@general') !!}">
        {{csrf_field()}}
	      <div class="configs">       
	        <div class="form-row ">
	        	<div class="form-group col-md-6">
	        		<label>Site Name</label>
	        		<input type="text"  class="form-control" name="size-name">
	        	</div>
	        	<div class="form-group  col-md-6">
	        		<label>Oraganisation Name</label>
	        		<input type="text" class="form-control" name="oganisation-name"> 		
	        	</div>
	        </div>
	        <div class="form-row ">
	        	<div class="form-group   col-md-6">
	        		<label>Address</label>
	        		<input type="text" class="form-control" name="size-name">
	        	</div>
	        	<div class="form-group  col-md-6">
	        		<label>Account Details</label>
	        		<input type="text" class="form-control" name="oganisation-name"> 		
	        	</div>
	        </div>
	        <div class="form-row ">
	        	<div class="form-group  col-md-6">
	        		<label>Domain Name</label>
	        		<input type="text"  class="form-control" name="size-name">
	        	</div>
	        	<div class="form-group  col-md-6">
	        		<label>Organisation Email</label>
	        		<input type="text"  class="form-control" name="size-name">
	        	</div>
	        </div>
	        <div class="form-row ">
	        	<div class="form-group  col-md-6">
	        		<label>Meta title</label>
	        		<input type="text"  class="form-control" name="size-name">
	        	</div>
	        	<div class="form-group  col-md-6">
	        		<label>Meta Descriotion</label>
	        		<input type="text" class="form-control" name="oganisation-name"> 		
	        	</div>
    		</div>
	        <div class="form-row ">
	        	<div class="form-group  col-md-6">
	        		<label>Time zone</label>
	        		<input type="text"class="form-control" name="size-name">
	        	</div>
	        	<div class="form-group  col-md-6">
	        		<label>Currency</label>
	        		<input type="text" class="form-control"  name="oganisation-name"> 		
	        	</div>
	        </div>
	        <div class="form-row ">
	        	<div class="form-group   col-md-6">
	        		<label>Date format</label>
	        		<input type="text" class="form-control" name="size-name">
	        	</div>
	        	<div class="form-group col-md-6">
 	        		<label> </label>
	    	   		<input type="text"  class="form-control " disabled name="size-name"
	    	   		placeholder="Date, Month, Year, Hour, Min, Sec, Meridian, Date Seprator, Time Seprator">
	        	</div>
	        </div>
	        <div class="form-row ">
	        	<div class="form-group   col-md-6">
	        		<label>Short Name</label>
	        		<input type="text" class="form-control" name="short-name">
	        	</div>
	        	<div class="form-group col-md-6">
	        		<label>Contact Number</label>
	        		<input type="text" class="form-control" name="contact">
	        	</div>
	        </div>
 	        <div class="form-row ">
	        	<div class="form-group  col-md-6">
	        		<label>Due Days</label>
	        		<input type="text" class="form-control" name="duedays">
	        	</div>
	        	<div class="form-group col-md-6">
	        		<label>Last Fees</label>
	        		<input type="text" class="form-control" name="lastfees">
	        	</div>
	        </div>
	        <div class="form-row">
	        	<div class="form-group col-md-12">
	        		<input type="checkbox" class="form-control " name=" email-notify" value= "Email Notification">
	        		<input type="checkbox" class="form-control " name=" sms-notify" value= "Sms Notification">
	        		<input type="checkbox" class="form-control " name=" tanslation-notify" value= "Translation Notification">
	        	</div>
	        </div>	
        <div class="box-footer">
          <a href="{{url('admin/property')}}" class="btn btn-default">Cancel</a>
          <button type="button" data-request="ajax-submit" data-target='[role="add-property"]' class="btn btn-info pull-right">Submit</button>
        </div>
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