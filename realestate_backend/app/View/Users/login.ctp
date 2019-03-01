<header id="head" class="secondary">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
			<center><h1>Client Login</h1></center>
		</div>
            </div>
        </div>
    </header>
    
    <section class="container">
        <div class="row">
	<section class="col-sm-8 col-sm-offset-2 maincontent mrg">
<?php echo $this->Session->flash();?>
			<?php echo $this->Form->create('User', array( 'controller' => 'Users', 'action' => 'login','name'=>'post_req','id'=>'post_req'));?>
				<div class="form-group">
					<div class="row">
						<label for="admin_id" class="col-sm-12 control-label">Email Id :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control validate[required]','placeholder'=>'Email Id','div'=>false));?>
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
				<div class="col-md-12">
					<div class="col-md-4">                                        
						<button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-sign-in"></span>&nbsp;Login</button>
					</div>
					<div class="col-md-6">
						<?php echo$this->Html->link('Forgot Password',array('controller'=>'Forgots','action'=>'password'),array('class'=>'btn btn-sm'));?>
					</div>
				</div>				
                        <?php echo$this->Form->end(null);?>
		</div>
		
			
		</section>
        </div>
    </section>
    
