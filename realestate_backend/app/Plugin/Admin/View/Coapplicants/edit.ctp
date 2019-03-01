<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        });
</script>
<div class="container">
<div class="row">
<?php echo $this->Session->flash();?>
    <div class="col-md-12">
        <div class="panel panel-default mrg">
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Edit <span>Co-Applicants</span></strong></h4><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div></div>
                <div class="panel-body">
					<?php echo $this->Form->create('Coapplicant', array( 'controller' => 'Coapplicants','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
					<?php foreach ($Coapplicant as $k=>$post): $id=$post['Coapplicant']['id'];$form_no=$k;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger">Form <?php echo$form_no?></small></strong></div>
							<div class="panel-body">
								<div class="panel panel-default">
            <div class="panel-heading"><strong>Applicant Information</strong></div>
            <div class="panel-body">
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Name of the Applicant:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.name",array('label' => false,'class'=>'form-control','placeholder'=>'Name of the Applicant','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Father's Husband Name:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.father_name",array('label' => false,'class'=>'form-control','placeholder'=>'Father\'s Husband Name','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Address:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.address",array('label' => false,'class'=>'form-control','placeholder'=>'Address','div'=>false));?>
                </div>    
                <label for="group_name" class="col-sm-2 control-label"><small>District:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.district",array('label' => false,'class'=>'form-control','placeholder'=>'District','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>State:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.state",array('label' => false,'class'=>'form-control','placeholder'=>'State','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Pincode:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.pincode",array('label' => false,'class'=>'form-control','placeholder'=>'Pincode','div'=>false));?>
                </div>                
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Nationality:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.nationality",array('label' => false,'class'=>'form-control','placeholder'=>'Nationality','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Pan:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.pan",array('label' => false,'class'=>'form-control','placeholder'=>'Pan Number','div'=>false));?>
                </div>                
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Date of Birth:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.dob",array('minYear'=>date('Y')-100,'maxYear'=>date('Y')-18,'label' => false,'class'=>'input-sm','dateFormat'=>'DMY','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Occupation with detail:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.occupation",array('label' => false,'class'=>'form-control','placeholder'=>'Occupation with detail','div'=>false));?>
                </div>   
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Mobile:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.phone",array('label' => false,'class'=>'form-control','placeholder'=>'Mobile','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Email:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.email",array('label' => false,'class'=>'form-control','placeholder'=>'Email','div'=>false));?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Photo:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.photo",array('label' => false,'type'=>'file','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Identity Proof:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.id_proof",array('label' => false,'type'=>'file','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Address Proof:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Coapplicant.address_proof",array('label' => false,'type'=>'file','div'=>false));?>
                </div>
            </div>
	    
            </div>
            </div>
                      
			<div class="form-group text-left">
			    <div class="col-sm-offset-3 col-sm-7">
			    <?php echo $this->Form->input("$k.Coapplicant.id",array('type' => 'hidden'));?>
			    </div>
			</div>
							</div>
						</div>						
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> Update</button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button><?php }?>
                        </div>
                    </div>
		    <?php echo$this->Form->input('clientId',array('type'=>'hidden','name'=>'clientId','value'=>$clientId));?>
                <?php echo$this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>