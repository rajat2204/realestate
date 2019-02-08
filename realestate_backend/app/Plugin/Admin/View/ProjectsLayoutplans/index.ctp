<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;Back To Projects',array('controller' => 'Projects','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
            <?php $url=$this->Html->url(array('controller'=>'ProjectsLayoutplans')); echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Layout Plan','#',array('name'=>'add','id'=>'add','onclick'=>"check_perform_add('$url/add/$projectId');",'escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
        </div>
    </div>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
</div>
<?php echo $this->Session->flash();?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Layout Plan</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo 'S.No.';?></th>
			    <th><?php echo 'Layout Plan';?></th>
                            <th>Action</th>
                        </tr>
                        <?php $serial_no=1; foreach ($ProjectsLayoutplan as $post):
                        $id=$post['ProjectsLayoutplan']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['ProjectsLayoutplan']['id'],'name'=>'data[ProjectsLayoutplan][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
			    <td><?php echo $this->Html->image($post['ProjectsLayoutplan']['dir'].'_thumb/'.$post['ProjectsLayoutplan']['photo'],array('class'=>'img-thumbnail')); ?></td>
                            <td><?php echo $this->Html->link('<span class="glyphicon glyphicon-fullscreen"></span>&nbsp;View','#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false,'class'=>'btn btn-primary'));?>
			    <?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('onclick'=>"check_perform_sdelete('$id');",'class'=>'btn btn-danger','escape'=>false));?></td>                            
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
        </div>
    </div>
</div>
<?php echo$this->Form->input('projectId',array('type'=>'hidden','name'=>'projectId','value'=>$projectId));?>
<?php echo $this->Form->end();?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>