<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
$clientUrl=$this->Html->url(array('controller'=>'Salesreports','action'=>'clientsearch'));
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#clientId').select2({
        <?php if(!$isClient){?>
        placeholder: "Search Client Name",<?php }?>
        minimumInputLength: 1,
        ajax: {
          url: '<?php echo$clientUrl;?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },	  
          results: function (data, page) {
            return { results: data };
          }
        },
	initSelection: function (element, callback) {
	    callback({"id": "<?php echo$clientId;?>", "text": "<?php echo$clientName;?>"});
	    }
      });
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
				<h4 class="widget-title"> <span>Sales Report</span></h4>
			</div>
		</div>
		<div class="row mrg">
		    <?php if($dateBetween==false){?>
		    <div  class="col-sm-offset-2 col-md-3">
			<div><button class="btn btn-primary" type="button">Total Sales Count this month <span class="badge"><?php echo$monthSalesCount;?></span>
			<br/><br/>Total Earning this month <span class="badge"><?php echo$currency.$this->Number->format($earningMonth);?></span></button></div>
		    </div>
		    <?php }?>
		   <div  class="col-sm-offset-1 col-md-3">
			<div><button class="btn btn-primary" type="button"><?php if($dateBetween==false){?>Total<?php }?> Sales Count <span class="badge"><?php echo$totalSalesCount;?></span>
			<br/><br/><?php if($dateBetween==false){?>Total<?php }?> Earning <span class="badge"><?php echo$currency.$this->Number->format($totalEearning);?></span></button></div>
		    </div>
		</div>
		<?php echo $this->Form->create(array('name'=>'searchfrm','action' => 'index'));?>
		<div class="row mrg">
		     <div class="col-md-3 col-sm-offset-1">
			<?php echo $this->Form->select('project_id',$projectName,array('empty'=>'All','label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		    <div class="col-md-3">
			<?php echo $this->Form->input('client_id',array('type'=>'text','id'=>'clientId','label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		    <div class="col-md-3">
			<?php echo $this->Form->input('type',array('type'=>'radio','options'=>array("Commercial"=>"Commercial","Residential"=>"Residential"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
		    </div>
		    <div class="col-md-2">
			<?php echo $this->Form->input('availiable',array('type'=>'radio','options'=>array("Sale"=>"Sale","Rent"=>"Rent"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
		    </div>
		</div>
		<div class="row mrg">		    
		    <div class="col-md-3 col-sm-offset-1">
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
		    <div class="col-md-2">
			<button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> Search</button>
			<?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;Reset',array('controller'=>'Salesreports','action'=>'index'),array('class'=>'btn btn-warning btn-sm','escape'=>false));?>
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
                            <th>Sales Count</th>
                            <th>Earning</th>			    
                        </tr>
                        <?php $totCount=0;$totEarning=0;
			foreach ($salesReport as $post):
			$totCount=$post['MonthArr']['salesCount']+$totCount;
			$totEarning=$post['MonthArr']['earning']+$totEarning;?>
                        <tr>
                            <td><?php echo$post['MonthArr']['monthName'];?></td>
                            <td><?php echo$post['MonthArr']['salesCount'];?></td>
                            <td><?php echo$currency.$this->Number->format($post['MonthArr']['earning']);?></td>			    
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
			<tr class="info">
			    <td><strong>Total</strong></td>
                            <td><strong><?php echo$totCount;?></strong></td>
                            <td><strong><?php echo$currency.$this->Number->format($totEarning);?></strong></td>
			</tr>
                        </table>
                </div>
		<?php }?>
        </div>
    </div>
</div>