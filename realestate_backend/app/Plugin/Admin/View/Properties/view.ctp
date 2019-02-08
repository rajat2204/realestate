<div class="container">
    <div class="row">
    <?php echo $this->Session->flash();?>
	<div class="col-md-12">    
	    <div class="panel panel-default mrg">
		<div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Property <span>Details</span></strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>            
		<div class="panel-body">
		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger">Project</small></strong></td>
				<td><?php echo $post['Project']['name'];?></td>
				<td><strong><small class="text-danger">Property Name</small></strong></td>
				<td><?php echo $post['Property']['name'];?></td>
			    </tr>
			    <tr>				
				<td><strong><small class="text-danger">Type</small></strong></td>
				<td><?php echo $post['Property']['type'];?></td>
				<td><strong><small class="text-danger">Availiable For</small></strong></td>
				<td><?php echo $post['Property']['availiable'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Comment/Remarks</small></strong></td>
				<td colspan="3"><?php echo $post['Property']['remarks'];?></td>
			    </tr>
			</table>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>
