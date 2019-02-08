<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Projects'));?>
	    <?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Project',array('controller'=>'Projects','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
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
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Projects</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('name', 'Project Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('city', 'City', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('state', 'State', array('direction' => 'asc'));?></th>
                            <th>Action</th>
			    <th>View</th>
                        </tr>
                        <?php foreach ($Project as $post):
                        $id=$post['Project']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Project']['id'],'name'=>'data[Project][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
                            <td><?php echo h($post['Project']['name']);?></td>
			    <td><?php echo h($post['Project']['city']);?></td>
			    <td><?php echo h($post['Project']['state']);?></td>
                            <td><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-image"></span>&nbsp;Photos',array('controller'=>'projects_photos','action'=>"index/$id"),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-building"></span>&nbsp;Layout Plan',array('controller'=>'projects_layoutplans','action'=>"index/$id"),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-map-marker"></span>&nbsp;Location Map',array('controller'=>'projects_locationmaps','action'=>"index/$id"),array('escape'=>false));?></li>
			    <li class="divider"></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;View','#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
                            <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			  </div></td>
			    <td><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    View <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-random"></span>&nbsp;Properties',array('controller'=>'Properties','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-random"></span>&nbsp;Leads',array('controller'=>'Leads','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-random"></span>&nbsp;Deals',array('controller'=>'Deals','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-random"></span>&nbsp;Purchases',array('controller'=>'Purchases','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-random"></span>&nbsp;Expenses',array('controller'=>'Expenses','action'=>'index',$id),array('escape'=>false));?></li>
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