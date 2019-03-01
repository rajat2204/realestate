<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'PlansPayments')); if(!$Plan)echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>&nbsp;Add  Payments',array('controller'=>'PlansPayments','action'=>'add',$id),array('escape'=>false,'escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"editallplan();",'escape'=>false,'class'=>'btn btn-warning'));?>
	    <?php echo $this->Html->link('<span class="glyphicon glyphicon-trash"></span>&nbsp;Delete','#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
            <?php echo $this->Html->link('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back To Deal ',array('controller' => 'Deals','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
	</div>
    </div>
        <?php echo $this->element('pagination');
        $pageParams = $this->Paginator->params();
        $limit = $pageParams['limit'];
        $page = $pageParams['page'];
        $serialNo = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','controller'=>'PlansPayments','action' => "deleteall/$id"));?>
</div>
<?php echo $this->Session->flash();?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Plans Payments</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
		<tr>
		    <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
		    <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
		    <th><?php echo $this->Paginator->sort('name', 'Name', array('direction' => 'asc'));?></th>
		    <th><?php echo $this->Paginator->sort('amount', 'Amount ', array('direction' => 'asc'));?></th>
		    <th><?php echo $this->Paginator->sort('date', 'Due Date', array('direction' => 'asc'));?></th>
		</tr>
		<?php $totalAmount=0;
		foreach ($Plan as $post):
		$id=$post['PlansPayment']['id'];$totalAmount=$totalAmount+$post['PlansPayment']['amount'];
		?>
		<tr>
		    <td><?php echo $this->Form->checkbox(false,array('value' => $post['PlansPayment']['id'],'name'=>'data[PlansPayment][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
		    <td><?php echo $serialNo++; ?></td>
		    <td class="pullout left"><?php echo h($post['PlansPayment']['name']);?></td>
		    <td class="pullout left"><?php echo $currency.$this->Number->format($post['PlansPayment']['amount']);?></td>
		    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['PlansPayment']['date']));?></td>		   
		</tr>
		<?php endforeach; ?>
		<?php unset($post);?>
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
<script type="text/javascript">
    function editallplan()
    {
	$(document).ready(function(){
	$('.chkselect').prop('checked',true);});
	check_perform_edit('<?php echo$url;?>');
    }
</script>
<style>
    .chkselect{display:none;}
    #selectAll{display: none;}
</style>