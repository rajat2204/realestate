<script type="text/javascript">
$(document).ready(function(){
$(".inlinefancy").fancybox({
	'titlePosition'	: 'inside',
	'transitionIn'	: 'none',
	'transitionOut'	: 'none'
});
});
</script>
	<header id="head" class="secondary">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h1>Contact Us</h1>
				</div>
			</div>
		</div>
	</header>
	<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-6 mrg"><?php echo $this->Session->flash();?>
					<?php echo $this->Form->create('Contact', array( 'controller' => 'Contacts', 'action' => 'index','class'=>'form-light mt-20','id'=>'post_req','role'=>'form'));?>
                			<div class="form-group">
								<label>Name</label>
								<?php echo $this->Form->input('name',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>'Your name','div'=>false));?>
                    							
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label>Email</label>
									<?php echo $this->Form->input('email',array('required'=>true,'type'=>'email','label' => false,'class'=>'form-control','placeholder'=>'Email','div'=>false));?>
                    							</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone</label>
										<?php echo $this->Form->input('phone',array('label' => false,'class'=>'form-control','placeholder'=>'phone/Mobile','div'=>false));?>
                    							
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Subject</label>
								<?php echo $this->Form->input('subject',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>'Subject','div'=>false));?>
                    							
							</div>
							<div class="form-group">
								<label>Message</label>
								<?php echo $this->Form->textarea('message',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>'Write you message here...','div'=>false,'style'=>'100px'));?>
                    					</div>
							<button type="submit" class="btn btn-two">Send message</button><p><br/></p>
						<?php echo$this->Form->end(null);?>
					</div>
					<?php echo$contactValue;?>
				</div>
			</div>
	<!-- /container -->

	
	