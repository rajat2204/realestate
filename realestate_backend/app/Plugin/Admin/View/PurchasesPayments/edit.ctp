<?php echo $this->Html->css('bootstrap-datetimepicker.min');
echo $this->Html->script('moment');
echo $this->Html->script('bootstrap-datetimepicker.min');?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.paymentDate').datetimepicker({pickTime: false});
        });
</script>
<div class="container">
<div class="row">
<?php echo $this->Session->flash();?>
    <div class="col-md-12">
        <div class="panel panel-default mrg">
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Edit <span>PurchasesPayments</span></h4><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div></div>
                <div class="panel-body">
					<?php echo $this->Form->create('PurchasesPayment', array( 'controller' => 'PurchasesPayments','action'=>"edit/$purchaseId",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($PurchasesPayment as $k=>$post): $id=$post['PurchasesPayment']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger">Form <?php echo$form_no?></small></strong></div>
		  <div class="panel-body">
			<div class="form-group">
		    <label for="group_name" class="col-sm-4 control-label"><small>Amount:</small></label>
		    <div class="col-sm-4">
		       <?php echo $this->Form->input("$k.PurchasesPayment.amount", array('label'=>false,'placeholder'=>'Amount','class'=>'form-control')); ?>
		    </div>
		</div>
		<div class="form-group">
		    <label for="group_name" class="col-sm-4 control-label"><small>Payment Type:</small></label>
		    <div class="col-sm-4">
		       <?php echo $this->Form->select("$k.PurchasesPayment.paymenttype_id",$paymentType,array('empty'=>'Please Select','label'=>false,'class'=>'form-control')); ?>
		    </div>                                           
		</div>
		<div class="form-group">
		    <label for="group_name" class="col-sm-4 control-label"><small>Payment Date:</small></label>
		    <div class="col-sm-4">
		       <div class="input-group date paymentDate" data-date-format="YYYY-MM-DD">                        
			<?php echo $this->Form->input("$k.PurchasesPayment.date",array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>'Payment Date','div'=>false));?>
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		    </div>
		    </div>                                           
		</div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small>Transaction Reference:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.PurchasesPayment.remarks", array('label'=>false,'placeholder'=>'Transaction Reference','class'=>'form-control')); ?>
                </div>                                           
            </div>
		      <div class="form-group text-left">
			  <div class="col-sm-offset-4 col-sm-6">
			      <?php echo $this->Form->input("$k.PurchasesPayment.id",array('type' => 'hidden'));?>
			  </div>
		      </div>
		  </div>
		</div>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-4 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> Update</button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button><?php }?>
                        </div>
                    </div>
		    <?php echo$this->Form->input('purchaseId',array('type'=>'hidden','name'=>'purchaseId','value'=>$purchaseId));?>
                <?php echo$this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>