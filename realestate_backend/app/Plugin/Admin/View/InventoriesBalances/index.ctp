<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;Back To Inventory',array('controller' => 'Inventories','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
            <?php $url=$this->Html->url(array('controller'=>'inventories_balances')); echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Entry',array('controller'=>'inventories_balances','action'=>'add',$inventoryId),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
	    <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
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
				<h4 class="widget-title"> <span>Show Entries of <?php echo$expense['Vendor']['name'];?> Invoice No. <?php echo$expense['Inventory']['invoice_no'];?> dated <?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$expense['Inventory']['invoice_date']);?></span></h4>
			</div>
		</div>
                <div class="table-responsive">
		    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo 'S.No.';?></th>
			    <th><?php echo 'Quantity';?></th>
			    <th><?php echo 'Date';?></th>
			    <th><?php echo 'Remarks';?></th>
                            <th class="pbutton">Action</th>
                        </tr>
                        <?php $serialNo=1; $totalPayment=0;
			foreach ($expensePayment as $post):
                        $id=$post['InventoriesBalance']['id'];
			$totalPayment=$totalPayment+$post['InventoriesBalance']['qty'];
			?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['InventoriesBalance']['id'],'name'=>'data[InventoriesBalance][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
			    <td><?php echo $this->Number->format($post['InventoriesBalance']['qty']);?></td>
			    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['InventoriesBalance']['date']));?></td>
			    <td><?php echo h($post['InventoriesBalance']['remarks']);?></td>
                            <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
			    <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			  </div>
			    </td>                          
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
			<tr>
			<td class="pbutton"></td>
			<td colspan="1" align="right"><strong>Total</strong></td>
			<td><strong><?php echo$this->Number->format($totalPayment);?></strong></td>
			<td align="right"><strong>Balance</strong></td>
			<td colspan="3"><strong><?php echo$this->Number->format($expense['Inventory']['invoice_qty']-$totalPayment);?></strong></td>
			</tr>
                        </table>
                </div>
        </div>
    </div>
</div>
<?php echo$this->Form->input('inventoryId',array('type'=>'hidden','name'=>'inventoryId','value'=>$inventoryId));?>
<?php echo $this->Form->end();?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>