<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Extra payments</div>
        <div class="panel-body">
        <?php echo $this->Form->create('Etcpayment', array( 'controller' => 'Etcpayments', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Payment Due on:</small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Payment Due on','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Short Name:</small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('short',array('label' => false,'class'=>'form-control','placeholder'=>'Short Name','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Unit:</small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->select('unit_id',$unitOption,array('label' => false,'class'=>'form-control','empty'=>'Select','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Price:</small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('rate',array('label' => false,'class'=>'form-control','placeholder'=>'Price','div'=>false));?>
                </div>
            </div>
                <div class="form-group text-left">
                <div class="col-sm-offset-4 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'Etcpayments','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>