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
<div class="row">
    <div  class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Profit & Loss Report</span></h4>
			</div>
		</div>
		<div class="row mrg">
		     <?php if($dateBetween==false){?>
		    <div  class="col-sm-offset-2 col-md-3">
			<div><button class="btn btn-primary" type="button">Total Profit & Loss this month <span class="badge"><?php echo$currency.$this->Number->format($profitMonth);?></span></button></div>
		    </div>
		    <?php }?>
		   <div  class="col-sm-offset-1 col-md-3">
			<div><button class="btn btn-primary" type="button"><?php if($dateBetween==false){?>Total<?php }?> Profit & Loss <span class="badge"><?php echo$currency.$this->Number->format($totalProfit);?></span></button></div>
		    </div>
		</div>
		<?php echo $this->Form->create(array('name'=>'searchfrm','action' => 'index'));?>
		<div class="row mrg mrg-left">
		    <div  class="col-md-3">
			<?php echo $this->Form->select('project_id',$projectName,array('empty'=>'All','label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		    <div  class="col-md-2">
			<?php echo $this->Form->input('date',array('dateFormat' => 'Y','minYear' => 2014,'maxYear' => date('Y') + 5 ,'empty'=>'All','label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		    <label for="group_name" class="col-sm-1 control-label"><strong>Date</strong></label>
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
		    <div  class="col-md-2">
			<button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> Search</button>
			<?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;Reset',array('controller'=>'Profitreports','action'=>'index'),array('class'=>'btn btn-warning btn-sm','escape'=>false));?>
		    </div>
		</div>
		<?php echo$this->Form->end();?>
		<?php if($dateBetween==false){?>
		<div class="chart">
		    <div id="mywrapperdl"></div>
			<?php echo $this->HighCharts->render("My Chartdl");?>
		</div>
             <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Month</th>
			    <th>Earning</th>
                            <th>Purchase</th>
                            <th>Expense</th>
			    <th>Profit/Loss</th>
                        </tr>
                        <?php $totEarning=0;$totExpense=0;$totPurchase=0;
			foreach ($profitReport as $post):
			$totEarning=$post['MonthArr']['earning']+$totEarning;
			$totExpense=$post['MonthArr']['expense']+$totExpense;
			$totPurchase=$post['MonthArr']['purchase']+$totPurchase;
			?>
                        <tr>
                            <td><?php echo$post['MonthArr']['monthName'];?></td>
                            <td><?php echo$currency.$this->Number->format($post['MonthArr']['earning']);?></td>
			    <td><?php echo$currency.$this->Number->format($post['MonthArr']['purchase']);?></td>
                            <td><?php echo$currency.$this->Number->format($post['MonthArr']['expense']);?></td>
			    <td><?php echo$currency.$this->Number->format($post['MonthArr']['earning']-$post['MonthArr']['expense']-$post['MonthArr']['purchase']);?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
			<tr class="info">
			    <td><strong>Total</strong></td>
                            <td><strong><?php echo$currency.$this->Number->format($totEarning);?></strong></td>
			    <td><strong><?php echo$currency.$this->Number->format($totPurchase);?></strong></td>
                            <td><strong><?php echo$currency.$this->Number->format($totExpense);?></strong></td>
			    <td><strong><?php echo$currency.$this->Number->format($totEarning-$totExpense);?></strong></td>
			</tr>
                        </table>
                </div>
		<?php }?>
        </div>
    </div>
</div>