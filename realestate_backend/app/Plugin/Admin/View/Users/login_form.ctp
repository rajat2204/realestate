<div class="panel panel-primary">
		<div class="panel-body">
			<h4 class="text-center">Admin Control Panel</h4>
<?php echo $this->Session->flash();?>
			<?php echo $this->Form->create('User', array( 'controller' => 'Users', 'action' => 'login_form','name'=>'post_req','id'=>'post_req'));?>
				<div class="form-group">
					<div class="row">
						<label for="admin_id" class="col-sm-12 control-label">Admin Username :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <?php echo $this->Form->input('username',array('label' => false,'class'=>'form-control validate[required]','placeholder'=>'Admin Username','div'=>false));?>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="pass" class="col-sm-12 control-label">Password :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<?php echo $this->Form->input('password',array('label' => false,'class'=>'form-control validate[required,minSize[4],maxSize[15]]','placeholder'=>'Password','div'=>false));?>
					</div>
				</div>
				<div class="form-group col-md-12">
					<div class="row">                                        
						<button type="submit" class="btn btn-primary btn-block"><span class="fa fa-sign-in"></span>&nbsp;Login</button>
					</div>
				</div>				
                        <?php echo$this->Form->end();?>
		</div>
		<div class="panel-footer">
			<?php echo$this->Html->link('Forgot Password',array('controller'=>'Forgots','action'=>'password'));?>			
			<div class="pull-right">
				<?php echo$this->Html->link('Forgot User Name',array('controller'=>'Forgots','action'=>'username'));?>
			</div>
		</div>
	</div>