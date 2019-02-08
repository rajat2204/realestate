<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Project</div>
        <div class="panel-body">
        <?php echo $this->Form->create('Project', array( 'controller' => 'Projects', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Project Name:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Project Name','div'=>false));?>
                </div>
            </div>            
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small>City:</small></label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('city',array('label' => false,'class'=>'form-control','placeholder'=>'City','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>State:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('state',array('label' => false,'class'=>'form-control','placeholder'=>'State','div'=>false));?>
                </div>
            </div>
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small>Address:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>'Address','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Nearest Location:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('nearest_location',array('label' => false,'class'=>'form-control','placeholder'=>'Nearest Location','div'=>false));?>
                </div>
            </div>
	    <div class="form-group">   
		<label for="group_name" class="col-sm-2 control-label"><small>How to reach:</small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('reach',array('label' => false,'class'=>'form-control','placeholder'=>'How to reach','div'=>false));?>
		</div>
		<label for="group_name" class="col-sm-2 control-label"><small>Why purchase:</small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('purchase',array('label' => false,'class'=>'form-control','placeholder'=>'Why purchase','div'=>false));?>
		</div>
	    </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Description:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('description',array('label' => false,'class'=>'form-control','placeholder'=>'Description','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Add Photo:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('Pr.ProjectsPhoto.', array('type' => 'file','label'=>false,'multiple'=>'multiple','class'=>'')); ?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Add Layout Plan:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('Pr.ProjectsLayoutplan.', array('type' => 'file','label'=>false,'multiple'=>'multiple','class'=>'')); ?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Add Location Map:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('Pr.ProjectsLocationmap.', array('type' => 'file','label'=>false,'multiple'=>'multiple','class'=>'')); ?>
                </div>
            </div>            
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'Projects','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>