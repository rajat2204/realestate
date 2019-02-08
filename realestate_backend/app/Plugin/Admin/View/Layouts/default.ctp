<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-translate-customization" content="839d71f7ff6044d0-328a2dc5159d6aa2-gd17de6447c9ba810-f">
	<?php echo $this->Html->charset();?>
	<title>
		<?php echo $siteTitle;?>
	</title>
	<meta name="description" content="<?php echo$siteDescription;?>"/>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('style');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('/design300/assets/css/styles.min');
		echo $this->Html->css('/design300/assets/css/glyphicons.min');
		echo $this->Html->css('/design300/assets/css/font-awesome.min');
		echo $this->Html->css('validationEngine.jquery');
		echo $this->Html->css('bootstrap-multiselect');
		echo $this->Html->css('bootstrap-datetimepicker.min');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
                echo $this->Html->script('jquery-1.11.1.min');
		echo $this->Html->script('/design300/assets/js/less');		              
                echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');
		echo $this->Html->script('/design300/assets/js/enquire');
		echo $this->Html->script('/design300/assets/js/jquery.cookie');
		echo $this->Html->script('/design300/assets/js/jquery.nicescroll.min');
		echo $this->Html->script('/design300/assets/js/application');
		echo $this->Html->script('bootstrap-multiselect');
		echo $this->Html->script('moment-with-locales');
		echo $this->Html->script('bootstrap-datetimepicker.min');
		echo $this->Html->script('main.custom.min');
		echo $this->Html->script('waiting-dialog.min');
		echo $this->Html->script('print');
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();
		$UserArr=$this->Session->read('User');
?>
<?php if($translate>0){?>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php }?>
</head>
    <?php if($this->Session->check('User')){?>
    <body class="">
    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>
        
	<div class="navbar-header pull-left">
	  <a class="navbar-brand" href="#"><?php echo$siteName;?></a>
        </div>

         <ul class="nav navbar-nav pull-right toolbar">
        	<li class="dropdown">
        		<a href="#" class="dropdown-toggle username" data-toggle="dropdown"><i class="fa fa-user"></i><span class="hidden-xs"><?php echo $UserArr['User']['name'];?> <i class="fa fa-caret-down"></i></span></a>
        		<ul class="dropdown-menu userinfo arrow">
        			<li class="username">
                        <a href="#">
        				    <div class="pull-left"><i class="fa fa-user"></i></div>
        				    <div class="pull-right"><h5><?php echo $UserArr['User']['name'];?>!</h5><small>Logged in as <span><?php echo $UserArr['User']['username'];?></span></small></div>
                        </a>
        			</li>
        			<li class="userlinks">
        				<ul class="dropdown-menu">
        					<li><?php echo $this->Html->link('My Profile&nbsp;<i class="pull-right fa fa-pencil"></i>',array('controller' => 'Users','action' => 'myProfile'),array('escape' => false));?></li>
						<li><?php echo $this->Html->link('Change Password&nbsp;<i class="pull-right fa fa-cog"></i>',array('controller' => 'Users','action' => 'changePass'),array('escape' => false));?></li>
						<li class="divider"></li>
						<li><?php echo $this->Html->link('Sign Out&nbsp;<i class="pull-right fa fa-power-off"></i>',array('controller' => 'Users','action' => 'logout'),array('escape' => false));?></li>						
        				</ul>
        			</li>
        		</ul>
        	</li>        	
		</ul>
    </header>
    <div id="page-container">
	    <nav id="page-leftbar" role="navigation">
                <!-- BEGIN SIDEBAR MENU -->
            <?php echo $this->MenuBuilder->build('sidebar');?>
	    </nav>
	<div id="page-content">
	  <div id="wrap">
	    <div class="container">
            <div class="row">
	      <div class="col-xs-12">
	    <?php echo $this->fetch('content');?>
	      </div>
	  </div>
	</div>
	    </div>
	</div>
    </div>
    
        <?php } else{?>
	<body class="focusedform">
	<div class="verticalcenter">
	<?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'img-responsive'));}
	    echo $this->fetch('content');
	  }?>
</body>
</html>