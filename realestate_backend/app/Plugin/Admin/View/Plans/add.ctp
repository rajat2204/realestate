<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Plans</div>
        <div class="panel-body">
        <?php echo $this->Form->create('Plan', array( 'controller' => 'Plans', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
           <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Plan Name:</small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Name','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Installment:</small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('installment',array('label' => false,'class'=>'form-control','placeholder'=>'Installment','div'=>false));?>
                </div>
            </div>
                <div class="form-group text-left">
                <div class="col-sm-offset-4 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'Plans','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>