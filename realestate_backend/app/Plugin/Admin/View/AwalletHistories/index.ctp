<div class="row">
        <?php echo $this->element('pagination');
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
</div>
<?php echo $this->Session->flash();?>
<div class="row">
    <div class="col-md-12">
	<div class="btn-group">
            <?php echo $this->Html->link('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back',array('controller'=>'Agents','action'=>'index'),array('escape'=>false,'class'=>'btn btn-info'));?>
        </div>
	<div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Agent Wallet History</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('Agent.name', 'Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('amount', 'Amount', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('type', 'Type', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('date', 'Date & Time', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Remarks', 'Remarks', array('direction' => 'asc'));?></th>
			    <th>Show Payment</th>
                        </tr>
                        <?php 
			foreach ($record as $post):
                        $id=$post['AwalletHistory']['id'];?>
                        <tr>
                            <td><?php echo $serial_no++; ?></td>
                            <td><?php echo h($post['Agent']['name']);?></td>
			    <td><?php echo $currency.$this->Number->format($post['AwalletHistory']['amount']);?></td>
			    <td><?php echo h($post['AwalletHistory']['type']);?></td>
			    <td><?php echo $this->Time->Format('d-m-Y h:i:s A',$post['AwalletHistory']['date']);?></td>
			    <td><?php echo eval('return "' . addslashes($post['AwalletHistory']['remarks']) . '";');?></td>
			    <td><?php if($post['AwalletHistory']['deals_payment_id']){ echo $this->Html->link('Show Payment',array('controller'=>'DealsPayments','action'=>'printreceipt',$post['AwalletHistory']['deals_payment_id']),array('target'=>'_blank'));}?></td>
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
			<?php if($aWallet){?>
			<tr>
				<th>Total Credit </th>
				<th>Total Debit </th>				
				<th colspan="5">Balance</th>
			</tr>
			<tr>
				<th><?php echo$currency.$this->Number->format($aWallet['Awallet']['credit']);?></th>
				<th><?php echo$currency.$this->Number->format($aWallet['Awallet']['debit']);?></th>
				<th colspan="5"><?php echo$currency.$this->Number->format($aWallet['Awallet']['balance']);?></th>
			</tr>
			<?php }?>
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