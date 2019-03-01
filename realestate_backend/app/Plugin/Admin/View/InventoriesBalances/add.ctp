<script type="text/javascript">
    $(document).ready(function(){
        $('#paymentDate').datetimepicker({format:'<?php echo $dpFormat;?>'});
        });
</script>
<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Entry</div>
        <div class="panel-body">
        <?php echo $this->Form->create('InventoriesBalance', array( 'controller' => 'InventoriesBalances', 'action' => "add/$inventoryId",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Quantity:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('qty', array('label'=>false,'placeholder'=>'Quantity','class'=>'form-control')); ?>
                </div>
            </div>
           <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Date:</small></label>
                <div class="col-sm-4">
                   <div class="input-group date" id="paymentDate">                        
                    <?php echo $this->Form->input('date',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>'Payment Date','div'=>false,'default'=>$date));?>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                </div>                                           
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Remarks:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('remarks', array('label'=>false,'placeholder'=>'Transaction Reference','class'=>'form-control')); ?>
                </div>                                           
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'inventories_balances','action'=>'index',$inventoryId),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>