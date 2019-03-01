<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Deals'));
	    echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Deal',array('controller'=>'Deals','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
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
				<h4 class="widget-title"> <span>Deals</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('Client.name', 'Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Property.name', 'Property', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Flat.name', 'Flat/Plot Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('invoice_no', 'Invoice No', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('date', 'Invoice Date', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Property.area', 'Area', array('direction' => 'asc'));?></th>			    
			    <th><?php echo $this->Paginator->sort('total_amount', 'Total Amount', array('direction' => 'asc'));?></th>
			    <th>Balance Due</th>
			    <th>Status</th>
			    <th class="pbutton">Action</th>
                        </tr>
                        <?php $totalInvoice=0;$totalBalance=0;
			foreach ($Deal as $post):
                        $id=$post['Deal']['id'];
			$balanceDue=$post['Deal']['total_amount']-$post['Deal']['payment'];
			$totalInvoice=$totalInvoice+$post['Deal']['total_amount'];$totalBalance=$totalBalance+$balanceDue;
			if($balanceDue<=0)
			$status="Paid";
			else
			$status="Partial";
			?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['Deal']['id'],'name'=>'data[Deal][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
                            <td><?php echo h($post['Client']['name']);?></td>
			    <td><?php echo h($post['Property']['name']);?></td>
			    <td><?php echo h($post['PropertiesFlat']['name']);?></td>
			    <td><?php echo h($post['Deal']['invoice_no']);?></td>
			    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['Deal']['date']));?></td>
			    <td><?php echo $post['PropertiesFlat']['area'].' '.h($post['Unit']['name']);?></td>			    
			    <td><?php echo $currency.$this->Number->format(h($post['Deal']['total_amount']));?></td>
			    <td><?php echo $currency.$this->Number->format(h($balanceDue));?></td>
			    <td><span class="label label-<?php if($status=="Paid")echo"success";else echo"danger";?>"><?php echo $status;?></span></td>
			    <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			      Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-briefcase"></span>&nbsp;Show Payment Plan',array('controller'=>'plans_payments','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-dollar"></span>&nbsp;Make Payment',array('controller'=>'deals_payments','action'=>'add',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-briefcase"></span>&nbsp;Show Payment',array('controller'=>'deals_payments','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;Print Invoice',array('controller'=>'Deals','action'=>'printinvoice',$id),array('target'=>'_blank','escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-fullscreen"></span>&nbsp;View','#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
			    <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			  </div></td>
			    </td>                            
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
			<tr>
			<td class="pbutton"></td>
			<td colspan="7" align="right"><strong>Total</strong></td>
			<td><strong><?php echo$currency.$this->Number->format($totalInvoice);?></strong></td>
			<td colspan="3"><strong><?php echo$currency.$this->Number->format($totalBalance);?></strong></td>
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