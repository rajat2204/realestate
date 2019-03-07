<div class="content-wrapper">
  <div class="box box-light">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Wallet</h3>
	</div>

	 <div class="box-body ">
     	<div class class="col-md-12">
     	</div>
     	<div class="col-md-3">
     	</div>
     	<div class= "col-md-7">

     	  <h3 class= "h3 text-danger text-center mb-4">Transacation Form</h3>
     	  <form role="wallet-agent" method="POST"  class ="pisi" action="{{url('admin/agent/'.___encrypt($agent['id']))}}">
        	{{csrf_field()}}		
	        <div class="form-group">
 	           <label class= "text-dark">Email :</label>
    	        <label name="email" class="ml-3">{{!empty($agent['email'])?$agent['email']:''}}
    	        </label>
          	</div>
		     <div class="form-group">
            	<label class= "text-dark">Name :</label>
    	        <label name="name" class="ml-3">{{!empty($agent['name'])?$agent['name']:''}}
    	        </label>
          	</div> 
          	<div class="form-group">
                <label class= "text-dark"> Mobile :</label>
				<label name="mobile" class="ml-3"> {{!empty($agent['mobile'])?$agent['mobile']:''}}
				</label>
            </div>
            <div class="form-group">
                <label class= "text-dark">Balance :</label>
				<label name="balance" class="ml-3"> 
				</label>
            </div>   
            <div class="form-group">
       	       <label class= "text-dark">Amount :</label>
				<input type = text class="form-control" value ="" placeholder=" Enter amount" >
		    </div>   
			<div class="form-group">
       	      <label class= "text-dark">Action :</label>
		    	<select class="form-control">
					<option value="">--Select--</option>
					<option value="add">Add</option>
					<option value="deduct">Deduct</option>
				</select>
			</div>
			<div class="form-group">
       	      <label class= "text-dark">Remarks :</label>
	    	  <textarea value ="" placeholder="Write if any" class="form-control"></textarea>
            </div> 
            <div class="box-footer">
    	      	<a href="{{url('admin/agent')}}" class="btn btn-default">Cancel</a>
        	  	<button type="button" data-request="ajax-submit" data-target='[role="wallet-agent"]' class="btn btn-info pull-right">Update</button>
	        </div>	
         
          </form>       	
     	</div>
     	<div class="col-md-2">
     	</div>
   	</div> 
   
   </div>
 </div>
