<div class="container">
    <div class="row">
    <?php echo $this->Session->flash();?>
	<div class="col-md-12">    
	    <div class="panel panel-default mrg">
		<div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Email <span>Template</span></strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>            
		<div class="panel-body">
		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger">Name</small></strong></td>
				<td><?php echo $post['Emailtemplate']['name'];?></td>
			    </tr>
			     <tr>
				<td><strong><small class="text-danger">Template</small></strong></td>
				<td><?php echo $post['Emailtemplate']['description'];?></td>
			    </tr>			    
			</table>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>
