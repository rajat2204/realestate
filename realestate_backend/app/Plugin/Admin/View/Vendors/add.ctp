    <div class="col-md-12">
        <?php echo $this->Session->flash();?>
        <div class="panel panel-default">
            <div class="panel-heading">Add Vendors / Staff</div>
            <div class="panel-body">
            <?php echo $this->Form->create('Vendor', array( 'controller' => 'Vendors', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                <div class="form-group">
                    <label for="group_name" class="col-sm-4 control-label"><small>Name:</small></label>
                    <div class="col-sm-6">
                       <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Name','div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-4 control-label"><small>Address:</small></label>
                    <div class="col-sm-6">
                       <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>'Address','div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-4 control-label"><small>Contact:</small></label>
                    <div class="col-sm-6">
                       <?php echo $this->Form->input('contact',array('label' => false,'class'=>'form-control','placeholder'=>'Contact','div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-4 control-label"><small>Licence No.:</small></label>
                    <div class="col-sm-6">
                       <?php echo $this->Form->input('licence_no',array('label' => false,'class'=>'form-control','placeholder'=>'Licence No.','div'=>false));?>
                    </div>
                </div>
                <div class="form-group text-left">
                    <div class="col-sm-offset-4 col-sm-6">
                        <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'Vendors','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>