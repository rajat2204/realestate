<script type="text/javascript">
    $(document).ready(function(){
        $('.startDate').datetimepicker({format: '<?php echo$dpFormat;?>'});
    });
</script>
<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Payments</div>
        <div class="panel-body">
        <?php echo $this->Form->create('PlansPayment', array( 'controller' => 'PlansPayments', 'action' => "add/$id",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
        <?php for($k=0;$k<$installment;$k++):
        if($k==0){$installmentName="Booking Amount";$dueDate=$date;if($recurring==null)$mainInstallment=null;else$mainInstallment=$installmentAmount-$differenceAmount;}
        else {$installmentName=$k.' Installment';
        if($recurring=='M')$dueDays='1 month';elseif($recurring=='Q')$dueDays='3 month';elseif($recurring=='Y')$dueDays='1 year';else$dueDays=null;
        if($dueDays==null){$dueDate=null;$mainInstallment=null;}else{$dueDate=date($dtFormat,strtotime($dueDate."+$dueDays"));$mainInstallment=$installmentAmount;}};?>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small>Name:</small></label>
            <div class="col-sm-6">
               <?php echo $this->Form->input("$k.PlansPayment.name",array('value'=>$installmentName,'label' => false,'class'=>'form-control ','placeholder'=>'Installment Name','div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small>Amount:</small></label>
            <div class="col-sm-6">
               <?php echo $this->Form->input("$k.PlansPayment.amount",array('value'=>$mainInstallment,'label' => false,'class'=>'form-control','placeholder'=>'Amount','div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small>Due Date:</small></label>
            <div class="col-sm-6">
               <div class="input-group date startDate">                        
                <?php echo $this->Form->input("$k.PlansPayment.date",array('value'=>$dueDate,'type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            </div>
        </div>
        <div class="form-group"><hr></div>
        <?php endfor;unset($k);?>
                <div class="form-group text-left">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'PlansPayments','action'=>'index',$id),array('class'=>'btn btn-danger','escape'=>false));?>
            </div>
            </div>
            <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>