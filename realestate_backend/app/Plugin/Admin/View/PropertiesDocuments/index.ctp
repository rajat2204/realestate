<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;Back To Property',array('controller' => 'Properties','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
            <?php $url=$this->Html->url(array('controller'=>'PropertiesDocuments')); echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Document','#',array('name'=>'add','id'=>'add','onclick'=>"check_perform_add('$url/add/$propertyId');",'escape'=>false,'class'=>'btn btn-success'));?>
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
				<h4 class="widget-title"> <span>Document Photo</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo 'S.No.';?></th>
			    <th><?php echo 'Photo';?></th>
                            <th>Action</th>
                        </tr>
                        <?php $serial_no=1; foreach ($PropertiesDocument as $post):
                        $id=$post['PropertiesDocument']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['PropertiesDocument']['id'],'name'=>'data[PropertiesDocument][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
			    <td><?php echo $this->Html->image($post['PropertiesDocument']['dir'].'_thumb/'.$post['PropertiesDocument']['photo'],array('class'=>'img-thumbnail')); ?></td>
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
<?php echo$this->Form->input('propertyId',array('type'=>'hidden','name'=>'propertyId','value'=>$propertyId));?>
<?php echo $this->Form->end();?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>