<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <?php $url=str_replace("/pages","",$this->Html->url(array('controller'=>'Contents'))); echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;Add New Page',array('controller'=>'Contents','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','javascript:void(0);',array('type'=>'button','name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;Delete','javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
        </div>
    </div>
        <?php echo $this->element('pagination');
        $pageParams = $this->Paginator->params();
        $limit = $pageParams['limit'];
        $page = $pageParams['page'];
        $serialNo = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
</div>
<?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>    
    <div class="panel-body"><?php echo $this->Session->flash();?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('link_name', 'Link Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('page_name', 'Page Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('ordering', 'Ordering', array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('published', 'Published', array('direction' => 'asc'));?></th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($Content as $post):
                        $id=$post['Content']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Content']['id'],'name'=>'data[Content][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++; ?></td>
                            <td><?php echo $post['Content']['link_name']; ?></td>
			    <td><?php if($post['Content']['is_url']=="External"){echo $post['Content']['url'];} else {echo $post['Content']['page_name'];} ?></td>
                            <td><?php echo $post['Content']['ordering']; ?></td>
			    <td><?php if($post['Content']['published']=="Published"){ echo $this->Html->link('<span class="fa fa-check"></span>&nbsp;Published',array('controller'=>'Contents','action'=>'published',$id,'Yes'),array('escape'=>false,'class'=>'btn btn-success'));}
			    else{echo $this->Html->link('<span class="fa fa-times-circle"></span>&nbsp;Unpublished',array('controller'=>'Contents','action'=>'published',$id,'No'),array('escape'=>false,'class'=>'btn btn-danger'));}?>
                            <td><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','javascript:void(0);',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
			    <li><?php if($id!=1 && $id!=2){echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));}?></li>
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
    <div class="modal-content">        
  </div>
</div>