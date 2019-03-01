<?php echo $this->Session->flash();?>
<div class="row">
    <div class="col-md-12">    
        <div class="panel panel-default">
        <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title">Change <span>Password</span></h4>
			</div>
		</div>            
                <div class="panel-body">
                <?php echo $this->Form->create('User', array( 'controller' => 'Users', 'action' => 'changePass','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                     <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label">Old Password</label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('oldPassword',array('type'=>'password','id'=>'oldPassword','value'=>'','label' => false,'class'=>'form-control input-sm validate[required,minSize[4],maxSize[15]]','placeholder'=>'Old Password','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('password',array('id'=>'password','value'=>'','label' => false,'class'=>'form-control validate[required,minSize[4],maxSize[15]]','placeholder'=>'Password','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('con_password',array('type'=>'password','value'=>'','label' => false,'class'=>'form-control validate[required,minSize[4],maxSize[15],equals[password]]','placeholder'=>'Confirm Password','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span>&nbsp;Update</button>                            
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
    </div>