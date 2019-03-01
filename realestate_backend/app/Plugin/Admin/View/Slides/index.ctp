<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Slides')); echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;Add New Slide','javascript:void(0);',array('name'=>'add','id'=>'add','onclick'=>"check_perform_add('$url/add');",'escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','javascript:void(0);',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;Delete','javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
        </div>
    </div>
        <?php echo $this->element('pagination');
        $pageParams = $this->Paginator->params();
        $limit = $pageParams['limit'];
        $page = $pageParams['page'];
        $serialNo = 1*$limit*($page-1)+1;?>
</div>	
       <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
   <div class="panel-body"><?php echo $this->Session->flash();?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('group_name', 'Slide Name', array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('ordering', 'Ordering', array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('status', 'Status', array('direction' => 'asc'));?></th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($Slide as $post):
                        $id=$post['Slide']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Slide']['id'],'name'=>'data[Slide][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++; ?></td>
                            <td><?php echo h($post['Slide']['slide_name']); ?></td>
                            <td><?php echo h($post['Slide']['ordering']); ?></td>
                            <td><span class="label label-<?php if($post['Slide']['status']=="Active")echo"success";else echo"danger";?>"><?php echo h($post['Slide']['status']); ?></span></td>
                            <td><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-fullscreen"></span>&nbsp;View','javascript:void(0);',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li>
                            <li><?php echo $this->Html->link('<i class="fa fa-photo"></i>&nbsp;Change Photo','javascript:void(0);',array('onclick'=>"show_modal('$url/changephoto/$id');",'escape'=>false));?></li>
		            <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','javascript:void(0);',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
                            <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			    </div></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
        <?php echo $this->Form->end();?>
	<?php echo $this->element('pagination');?>
    </div>
</div>

<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content"></div>
</div>