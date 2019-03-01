    <div class="row">
    <?php echo $this->Session->flash();?>
	<div class="col-md-12">    
	    <div class="panel panel-default mrg">
		<div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">My <span>Profile</span></strong></h4></div></div>
		<div class="panel-body">
		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger">Name</small></strong></td>
				<td><?php echo h($post['MyProfile']['name']);?></td>
				<td><strong><small class="text-danger">Contact Number</small></strong></td>
				<td><?php echo h($post['MyProfile']['phone']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Alternate Number</small></strong></td>
				<td><?php echo h($post['MyProfile']['alternate']);?></td>
				<td><strong><small class="text-danger">Email</small></strong></td>
				<td><?php echo h($post['MyProfile']['email']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Refered By</small></strong></td>
				<td><?php echo h($post['MyProfile']['refered']);?></td>
				<td><strong><small class="text-danger">Location</small></strong></td>
				<td><?php echo h($post['MyProfile']['location']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Address</small></strong></td>
				<td colspan="3"><?php echo h($post['MyProfile']['address']);?></td>				
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Bank Details</small></strong></td>
				<td colspan="3"><?php echo h($post['MyProfile']['bank_details']);?></td>				
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Remarks/Notes</small></strong></td>
				<td colspan="3"><?php echo h($post['MyProfile']['remarks']);?></td>				
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Last Login</small></strong></td>
				<td colspan="3"><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$timeSep.$sysSec.$dateGap.$sysMer,$post['MyProfile']['last_login']);?></td>				
			    </tr>
			</table>
		    </div>
		</div>
	    </div>
	</div>
    </div>