<?php echo $this->Session->flash();?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title">My <span>Payments</span></h4>
			</div>
		</div>		
			<div class="table-responsive">
				<table class="table table-striped">
				<tr>
					<th>S.No.</th>
					<th>Receipt No.</th>
					<th>Payment Date</th>
					<th>Payment</th>					
					<th>Payment Type</th>
					<th>Transaction Reference</th>
					<th>Action</th>
				</tr>
				<?php $serial_no=1;
				foreach($postArr as $post):$id=$post['MyPayment']['id'];?>
				<tr>
					<td><?php echo$serial_no++;?></td>
					<td><?php echo h($post['MyPayment']['receipt_no']);?></td>
					<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['MyPayment']['payment_date']));?></td>
					<td><?php echo $currency.$this->Number->format($post['MyPayment']['amount']);?></td>
					<td><?php echo h($post['Paymenttype']['name']);?></td>
					<td><?php echo h($post['MyPayment']['remarks']);?></td>
					<td>
					<?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;Receipt',array('controller'=>'MyPayments','action'=>'printreceipt',$id),array('class'=>'btn btn-info','target'=>'_blank','escape'=>false));?>
					</td>
				</tr>
				<?php endforeach;unset($post);?>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>