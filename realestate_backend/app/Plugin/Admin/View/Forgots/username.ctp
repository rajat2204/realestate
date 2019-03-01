    <div class="col-md-13">    
        <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <div class="widget">
                <h4 class="widget-title">Forgot <span>Username</span></h4>
            </div>
        </div>        
                <div class="panel-body">
            <?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Forgot', array( 'controller' => 'Forgots', 'action' => 'username','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','role'=>'form'));?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Email :</label>
                    <div class="col-sm-9">
                    <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control validate[required,custom[email]]','placeholder'=>'Email','div'=>false));?>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-sm-offset-3 col-sm-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>                         
                <?php echo$this->Form->end();?>
                <div class="panel-footer">
			<?php echo$this->Html->link('Forgot Password',array('controller'=>'Forgots','action'=>'password'));?>			
			<div class="pull-right">
				<?php echo$this->Html->link('Login',array('controller'=>'Users','action'=>'login_form'));?>
			</div>
		</div>
            </div>
        </div>
    </div>
