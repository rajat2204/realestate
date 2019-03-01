<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading">Agents Wallet<?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Agent', array( 'class'=>'form-horizontal'));?>
                <?php foreach ($Agent as $k=>$post): $id=$post['Agent']['id'];$form_no=$k+1;?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong class="text-danger"><small>Transaction  Form <?php echo$form_no?></small></strong></div>
			    <div class="panel-body">
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small>Email</small></label>
				    <div class="col-sm-9">
					<?php echo h($post['Agent']['email']);?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small>Name</small></label>
				    <div class="col-sm-9">
					<?php echo h($post['Agent']['name']);?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small>Mobile</small></label>
				    <div class="col-sm-9">
					<?php echo h($post['Agent']['mobile']);?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small>Balance</small></label>
				    <div class="col-sm-9">
					<?php echo (empty($post['Awallet']['balance'])) ? $currency."0.00" : $currency.$post['Awallet']['balance'];?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small>Amount</small></label>
				    <div class="col-sm-3">
					<?php echo $this->Form->input("$k.Agent.amount",array('label' => false,'class'=>'form-control','placeholder'=>'Amount','autocomplete'=>'off','div'=>false,'type'=>'number'));?>
				    </div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small>Action</small></label>
					<div class="col-sm-3">
					    <?php echo $this->Form->select("$k.Agent.action",array("CR"=>"ADD","DR"=>"DEDUCT"),array('empty'=>"Please Select",'label' => false,'class'=>'form-control','div'=>false));?>
					</div>
				</div>
				<div class="form-group">
				    <label for="group_name" class="col-sm-3 control-label"><small>Remarks</small></label>
				    <div class="col-sm-3">
					<?php echo $this->Form->textarea("$k.Agent.remarks",array('label' => false,'class'=>'form-control','placeholder'=>'Remarks','div'=>false));?>
				    </div>
				</div>
				<div class="form-group text-left">
				    <div class="col-sm-offset-3 col-sm-7">
					<?php echo $this->Form->hidden("$k.Agent.id");?>
				    </div>
				</div>
			    </div>
		    </div>				
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">                            
                            <?php echo$this->Form->button('<span class="fa fa-refresh"></span> Update',array('class'=>'btn btn-success','escpae'=>false));?>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button><?php }else{
			echo$this->Html->link('<span class="fa fa-close"></span> Close',array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
                        </div>
                    </div>
               <?php echo $this->Form->end();?>
        </div>
    </div>
</div>