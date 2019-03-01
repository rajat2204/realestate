<div class="container">
    <div class="row">
    <?php echo $this->Session->flash();?>
	<div class="col-md-12">    
	    <div class="panel panel-default mrg">
		<div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Flat/Plots </strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>            
		<div class="panel-body">
		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger">Type</small></strong></td>
				<td><?php echo $post['PropertiesFlat']['type'];?></td>
				<td><strong><small class="text-danger">Property Name</small></strong></td>
				<td><?php echo $post['Property']['name'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Flat/Plot Name</small></strong></td>
				<td><?php echo $post['PropertiesFlat']['name'];?></td>
				<td><strong><small class="text-danger">Floor/Plot No.</small></strong></td>
				<td><?php echo $post['PropertiesFlat']['floor_no'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Area</small></strong></td>
				<td><?php echo $post['PropertiesFlat']['area'].' '.$post['Unit']['name'];?></td>
				<td><strong><small class="text-danger">Amount</small></strong></td>
				<td><?php echo $currency.$this->Number->format($post['PropertiesFlat']['price']);?></td>				
			    </tr>
			    <tr>				
				<td><strong><small class="text-danger">Bedroom</small></strong></td>
				<td><?php echo $post['PropertiesFlat']['bedroom'];?></td>
				<td><strong><small class="text-danger">Bathroom</small></strong></td>
				<td><?php echo $post['PropertiesFlat']['bathroom'];?></td>
			    </tr>
			    <tr>				
				<td><strong><small class="text-danger">Studyroom</small></strong></td>
				<td><?php echo $post['PropertiesFlat']['studyroom'];?></td>
				<td><strong><small class="text-danger">Furnished</small></strong></td>
				<td><?php echo $post['PropertiesFlat']['furnished'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Remarks:</small></strong></td>
				<td colspan="3"><?php echo $post['PropertiesFlat']['remarks'];?></td>
			    </tr>
			</table>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>
