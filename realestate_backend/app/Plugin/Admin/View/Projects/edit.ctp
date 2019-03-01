<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        });
</script>
<div class="container">
<div class="row">
<?php echo $this->Session->flash();?>
    <div class="col-md-12">
        <div class="panel panel-default mrg">
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Edit <span>Projects</span></h4><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div></div>
                <div class="panel-body">
					<?php echo $this->Form->create('Project', array( 'controller' => 'Projects','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Project as $k=>$post): $id=$post['Project']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger">Form <?php echo$form_no?></small></strong></div>
		  <div class="panel-body">
		    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Project Name:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Project.name",array('label' => false,'class'=>'form-control','placeholder'=>'Project Name','div'=>false));?>
                </div>
            </div>            
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small>City:</small></label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input("$k.Project.city",array('label' => false,'class'=>'form-control','placeholder'=>'City','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>State:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Project.state",array('label' => false,'class'=>'form-control','placeholder'=>'State','div'=>false));?>
                </div>
            </div>
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small>Address:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Project.address",array('label' => false,'class'=>'form-control','placeholder'=>'Address','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Nearest Location:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Project.nearest_location",array('label' => false,'class'=>'form-control','placeholder'=>'Nearest Location','div'=>false));?>
                </div>
            </div>
	    <div class="form-group">   
		<label for="group_name" class="col-sm-2 control-label"><small>How to reach:</small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input("$k.Project.reach",array('label' => false,'class'=>'form-control','placeholder'=>'How to reach','div'=>false));?>
		</div>
		<label for="group_name" class="col-sm-2 control-label"><small>Why purchase:</small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input("$k.Project.purchase",array('label' => false,'class'=>'form-control','placeholder'=>'Why purchase','div'=>false));?>
		</div>
	    </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Description:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Project.description",array('label' => false,'class'=>'form-control','placeholder'=>'Description','div'=>false));?>
                </div>               
            </div>		    
		      <div class="form-group text-left">
			  <div class="col-sm-offset-4 col-sm-6">
			      <?php echo $this->Form->input("$k.Project.id",array('type' => 'hidden'));?>
			  </div>
		      </div>
		  </div>
		</div>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> Update</button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>