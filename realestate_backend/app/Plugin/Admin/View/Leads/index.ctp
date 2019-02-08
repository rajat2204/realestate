<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Leads')); echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Lead',array('controller'=>'Leads','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
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
				<h4 class="widget-title"> <span>Leads</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('name', 'Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('phone', 'Phone No.', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Property.name', 'Property', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Property.availiable', 'Availiable For', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('follow_up', 'Follow Up', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('status', 'Status', array('direction' => 'asc'));?></th>
                            <th class="pbutton">Action</th>
                        </tr>
                        <?php foreach ($Lead as $post):
                        $id=$post['Lead']['id'];?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['Lead']['id'],'name'=>'data[Lead][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
                            <td><?php echo h($post['Lead']['name']);?></td>
			     <td><?php echo h($post['Lead']['phone']);?></td>
			    <td><?php echo h($post['Property']['name']);?></td>
			    <td><?php echo h($post['Property']['availiable']);?></td>
			    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,h($post['Lead']['follow_up']));?></td>
			    <td><span class="label label-<?php if(h($post['Lead']['status'])=="Awaiting/Closed")echo"success";elseif(h($post['Lead']['status'])=="Cancelled")echo"danger";else echo"warning";?>"><?php echo h($post['Lead']['status']);?></span></td>
                            <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="glyphicon glyphicon-fullscreen"></span>&nbsp;View','#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
                            <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			  </div></td>                           
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
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