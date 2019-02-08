<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Properties')); echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Property',array('controller'=>'Properties','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
	    <?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;Print','#',array('id'=>'printme','escape'=>false,'class'=>'btn btn-default'));?>
        </div>
    </div>
        <?php echo $this->element('pagination');
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
</div>
<div class="row">
    <div class="col-md-12 col-sm-offset-8">
        <div class="btn-group">
	    <?php echo$this->Html->link('View Availiable Only',array('controller'=>'Properties','action'=>'index/skeyword:Availiable'),array('class'=>'btn btn-success'));?>
	    <?php echo$this->Html->link('View Sold Only',array('controller'=>'Properties','action'=>'index/skeyword:Sold'),array('class'=>'btn btn-danger'));?>
	</div>
    </div>
</div>
<?php echo $this->Session->flash();?>
<div class="row" id="printable_content">
<?php echo $this->Html->css('print');?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Properties</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
			    <th><?php echo $this->Paginator->sort('Project.name', 'Project', array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('name', 'Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('type', 'Type', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('availiable', 'For', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('status', 'Status', array('direction' => 'asc'));?></th>
                            <th class="pbutton">Action</th>
                        </tr>
                        <?php foreach ($Property as $post):
                        $id=$post['Property']['id'];?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['Property']['id'],'name'=>'data[Property][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
			    <td><?php echo $post['Project']['name'];?></td>
                            <td><?php echo $post['Property']['name'];?></td>
			    <td><?php echo $post['Property']['type'];?></td>
			    <td><?php echo $post['Property']['availiable'];?></td>
			    <td><span class="label label-<?php if($post['Property']['status']=="Availiable")echo"success";else echo"danger";?>"><?php echo $post['Property']['status'];?></span></td>
			    <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			      <li><?php echo $this->Html->link('<span class="fa fa-image"></span>&nbsp;Photos',array('controller'=>'properties_photos','action'=>"index/$id"),array('escape'=>false));?></li>
			      <li><?php echo $this->Html->link('<span class="fa fa-file"></span>&nbsp;Documents',array('controller'=>'properties_documents','action'=>"index/$id"),array('escape'=>false));?></li>
			      <li><?php echo $this->Html->link('<span class="fa fa-building"></span>&nbsp;Flats/Plots',array('controller'=>'properties_flats','action'=>"index/$id"),array('escape'=>false));?></li>
			      <li class="divider"></li>
			      <li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;View','#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li>
			      <li> <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
			      <li> <?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;Delete','#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
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