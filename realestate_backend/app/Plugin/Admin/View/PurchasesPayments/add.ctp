<?php echo $this->Html->css('bootstrap-datetimepicker.min');
echo $this->Html->script('moment');
echo $this->Html->script('bootstrap-datetimepicker.min');?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#paymentDate').datetimepicker({pickTime: false});
        });
</script>
<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Payment</div>
        <div class="panel-body">
        <?php echo $this->Form->create('PurchasesPayment', array( 'controller' => 'PurchasesPayments', 'action' => "add/$purchaseId",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Amount:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('amount', array('label'=>false,'placeholder'=>'Amount','class'=>'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Payment Type:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('paymenttype_id',$paymentType,array('empty'=>'Please Select','label'=>false,'class'=>'form-control')); ?>
                </div>                                           
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Payment Date:</small></label>
                <div class="col-sm-4">
                   <div class="input-group date" id="paymentDate" data-date-format="YYYY-MM-DD">                        
                    <?php echo $this->Form->input('date',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>'Payment Date','div'=>false,'default'=>$date));?>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                </div>                                           
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Transaction Reference:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('remarks', array('label'=>false,'placeholder'=>'Transaction Reference','class'=>'form-control')); ?>
                </div>                                           
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'purchases_payments','action'=>'index',$purchaseId),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>