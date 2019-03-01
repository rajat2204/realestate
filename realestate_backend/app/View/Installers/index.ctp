<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->Html->charset(); ?>
	<title>Step 1</title>
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
</head>
  <body>
	<div class="container">
		<div class="row">	
			<div  class="col-md-12 mrg">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo$this->Html->image('logo-website.fw.png',array('alt'=>'Edu Expression','class'=>'img-responsive'));?></div>
					<?php echo $this->Form->create('Installer',array('controller' => 'Installer','action'=>'step1','name'=>'post_req','id'=>'post_req'));?>
                                        <div class="panel-body">
					  <?php echo $this->Session->flash();?>
						<p class="btn btn-warning">Step 1 of 4</p>
						<h3>Requirements</h3>
						<div class="row">
						  <div class="col-md-6">
						    <div class="panel panel-default">
						      <div class="panel-heading"><span class="glyphicon glyphicon-wrench"></span> 
							<div class="panel-body">
							  
							please check below and compare with your server current statues on the right. 
							  <div class="table-responsive">
							    <table class="table table-striped">
							      <thead>
								<tr>
								  <th><span class="text-primary">Extensions &amp; Applications</span></th>
								  <th><span class="text-primary">&nbsp;</span></th>
								</tr>
							      </thead>
							      <tbody>
								<tr>
								  <td>HTTP Server. For example: Apache</td>
								  <td><span class="label label-success">Require</span></td>
								</tr>
								<tr>
								  <td>PHP 5.2.8 or greater</td>
								  <td><span class="label label-success">Require</span></td>
								</tr>
								<tr>
								  <td>Database Engine MySQL (4 or greater)</td>
								  <td><span class="label label-success">Require</span></td>
								</tr>
								<tr>
								  <td>PDO Extension</td>
								  <td><span class="label label-success">Require</span></td>
								</tr>
								<tr>
								  <td>GD Extension</td>
								  <td><span class="label label-warning">Mandatory</span></td>
								</tr>
							      </tbody>							  
							  </table>
							</div>
						      </div>
						    </div>
						  </div>
						    <div class="col-md-6">
						    <div class="panel panel-default">
						      <div class="panel-heading"><span class="glyphicon glyphicon-cog"></span> <strong>Status</strong></div>
							<div class="panel-body">							  
							  <div class="table-responsive">
							    <table class="table table-striped">
							      <thead>
								<tr>
								  <th><span class="text-primary">Extensions &amp; Applications</span></th>
								  <th><span class="text-primary">&nbsp;</span></th>
								</tr>
							      </thead>
							      <tbody>
								<tr>
								  <td>Web Server</td>
								  <td><span class="label label-default"><?php $wsarr=explode(" ",$_SERVER['SERVER_SOFTWARE']); echo$wsarr[0];?></span></td>
								</tr>
								<tr>
								  <td>PHP Version</td>
								  <td><?php $phpversion=phpversion(); if($phpversion>="5.2.8"){?><span class="label label-success"><?php echo phpversion();?></span><?php }else{?><span class="label label-warning"><?php echo $phpversion;?></span><?php }?></td>
								</tr>
								<tr>
								  <td>MYSQL Version</td>
								  <td><span class="label label-success"><?php echo$mysqlversion;?></span></td>
								</tr>
								<tr>
								  <td>PDO Extension</td>
								  <td><?php if (!defined('PDO::ATTR_DRIVER_NAME')){?><span class="label label-danger">PDO Unavailable</span><?php }else{?><span class="label label-success">PDO Available</span><?php }?></td>
								</tr>
								<tr>
								  <td>GD Extension</td>
								  <td><?php if (extension_loaded('gd') && function_exists('gd_info')) {?><span class="label label-success">GD Availiable</span><?php } else{?><span class="label label-warning">GD Unavailiable</span><?php }?></td>
								</tr>
							      </tbody>							  
							  </table>
							</div>
						      </div>
						    </div>
						  </div>
						</div>
						<div class="row">
						<div class="col-md-12">
						    <div class="panel panel-default">
						      <div class="panel-heading"><span class="glyphicon glyphicon-folder-open"></span> <strong>&nbsp;Directory &amp; File Permission</strong></div>
						      <div class="panel-body">
							<p>These Folders of Files need to be <span class="label label-success">Writable</span> for application to be installed.</p>
							  <div class="table-responsive">
							    <table class="table table-striped">
							      <thead>
								<tr>
								  <th><span class="text-primary">Folders or Files</span></th>
								  <th><span class="text-primary">&nbsp;</span></th>
								</tr>
							      </thead>
							      <tbody>
								<tr>
								  <td>app/tmp/</td>
								  <td><?php echo$tmpfile;?></td>
								</tr>
								<tr>
								  <td>app/Config/database.php</td>
								  <td><?php echo$dbfile;?></td>
								</tr>
								<tr>
								  <td>app/Config/core.php</td>
								  <td><?php echo$corefile;?></td>
								</tr>							
							      </tbody>							  
							  </table>
							</div>
						      </div>
						    </div>
						  </div>
						</div>
						
						<?php echo$this->Html->Link('Refresh',array('action'=>'index'),array('class'=>'btn btn-default'));?>
                                               <?php echo$this->Form->button("Let's Start",array('class'=>'btn btn-success'));?>
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