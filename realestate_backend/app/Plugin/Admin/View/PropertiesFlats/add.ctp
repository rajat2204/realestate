<div class="col-md-12">
<?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Flat/Plot</div>
            <div class="panel-body">
            <?php echo $this->Form->create('PropertiesFlat', array( 'controller' => 'PropertiesFlats', 'action' => "add/$propertyId",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
                <div class="form-group">               
                    <label for="group_name" class="col-sm-2 control-label"><small>Type:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('type',array('type'=>'radio','options'=>array('Flat'=>'Flat','Plot'=>'Plot'),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false,'class'=>''));?>
                    </div> 
                    <label for="group_name" class="col-sm-2 control-label"><small>Flat/Plot Name:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Flat/Plot Name','div'=>false));?>
                    </div>                    
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-2 control-label"><small>Amount:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('price',array('label' => false,'class'=>'form-control','placeholder'=>'Amount','div'=>false));?>
                    </div>
                    <label for="group_name" class="col-sm-2 control-label"><small>Area:</small></label>
                    <div class="col-sm-2">
                       <?php echo $this->Form->input('area',array('label' => false,'class'=>'form-control','placeholder'=>'Area','div'=>false));?>
                    </div>
                    <div class="col-sm-2">
                        <?php echo $this->Form->select('unit_id',$unitName,array('label' => false,'class'=>'form-control','empty'=>'Please Select','div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-2 control-label"><small>Floor/Plot No.:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('floor_no',array('label' => false,'class'=>'form-control','placeholder'=>'Floor/Plot No.','div'=>false));?>
                    </div>
                    <label for="group_name" class="col-sm-2 control-label"><small>Bedroom:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('bedroom',array('label' => false,'class'=>'form-control','placeholder'=>'Bedroom','div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-2 control-label"><small>Bathroom:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('bathroom',array('label' => false,'class'=>'form-control','placeholder'=>'Bathroom','div'=>false));?>
                    </div>
                     <label for="group_name" class="col-sm-2 control-label"><small>Studyroom:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('studyroom',array('label' => false,'class'=>'form-control','placeholder'=>'Studyroom','div'=>false));?>
                    </div> 
                </div>
                <div class="form-group">
                 <label for="group_name" class="col-sm-2 control-label"><small>Furnished:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('furnished',array('type'=>'radio','options'=>array('Y'=>"Yes","N"=>"No"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false,'class'=>''));?>
                    </div>  
                    <label for="group_name" class="col-sm-2 control-label"><small>Description:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('remarks',array('label' => false,'class'=>'form-control','placeholder'=>'Description','div'=>false));?>
                    </div>
                </div>
                <div class="form-group text-left">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
                        <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'PropertiesFlats','action'=>"index/$propertyId"),array('class'=>'btn btn-danger','escape'=>false));?>
                        <?php echo$this->Form->input('propertyId',array('type'=>'hidden','name'=>'propertyId','value'=>$propertyId));?>
                    </div>
                </div>
            <?php echo$this->Form->end();?>
            </div>
        </div>
    </div>
</div>