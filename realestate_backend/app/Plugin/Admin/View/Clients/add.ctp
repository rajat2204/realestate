<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Client</div>
        <div class="panel-body">
        <?php echo $this->Form->create('Client', array( 'controller' => 'Clients', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Applicant Information</strong></div>
            <div class="panel-body">
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Name of the Applicant:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Name of the Applicant','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Father's Husband Name:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('father_name',array('label' => false,'class'=>'form-control','placeholder'=>'Father\'s Husband Name','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Address:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>'Address','div'=>false));?>
                </div>    
                <label for="group_name" class="col-sm-2 control-label"><small>District:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('district',array('label' => false,'class'=>'form-control','placeholder'=>'District','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>State:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('state',array('label' => false,'class'=>'form-control','placeholder'=>'State','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Pincode:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('pincode',array('label' => false,'class'=>'form-control','placeholder'=>'Pincode','div'=>false));?>
                </div>                
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Nationality:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('nationality',array('label' => false,'class'=>'form-control','placeholder'=>'Nationality','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Pan:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('pan',array('label' => false,'class'=>'form-control','placeholder'=>'Pan Number','div'=>false));?>
                </div>                
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Date of Birth:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('dob',array('minYear'=>date('Y')-100,'maxYear'=>date('Y')-18,'label' => false,'class'=>'input-sm','dateFormat'=>'DMY','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Occupation with detail:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('occupation',array('label' => false,'class'=>'form-control','placeholder'=>'Occupation with detail','div'=>false));?>
                </div>   
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Mobile:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('phone',array('label' => false,'class'=>'form-control','placeholder'=>'Mobile','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Email:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>'Email','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Photo:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('photo',array('label' => false,'type'=>'file','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Identity Proof:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('id_proof',array('label' => false,'type'=>'file','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Address Proof:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('address_proof',array('label' => false,'type'=>'file','div'=>false));?>
                </div>
            </div>
             <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Co-Applicant:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('coapplicant',array('type'=>'radio','options'=>array("1"=>__('Yes'),"0"=>__('No')),'default'=>'0','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                </div>                
            </div>
            
            </div>
            </div>           
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>