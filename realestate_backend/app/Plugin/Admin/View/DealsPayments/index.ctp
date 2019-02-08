<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;Back To Deals',array('controller' => 'Deals','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
            <?php $url=$this->Html->url(array('controller'=>'deals_payments')); echo $this->Html->link('<span class="fa fa-dollar"></span>&nbsp;Add New Payment',array('controller'=>'deals_payments','action'=>'add',$dealId),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
	    <?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;Print','#',array('id'=>'printme','escape'=>false,'class'=>'btn btn-default'));?>
        </div>
    </div>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
</div>
<?php echo $this->Session->flash();?>
<div class="row" id="printable_content">
<?php echo $this->Html->css('print');?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Show Payments of <?php echo$dealPayment[0]['Client']['name'];?> for <?php echo$dealPayment[0]['Property']['name'];?> Total Amount <?php echo$currency.$this->Number->format($dealPayment[0]['Deal']['total_amount']);?></span></h4>
			</div>
		</div>
                <div class="table-responsive">
		    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo 'S.No.';?></th>
			    <th><?php echo 'Amount';?></th>
			    <th><?php echo 'Tax Amount';?></th>
			    <th><?php echo 'Total Amount';?></th>
			    <th><?php echo 'Payment Name';?></th>
			    <th><?php echo 'Payment Date';?></th>
			    <th><?php echo 'Payment Type';?></th>
			    <th><?php echo 'Transaction Reference';?></th>
                            <th class="pbutton">Action</th>
                        </tr>
                        <?php $serialNo=0; $totalPayment=0;$totalAmount=0;$totalTaxAmount=0;
			$totalRecord=count($dealPayment);
			foreach ($dealPayment as $post):
                        $id=$post['DealsPayment']['id'];
			$totalPayment=$totalPayment+$post['DealsPayment']['amount'];
			$totalAmount=$totalAmount+$post['DealsPayment']['total_amount'];
			$totalTaxAmount=$totalTaxAmount+$post['DealsPayment']['tax_amount'];
			$serialNo++;
			?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['DealsPayment']['id'],'name'=>'data[DealsPayment][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo;?></td>
			    <td><?php echo $currency.$this->Number->format($post['DealsPayment']['total_amount']);?></td>
			    <td><?php echo $currency.$this->Number->format($post['DealsPayment']['tax_amount']);?></td>
			    <td><?php echo $currency.$this->Number->format($post['DealsPayment']['amount']);?></td>
			    <td><?php echo h($post['PlansPayment']['name']);?></td>
			    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['DealsPayment']['payment_date']));?></td>
			    <td><?php echo h($post['Paymenttype']['name']);?></td>
			    <td><?php echo h($post['DealsPayment']['remarks']);?></td>
                            <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			      Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;Print Receipt',array('controller'=>'DealsPayments','action'=>'printreceipt',$id),array('target'=>'_blank','escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
			    <?php if($totalRecord==$serialNo){?><li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li><?php }?>
			    </ul>
			  </div>
			    </td>                          
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
			<tr>
			<td class="pbutton"></td>
			<td  align="right"><strong>Total</strong></td>
			<td><strong><?php echo$currency.$this->Number->format($totalAmount);?></strong></td>
			<td><strong><?php echo$currency.$this->Number->format($totalTaxAmount);?></strong></td>
			<td colspan="7"><strong><?php echo$currency.$this->Number->format($totalPayment);?></strong></td>
			</tr>
                        </table>
                </div>
        </div>
    </div>
</div>
<?php echo$this->Form->input('dealId',array('type'=>'hidden','name'=>'dealId','value'=>$dealId));?>
<?php echo $this->Form->end();?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>