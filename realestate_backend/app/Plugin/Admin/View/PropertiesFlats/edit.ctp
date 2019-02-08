<div class="container">
<div class="row">
<?php echo $this->Session->flash();?>
    <div class="col-md-12">
        <div class="panel panel-default mrg">
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Edit <span>Flats/Plots</span></h4><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div></div>
                <div class="panel-body">
					<?php echo $this->Form->create('PropertiesFlat', array( 'controller' => 'PropertiesFlats','action'=>"edit/$propertyId",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($PropertiesFlat as $k=>$post): $id=$post['PropertiesFlat']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger">Form <?php echo$form_no?></small></strong></div>
		  <div class="panel-body">
			<div class="form-group">
                <div class="form-group">               
                    <label for="group_name" class="col-sm-2 control-label"><small>Type:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input("$k.PropertiesFlat.type",array('type'=>'radio','options'=>array('Flat'=>'Flat','Plot'=>'Plot'),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false,'class'=>''));?>
                    </div> 
		    <label for="group_name" class="col-sm-2 control-label"><small>Flat/Plot Name:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input("$k.PropertiesFlat.name",array('label' => false,'class'=>'form-control','placeholder'=>'Flat/Plot Name','div'=>false));?>
                    </div>
		</div>
		<div class="form-group"> 
                    <label for="group_name" class="col-sm-2 control-label"><small>Amount:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input("$k.PropertiesFlat.price",array('label' => false,'class'=>'form-control','placeholder'=>'Amount','div'=>false));?>
                    </div>
		    <label for="group_name" class="col-sm-2 control-label"><small>Area:</small></label>
                    <div class="col-sm-2">
                       <?php echo $this->Form->input("$k.PropertiesFlat.area",array('label' => false,'class'=>'form-control','placeholder'=>'Area','div'=>false));?>
                    </div>
                    <div class="col-sm-2">
                        <?php echo $this->Form->select("$k.PropertiesFlat.unit_id",$unitName,array('label' => false,'class'=>'form-control','empty'=>'Please Select','div'=>false));?>
                    </div>
                </div>
                <div class="form-group">                    
                    <label for="group_name" class="col-sm-2 control-label"><small>Floor/Plot No.:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input("$k.PropertiesFlat.floor_no",array('label' => false,'class'=>'form-control','placeholder'=>'Floor/Plot No.','div'=>false));?>
                    </div>
		    <label for="group_name" class="col-sm-2 control-label"><small>Bedroom:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input("$k.PropertiesFlat.bedroom",array('label' => false,'class'=>'form-control','placeholder'=>'Bedroom','div'=>false));?>
                    </div>		   
                </div>
                <div class="form-group">               
                    <label for="group_name" class="col-sm-2 control-label"><small>Bathroom:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input("$k.PropertiesFlat.bathroom",array('label' => false,'class'=>'form-control','placeholder'=>'Bathroom','div'=>false));?>
                    </div>
                    <label for="group_name" class="col-sm-2 control-label"><small>Studyroom:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input("$k.PropertiesFlat.studyroom",array('label' => false,'class'=>'form-control','placeholder'=>'Studyroom','div'=>false));?>
                    </div>
                </div>
                <div class="form-group">               
                    <label for="group_name" class="col-sm-2 control-label"><small>Furnished:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input("$k.PropertiesFlat.furnished",array('type'=>'radio','options'=>array('Y'=>"Yes","N"=>"No"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false,'class'=>''));?>
                    </div>
                    <label for="group_name" class="col-sm-2 control-label"><small>Description:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input("$k.PropertiesFlat.remarks",array('label' => false,'class'=>'form-control','placeholder'=>'Description','div'=>false));?>
                    </div>
                </div>
		<div class="form-group text-left">
		     <div class="col-sm-offset-4 col-sm-6">
			 <?php echo $this->Form->input("$k.PropertiesFlat.id",array('type' => 'hidden'));?>
		     </div>
		 </div>
		</div>
		</div>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> Update</button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button><?php }?>
                        </div>
                    </div>
		    <?php echo$this->Form->input('propertyId',array('type'=>'hidden','name'=>'propertyId','value'=>$propertyId));?>
                <?php echo$this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>