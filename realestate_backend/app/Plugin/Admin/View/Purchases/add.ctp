<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Purchase</div>
        <div class="panel-body">
        <?php echo $this->Form->create('Purchase', array( 'controller' => 'Purchases', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Project:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('project_id',$projectName,array('label' => false,'class'=>'form-control','empty'=>'Please Select','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Seller Name:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Seller Name','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Seller Address:</small></label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>'Seller Address','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Seller Mobile:</small></label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('mobile',array('label' => false,'class'=>'form-control','placeholder'=>'Seller Mobile','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Property Name:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('property_name',array('label' => false,'class'=>'form-control','placeholder'=>'Property Name','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Property Area:</small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('area',array('label' => false,'class'=>'form-control','placeholder'=>'Property Area','div'=>false));?>
                </div>
                <div class="col-sm-2">
		    <?php echo $this->Form->select('unit_id',$unitName,array('label' => false,'class'=>'form-control','empty'=>'Please Select','div'=>false));?>
		</div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Property Amount:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('amount',array('label' => false,'class'=>'form-control','placeholder'=>'Property Amount','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Property Description:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('description',array('label' => false,'class'=>'form-control','placeholder'=>'Property Description','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Remarks:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('remarks', array('label'=>false,'placeholder'=>'Remarks','class'=>'form-control')); ?>
                </div>                                           
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'Purchases','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>