<?php echo $this->Session->flash();
$url=$this->Html->url(array('controller'=>'Users','action'=>'assignrightsedit'));?>
<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <p><?php
            $url=$this->Html->url(array('controller'=>'Users','action'=>'assignrightsedit'));
            $url1=str_replace("/assignrights","",$this->Html->url(array('controller'=>'Users'))); echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Level','#',array('name'=>'add','id'=>'add','onclick'=>"check_perform_add('$url1/leveladd');",'escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
            <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;Back To Users',array('controller' => 'Users','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
            </p>
            </div>
    </div>
    <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deletelevel'));?>
</div>
<?php echo $this->Session->flash();?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title">Level <span>Users</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th>S.No.</th>
			    <th>Level Name</th>
                            <th>Action</th>
                        </tr>
                        <?php $serialNo=1;
			foreach ($Ugroup as $k=>$post):
                        $id=$post['Ugroup']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Ugroup']['id'],'name'=>'data[Ugroup][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo$serialNo++;?></td>
			    <td><?php echo h($post['Ugroup']['name']);?></td>
                            <td><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Set Permission','#',array('name'=>'editallfrm','onclick'=>"show_modal('$url/$id');",'escape'=>false,'class'=>'btn btn-warning'));?>
                            <?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('onclick'=>"check_perform_sdelete('$id');",'class'=>'btn btn-danger','escape'=>false));?></td>
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
                        </table>
                </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end();?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>