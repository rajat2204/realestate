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
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Edit <span>Vendors / Staff</span></h4><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div></div>
                <div class="panel-body">
					<?php echo $this->Form->create('Vendor', array( 'controller' => 'Vendors','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Vendor as $k=>$post): $id=$post['Vendor']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger">Form <?php echo$form_no?></small></strong></div>
		  <div class="panel-body">
		    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small>Name:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Vendor.name",array('label' => false,'class'=>'form-control','placeholder'=>'Name','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small>Address:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Vendor.address",array('label' => false,'class'=>'form-control','placeholder'=>'Address','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small>Contact:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Vendor.contact",array('label' => false,'class'=>'form-control','placeholder'=>'Contact','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small>Licence No.:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Vendor.licence_no",array('label' => false,'class'=>'form-control','placeholder'=>'Licence No.','div'=>false));?>
                        </div>
                    </div>
		      <div class="form-group text-left">
			  <div class="col-sm-offset-4 col-sm-6">
			      <?php echo $this->Form->input("$k.Vendor.id",array('type' => 'hidden'));?>
			  </div>
		      </div>
		  </div>
		</div>
                    <?php endforeach;?>
                        <?php unset($post);?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-4 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> Update</button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button><?php }?>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>