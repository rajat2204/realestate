<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->Html->charset(); ?>
	<title>Installation Step 2</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
                echo $this->Html->css('style');
                echo $this->Html->css('validationEngine.jquery');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
                echo $this->Html->script('jquery-1.8.2.min');
		echo $this->Html->script('html5shiv');
                echo $this->Html->script('respond.min');                
                echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');		
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();		
?>
<script>
	jQuery(document).ready(function(){
	// binds form submission and fields to the validation engine
	jQuery("#post_req").validationEngine();
	$("#checkme").click(function() {
        $("#submitaccept").attr("disabled", !this.checked);
      });
        });
	</script>
</head>
  <body>
	<div class="container">
		<div class="row">	
			<div  class="col-md-12 mrg">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo$this->Html->image('logo-website.fw.png',array('alt'=>'real','class'=>'img-responsive'));?></div>
					<?php echo $this->Form->create('Installer',array('controller' => 'Installer','action'=>'step2','name'=>'post_req','id'=>'post_req'));?>
                                        <div class="panel-body">
					  <?php echo $this->Session->flash();?>
						<p class="btn btn-warning">Step 2 of 4</p>
						<h4>Agreement</h4>
						<div style="max-height:300px; overflow-y:auto">  
						
<p>
You are not allowed to use the extension on more than one domain; we provide support only for the domain you've registered with us, for the length of your subscription. </p>
Our forum support will check that you have an active license before it allows you to post a forum question/read forum answers.<p>
<p>You are allowed to make any changes to the code; however modified code will not be supported by us. </p>

						</div>
			
                                                <?php echo$this->Form->input('accept',array('type'=>'checkbox','id'=>'checkme','label'=>'I Accept to Proceed','hiddenField'=>false));?>
						<?php echo$this->Form->button('Submit',array('class'=>'btn btn-success','id'=>'submitaccept','disabled'=>'disabled'));?>
                                                <?php echo$this->Form->end(null);?>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="container">
		<div class="panel panel-success">
			<div class="panel-footer">
				<div class="row">					
					
			</div>
		</div>
	</div>
  </body>
</html>