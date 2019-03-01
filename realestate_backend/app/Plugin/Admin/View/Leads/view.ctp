<div class="container">
    <div class="row">
    <?php echo $this->Session->flash();?>
	<div class="col-md-12">    
	    <div class="panel panel-default mrg">
		<div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">My Lead <span>Details</span></strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>            
		<div class="panel-body">
		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger">Client Name</small></strong></td>
				<td><?php echo h($post['Lead']['name']);?></td>
				<td><strong><small class="text-danger">Address</small></strong></td>
				<td><?php echo h($post['Lead']['address']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Email</small></strong></td>
				<td><?php echo h($post['Lead']['email']);?></td>
				<td><strong><small class="text-danger">Phone No.</small></strong></td>
				<td><?php echo h($post['Lead']['phone']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Property Name</small></strong></td>
				<td><?php echo h($post['Property']['name']);?></td>
				<td><strong><small class="text-danger">Type</small></strong></td>
				<td><?php echo h($post['Property']['type']);?>
				<strong><small>Availiable For</small></strong>
				<?php echo h($post['Property']['availiable']);?>
				</td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Follow Up</small></strong></td>
				<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,h($post['Lead']['follow_up']));?></td>
				<td><strong><small class="text-danger">Status</small></strong></td>
				<td><span class="label label-<?php if(h($post['Lead']['status'])=="Awaiting/Closed")echo"success";elseif(h($post['Lead']['status'])=="Cancelled")echo"danger";else echo"warning";?>"><?php echo h($post['Lead']['status']);?></span></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Comments/Remarks</small></strong></td>
				<td colspan="3"><?php echo h($post['Lead']['remarks']);?></td>				
			    </tr>			   
			</table>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>
