<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Property</div>
        <div class="panel-body">
        <?php echo $this->Form->create('Property', array( 'controller' => 'Properties', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Project:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('project_id',$projectName,array('label' => false,'class'=>'form-control','empty'=>'Please Select','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Property Name:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Property Name','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Type:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('type',array('type'=>'radio','options'=>array("Commercial"=>"Commercial","Residential"=>"Residential"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false,'class'=>''));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Availiable For:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('availiable',array('type'=>'radio','options'=>array("Sale"=>"Sale","Rent"=>"Rent"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false,'class'=>''));?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Comment/Remarks:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('remarks',array('label' => false,'class'=>'form-control','placeholder'=>'Comment/Remarks','div'=>false));?>
                </div>
            </div> 
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Add Photo:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('Pr.PropertiesPhoto.', array('type' => 'file','label'=>false,'multiple'=>'multiple','class'=>'')); ?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Add Document:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('Pr.PropertiesDocument.', array('type' => 'file','label'=>false,'multiple'=>'multiple','class'=>'')); ?>
                </div>
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-7">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
            <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'Properties','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>