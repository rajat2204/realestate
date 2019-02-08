<header id="head" class="secondary">
       <div class="container">
	   <div class="row">
	       <div class="col-sm-8">
		       <h1>Forgot Password</h1>
	       </div>
	   </div>
       </div>
   </header>
    
    <section class="container">
        <div class="row">
	<section class="col-sm-8 col-sm-offset-2 maincontent mrg">
            <?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Forgot', array( 'controller' => 'Forgots', 'action' => 'password','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','role'=>'form'));?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Email :</label>
                    <div class="col-sm-9">
                    <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control validate[required,custom[email]]','placeholder'=>'Email','div'=>false));?>
                    </div>
                </div>
                <div class="col-md-12">
					<div class="col-md-4 col-sm-offset-3">                                        
						<button type="submit" class="btn btn-primary btn-sm">&nbsp;Submit</button>
					</div>
					<div class="col-md-5">
						<?php echo$this->Html->link('Login',array('controller'=>'Users','action'=>'login'),array('class'=>'btn btn-sm'));?>
					</div>
				</div>				
                        <?php echo$this->Form->end(null);?>
           </div>
		
			
		</section>
        </div>
    </section>
    
