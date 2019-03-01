<div class="container">
    <div class="row">
    <?php echo $this->Session->flash();?>
	<div class="col-md-12">    
	    <div class="panel panel-default mrg">
		<div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">My Deal <span>Details</span></strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>            
		<div class="panel-body">
		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger">Client Name</small></strong></td>
				<td><?php echo h($post['Client']['name']);?></td>
				<td><strong><small class="text-danger">Property Name</small></strong></td>
				<td><?php echo h($post['Property']['name']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Type</small></strong></td>
				<td><?php echo h($post['Property']['type']);?></td>
				<td><strong><small class="text-danger">Availiable For</small></strong></td>
				<td><?php echo h($post['Property']['availiable']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Flat/Plot</small></strong></td>
				<td><?php echo h($post['PropertiesFlat']['name']);?></td>
				<td><strong><small class="text-danger">Floor/Plot No.</small></strong></td>
				<td><?php echo h($post['PropertiesFlat']['floor_no']);?></td>				
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Payment Plan</small></strong></td>
				<td><?php echo h($post['Plan']['name']);?></td>	
				<td><strong><small class="text-danger">Agent</small></strong></td>
				<td><?php echo h($post['Agent']['name']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Invoice Date</small></strong></td>
				<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['Deal']['date']));?></td>
				<td><strong><small class="text-danger">Area</small></strong></td>
				<td><?php echo $post['PropertiesFlat']['area'].' '.h($post['Unit']['name']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Amount</small></strong></td>
				<td><?php echo$currency.$this->Number->format($post['PropertiesFlat']['price']);?></td>
				<td><strong><small class="text-danger">Discount </small></strong></td>
				<td><?php echo$currency.$this->Number->format($post['Deal']['discount']);?></td>
			    </tr>
			    <tr>
				
				<td><strong><small class="text-danger">Total Amount</small></strong></td>
				<td><?php echo$currency.$this->Number->format($post['Deal']['total_amount']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger">Comments/Remarks</small></strong></td>
				<td colspan="3"><?php echo h($post['Deal']['remarks']);?></td>				
			    </tr>			   
			</table>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>
