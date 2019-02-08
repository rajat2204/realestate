<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Inventories'));?>
	    <?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Inventory',array('controller'=>'Inventories','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
            <?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;Print','#',array('id'=>'printme','escape'=>false,'class'=>'btn btn-default'));?>
        </div>
    </div>
        <?php echo $this->element('pagination');
        $pageParams = $this->Paginator->params();
        $limit = $pageParams['limit'];
        $page = $pageParams['page'];
        $serialNo = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
</div>
<?php echo $this->Session->flash();?>
<div class="row" id="printable_content">
<?php echo $this->Html->css('print');?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Inventories</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
			    <th><?php echo $this->Paginator->sort('Project.name', 'Project', array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('ExpenseCategory.name', 'Category Name', array('direction' => 'asc'));?></th>
			     <th><?php echo $this->Paginator->sort('Vendor.name', 'Vendor / Staff', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('invoice_no', 'Invoice No.', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('invoice_date', 'Invoice Date', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('invoice_qty', 'Quantity', array('direction' => 'asc'));?></th>
			    <th>Balance</th>			    
			    <th>Status</th>
			    <th><?php echo $this->Paginator->sort('remarks', 'Remarks', array('direction' => 'asc'));?></th>
                            <th class="pbutton">Action</th>
                        </tr>
                        <?php $totalInvoice=0;$totalBalance=0;
			foreach ($Inventory as $post):
                        $id=$post['Inventory']['id'];
			$balanceDue=$post['Inventory']['invoice_qty']-$post['Inventory']['qty'];
			$totalInvoice=$totalInvoice+$post['Inventory']['invoice_qty'];$totalBalance=$totalBalance+$balanceDue;
			if($balanceDue<=0)
			$status="Empty";
			else
			$status="Available";
			?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['Inventory']['id'],'name'=>'data[Inventory][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
			    <td><?php echo h($post['Project']['name']);?></td>
			    <td><?php echo h($post['ExpenseCategory']['name']);?></td>
			    <td><?php echo h($post['Vendor']['name']);?></td>
			    <td><?php echo h($post['Inventory']['invoice_no']);?></td>
			    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$post['Inventory']['invoice_date']);?></td>
                            <td><?php echo $this->Number->format($post['Inventory']['invoice_qty']);?></td>
			    <td><?php echo $this->Number->format($balanceDue);?></td>
			    <td><span class="label label-<?php if($status=="Available")echo"success";else echo"danger";?>"><?php echo $status;?></span></td>
			    <td><?php echo h($post['Inventory']['remarks']);?></td>			    
                            <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <?php if($status!="Paid"){?><li><?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Make Entry',array('controller'=>'inventories_balances','action'=>'add',$id),array('escape'=>false));?></li><?php }?>
			    <li><?php echo $this->Html->link('<span class="fa fa-briefcase"></span>&nbsp;Show Inventories',array('controller'=>'inventories_balances','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
                            <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			  </div></td>
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
			<tr>
			    <td class="pbutton"></td>
			    <td colspan="6" align="right"><strong>Total</strong></td>
			    <td><strong><?php echo$this->Number->format($totalInvoice);?></strong></td>
			    <td colspan="5"><strong><?php echo$this->Number->format($totalBalance);?></strong></td>
			</tr>    
		    </table>
                </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>