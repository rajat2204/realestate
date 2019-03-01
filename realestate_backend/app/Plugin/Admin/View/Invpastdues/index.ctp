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
	$('.demand_letter').tooltip();
});
</script>
<?php echo $this->Session->flash();?>
<?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;Print','#',array('id'=>'printme','escape'=>false,'class'=>'btn btn-default'));?>
<?php echo $this->Html->link('<span class="fa fa-send"></span>&nbsp;Email','#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>"all_question('Email');",'escape'=>false,'class'=>'btn btn-primary'));?>
<?php echo $this->Html->link('<span class="fa fa-mobile"></span>&nbsp;SMS','#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>"all_question('SMS');",'escape'=>false,'class'=>'btn btn-danger'));?>
<?php echo $this->Form->create(array('name'=>'searchfrm','action' => 'index'));?>
		<div class="row mrg">
		    <label for="group_name" class="col-sm-1 col-sm-offset-1 control-label"><strong>Date</strong></label>
		     <div class="col-md-2">
			<div class="input-group date" id="start_date">                        
                            <?php echo $this->Form->input('start_date',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
		    </div>
		    <div class="col-md-2">
			<div class="input-group date" id="end_date">
                           <?php echo $this->Form->input('end_date',array('type'=>'text','id'=>'end_date','label' => false,'class'=>'form-control','div'=>false));?>
                           <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
		    </div>
		    <div class="col-md-2">
			<button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> Search</button>
			<?php echo$this->Form->hidden('isSearch');?>
			<?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;Reset',array('controller'=>'Invpastdues','action'=>'index'),array('class'=>'btn btn-warning btn-sm','escape'=>false));?>
		    </div>
		</div>
		<?php echo$this->Form->end();?>
		<?php echo $this->element('pagination',array('IsSearch'=>'No'));
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
	<?php echo$this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
<div class="row" id="printable_content">
<?php echo $this->Html->css('print');?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
		<div class="widget"><h4 class="widget-title"> <span>Invoice Past Due</span></h4></div>
	    </div>	    
	    <div class="table-responsive">
		<table class="table table-striped table-bordered">
		    <tr>
			<th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
			<th><?php echo 'S.No.';?></th>
			<th><?php echo 'Client Name';?></th>
			<th><?php echo 'Phone';?></th>
			<th><?php echo 'Property';?></th>
			<th><?php echo 'Flat/Plot No.';?></th>
			<th><?php echo 'Invoice No.';?></th>
			<th><?php echo 'Payment Due On';?></th>
			<th><?php echo 'Due Date';?></th>
			<th><?php echo 'Balance';?></th>
			<th class="pbutton"><?php echo 'Action';?></th>
		    </tr>
		    <?php $serialNo=0;$totalFullPayment=0;
		    foreach ($deal as $post):$serialNo++;
		    $id=$post['Invpastdue']['id'];
		    $totalFullPayment=$totalFullPayment+$post['Invpastdue']['amount'];
		    ?>
		    <tr>
			<td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' =>$post['Client']['id'].','.$post['Deal']['id'].','.$post['Invpastdue']['id'],'name'=>'data[Invpastdue][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
			<td><?php echo$serialNo;?></td>
			<td><?php echo h($post['Client']['name']);?></td>
			<td><?php echo h($post['Client']['phone']);?></td>
			<td><?php echo h($post['Property']['name']);?></td>
			<td><?php echo h($post['PropertiesFlat']['name']);?></td>
			<td><?php echo h($post['Deal']['invoice_no']);?></td>
			<td><?php echo h($post['Invpastdue']['name']);?></td>
			<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['Invpastdue']['date']));?></td>
			<td><?php if($post['Deal']['plan_id']!=1)echo $currency.$this->Number->format($post['Invpastdue']['amount']);?></td>
			<td class="pbutton"><?php echo $this->Html->link('<span class="fa fa-print"></span>',array('controller'=>'Invpastdues','action'=>'printletter',$post['Client']['id'],$post['Deal']['id'],$post['Invpastdue']['id']),array('class'=>'demand_letter','target'=>'_blank','data-toggle'=>'tooltip','title'=>'Print Demand Letter','escape'=>false));
			echo $this->Html->link('  <span class="fa fa-send"></span>',array('controller'=>'Invpastdues','action'=>'invoicemail',$post['Client']['id'],$post['Deal']['id'],$post['Invpastdue']['id']),array('class'=>'demand_letter','data-toggle'=>'tooltip','title'=>'E-Mail Demand Letter','escape'=>false));
			echo $this->Html->link('  <span class="fa fa-mobile"></span>',array('controller'=>'Invpastdues','action'=>'invoicesms',$post['Client']['id'],$post['Deal']['id'],$post['Invpastdue']['id']),array('class'=>'demand_letter','data-toggle'=>'tooltip','title'=>'SMS Demand Letter','escape'=>false));?></td>
		    </tr>
		    <?php endforeach;?>
		    <?php unset($post);?>
		    <tr><td class="pbutton">&nbsp;</td>
		    <td colspan="8" align="right"><strong>Total Balance</strong></td><td colspan="2"><strong><?php echo $currency.$this->Number->format($totalFullPayment);?></strong></td></tr>
		</table>
	    </div>	    
        </div>	
    </div>    
</div>
<?php echo$this->Form->hidden('action',array('name'=>'action'));?>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination',array('IsSearch'=>'No'));?>