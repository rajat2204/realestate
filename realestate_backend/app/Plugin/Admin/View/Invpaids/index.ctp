<script type="text/javascript">
    $(document).ready(function(){        
        $('#start_date').datetimepicker({format:'<?php echo $dpFormat;?>'});
        $('#end_date').datetimepicker({format:'<?php echo $dpFormat;?>',useCurrent: false //Important! See issue #1075
        });
        $("#start_date").on("dp.change", function (e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#end_date").on("dp.change", function (e) {
            $('#start_date').data("DateTimePicker").maxDate(e.date);
        });
});
</script>
<?php echo $this->Session->flash();?>
<?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;Print','#',array('id'=>'printme','escape'=>false,'class'=>'btn btn-default'));?>
<?php echo $this->Form->create(array('name'=>'searchfrm','action' => 'index'));?>
		<div class="row mrg">
		    <label for="group_name" class="col-sm-1 col-sm-offset-1 control-label"><strong>Date</strong></label>
		     <div class="col-md-2">
			<div class="input-group date" id="start_date">                        
                            <?php echo $this->Form->input('start_date',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </div>
		    </div>
		    <div class="col-md-2">
			<div class="input-group date" id="end_date">
                           <?php echo $this->Form->input('end_date',array('type'=>'text','id'=>'end_date','label' => false,'class'=>'form-control','div'=>false));?>
                           <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </div>
		    </div>
		    <div class="col-md-2">
			<button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> Search</button>
			<?php echo$this->Form->hidden('isSearch');?>
			<?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;Reset',array('controller'=>'Invpaids','action'=>'index'),array('class'=>'btn btn-warning btn-sm','escape'=>false));?>
		    </div>
		</div>
		<?php echo$this->Form->end();?>
		<?php echo $this->element('pagination',array('IsSearch'=>'No'));
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
<div class="row" id="printable_content">
<?php echo $this->Html->css('print');?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
		<div class="widget"><h4 class="widget-title"> <span>Paid Invoices</span></h4></div>
	    </div>	    
	    <div class="table-responsive">
		<table class="table table-striped table-bordered">
		    <tr>
			<th class="pbutton">&nbsp;</th>
			<th><?php echo 'S.No.';?></th>
			<th><?php echo 'Client Name';?></th>
			<th><?php echo 'Phone';?></th>
			<th><?php echo 'Property';?></th>
			<th><?php echo 'Flat/Plot No.';?></th>
			<th><?php echo 'Invoice No.';?></th>
			<th><?php echo 'Payment On';?></th>
			<th><?php echo 'Payment Date';?></th>
			<th><?php echo 'Amount';?></th>
			<th><?php echo 'Tax Amount';?></th>
			<th><?php echo 'Total Amount';?></th>
		    </tr>
		    <?php $serialNo=0;$totalAmount=0;$totalPaidAmount=0;$totalTaxAmount=0;
		    foreach ($deal as $post):$serialNo++;
		    $totalAmount=$totalAmount+$post['DealsPayment']['total_amount'];
		    $totalTaxAmount=$totalTaxAmount+$post['DealsPayment']['tax_amount'];
		    $totalPaidAmount=$totalPaidAmount+$post['DealsPayment']['amount'];
		    ?>
		    <tr>
			<td class="pbutton">&nbsp;</td>
			<td><?php echo$serialNo;?></td>
			<td><?php echo h($post['Client']['name']);?></td>
			<td><?php echo h($post['Client']['phone']);?></td>
			<td><?php echo h($post['Property']['name']);?></td>
			<td><?php echo h($post['PropertiesFlat']['name']);?></td>
			<td><?php echo h($post['Invpaid']['invoice_no']);?></td>
			<td><?php echo h($post['PlansPayment']['name']);?></td>
			<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['DealsPayment']['payment_date']));?></td>
			<td><?php echo $currency.$this->Number->format($post['DealsPayment']['total_amount']);?></td>
			<td><?php echo $currency.$this->Number->format($post['DealsPayment']['tax_amount']);?></td>
			<td><?php echo $currency.$this->Number->format($post['DealsPayment']['amount']);?></td>
		    </tr>
		    <?php endforeach;?>
		    <?php unset($post);?>
		    <tr>
			<td class="pbutton">&nbsp;</td>
			<td colspan="8" align="right"><strong>Total</strong></td>
			<td><strong><?php echo$currency.$this->Number->format($totalAmount);?></strong></td>
			<td><strong><?php echo$currency.$this->Number->format($totalTaxAmount);?></strong></td>
			<td><strong><?php echo$currency.$this->Number->format($totalPaidAmount);?></strong></td>
		    </tr>
		</table>
	    </div>
        </div>
    </div>
</div>
<?php echo $this->element('pagination',array('IsSearch'=>'No'));?>