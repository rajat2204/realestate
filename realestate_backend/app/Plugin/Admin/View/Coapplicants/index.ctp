<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Coapplicants'));?>
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;Back To Clients',array('controller' => 'Clients','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
	    <?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Coapplicant',array('controller'=>'Coapplicants','action'=>'add',$clientId),array('escape'=>false,'class'=>'btn btn-success'));?>
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
<div class="row" id="printable_content">
<?php echo $this->Html->css('print');?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Coapplicants</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('name', 'Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('father_name', 'Father Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('phone', 'Contact Number', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('email', 'Email', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('district', 'District', array('direction' => 'asc'));?></th>
                            <th class="pbutton">Action</th>
                        </tr>
                        <?php foreach ($Coapplicant as $post):
                        $id=$post['Coapplicant']['id'];?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['Coapplicant']['id'],'name'=>'data[Coapplicant][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
                            <td><?php echo h($post['Coapplicant']['name']);?></td>
			    <td><?php echo h($post['Coapplicant']['father_name']);?></td>
			    <td><?php echo h($post['Coapplicant']['phone']);?></td>
			    <td><?php echo h($post['Coapplicant']['email']);?></td>
			    <td><?php echo h($post['Coapplicant']['district']);?></td>
                            <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
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
<?php echo$this->Form->input('clientId',array('type'=>'hidden','name'=>'clientId','value'=>$clientId));?>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>