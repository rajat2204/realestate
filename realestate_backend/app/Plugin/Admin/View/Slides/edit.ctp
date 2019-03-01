<div <?php if(!$isError){?>class="container"<?php }?>>

    <div class="panel panel-custom mrg">
        <div class="panel-heading">Edit Slides <?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
					<?php echo $this->Form->create('Slide', array('class'=>'form-horizontal','type'=>'file'));?>
					<?php foreach ($Slide as $k=>$post): $id=$post['Slide']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger">Form <?php echo$form_no?></small></strong></div>
							<div class="panel-body">
								<div class="form-group">
									<label for="group_name" class="col-sm-3 control-label">Slide Name</label>
									<div class="col-sm-9">
									   <?php echo $this->Form->input("$k.Slide.slide_name",array('label' => false,'class'=>'form-control','placeholder'=>'Slide Name','div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-3 control-label">Ordering</label>
									<div class="col-sm-9">
									   <?php echo $this->Form->input("$k.Slide.ordering",array('label' => false,'class'=>'form-control','placeholder'=>'Ordering Name','div'=>false));?>
									</div>
								</div>
								<div class="form-group">
								    <label for="group_name" class="col-sm-3 control-label">Status</label>
								    <div class="col-sm-9">
									<?php echo $this->Form->select("$k.Slide.status",array("Active"=>"Active","Suspend"=>"Suspend"),array('empty'=>null,'label' => false,'class'=>'form-control','div'=>false));?>
								    </div>
								</div>
								
								<div class="form-group text-left">
									<div class="col-sm-9">
										<?php echo $this->Form->input("$k.Slide.id", array('type' => 'hidden'));?>                            
									</div>
								</div>
							</div>	
						</div>						
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">                            
                            <?php echo$this->Form->button('<span class="fa fa-refresh"></span> Update',array('class'=>'btn btn-success','escpae'=>false));?>
			    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button><?php }else{
			    echo$this->Html->link('<span class="fa fa-close"></span> Close',array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
			</div>
                    </div>
                <?php echo $this->Form->end();?>
        </div>
    </div>
</div>