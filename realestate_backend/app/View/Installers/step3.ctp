<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->Html->charset(); ?>
	<title>Installation Step 4</title>
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
					<div class="panel-heading"><?php echo$this->Html->image('logo-website.fw.png',array('alt'=>'Edu Expression','class'=>'img-responsive'));?></div>
					<?php echo $this->Form->create('Installer',array('controller' => 'Installer','action'=>'step3','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                                        <div class="panel-body">
					  <?php echo $this->Session->flash();?>
					  <p class="btn btn-warning">Step 4 of 4</p>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Site Name</label>
								<div class="col-sm-10">
								  <?php echo$this->Form->input('name',array('class'=>'form-control validate[required]','label'=>false,'placeholder'=>'Name of Your Website'));?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Domain Name</label>
								<div class="col-sm-10">
								  <?php echo$this->Form->input('domain_name',array('class'=>'form-control validate[required]','label'=>false,'placeholder'=>'http://yourdomain.com'));?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Time Zone</label>
								<div class="col-sm-10">
								<?php echo$this->Form->select('timezone',$timezones,array('empty'=>'Please Select Timezone','class'=>'form-control validate[required]','label'=>false));?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Organization Name</label>
								<div class="col-sm-10">
								<?php echo$this->Form->input('organization_name',array('class'=>'form-control validate[required]','label'=>false,'placeholder'=>'Name of Your Organization/Company'));?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Organization Email</label>
								<div class="col-sm-10">
								<?php echo$this->Form->input('email',array('class'=>'form-control validate[required]','label'=>false,'placeholder'=>'Default Admin Email'));?>
								</div>
							</div>
							<div class="checkbox col-md-offset-2">
							  <label>
								<input type="checkbox" value="">
								<?php echo$this->Form->checkbox('installdata');?>Install Sample Data With Dummy Entries
							  </label>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
								<?php echo$this->Form->hidden('step3');?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
								<?php echo$this->Form->hidden('step3');?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								  <?php echo$this->Form->button('Install',array('class'=>'btn btn-success'));?>
								</div>
							</div>                                                
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
	</div>
  </body>
</html>