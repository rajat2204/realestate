<div class="row">
    <div class="col-md-12">
        <div class="btn-group">
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;Back To Property',array('controller' => 'Properties','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
            <?php $url=$this->Html->url(array('controller'=>'PropertiesFlats')); echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;Add New Flat/Plot',array('controller'=>'PropertiesFlats','action'=>'add',$propertyId),array('escape'=>false,'class'=>'btn btn-success'));?>
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
<?php echo $this->Session->flash();?>
<div class="row" id="printable_content">
<?php echo $this->Html->css('print');?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Flats/Plots</span></h4>
			</div>
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', 'S.No.', array('direction' => 'desc'));?></th>
			    <th><?php echo $this->Paginator->sort('PropertiesFlat.type', 'Type', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Property.name', 'Property Name', array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('name', 'Flat/Plot Name', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('floor_no', 'Floor/Plot No.', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('area', 'Area', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('price', 'Amount', array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('status', 'Status', array('direction' => 'asc'));?></th>
                            <th class="pbutton">Action</th>
                        </tr>
                        <?php $serial_no=1; foreach ($PropertiesFlat as $post):
                        $id=$post['PropertiesFlat']['id'];?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['PropertiesFlat']['id'],'name'=>'data[PropertiesFlat][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
			    <td><?php echo $post['PropertiesFlat']['type'];?></td>
			    <td><?php echo $post['Property']['name'];?></td>
			    <td><?php echo $post['PropertiesFlat']['name'];?></td>
			    <td><?php echo $post['PropertiesFlat']['floor_no'];?></td>
			    <td><?php echo $post['PropertiesFlat']['area'].' '.$post['Unit']['name'];?></td>
			    <td><?php echo $currency.$this->Number->format($post['PropertiesFlat']['price']);?></td>
			    <td><span class="label label-<?php if($post['PropertiesFlat']['status']=="Availiable")echo"success";else echo"danger";?>"><?php echo h($post['PropertiesFlat']['status']); ?></span></td>
			    <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    Action <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
				<li><?php echo $this->Html->link('<span class="glyphicon glyphicon-fullscreen"></span>&nbsp;View','#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li>
				<li> <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;Edit','#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
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
<?php echo$this->Form->input('propertyId',array('type'=>'hidden','name'=>'propertyId','value'=>$propertyId));?>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>