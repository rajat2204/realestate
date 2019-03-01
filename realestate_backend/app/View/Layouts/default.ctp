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
<?php if($this->Session->check('frontUser')){?>
<!DOCTYPE html>  
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-translate-customization" content="839d71f7ff6044d0-328a2dc5159d6aa2-gd17de6447c9ba810-f"></meta>
	<?php echo $this->Html->charset();?>
	<title>
		<?php echo $siteTitle;?>
	</title>
	<meta name="description" content="<?php echo$siteDescription;?>"/>
	
		<?php echo $this->Html->meta('icon');
		echo $this->Html->css('style');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('/design300/assets/css/styles.min');
		echo $this->Html->css('/design300/assets/css/glyphicons.min');
		echo $this->Html->css('/design300/assets/css/font-awesome.min');
		echo $this->Html->css('validationEngine.jquery');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
                echo $this->Html->script('jquery-1.8.2.min');
		echo $this->Html->script('/design300/assets/js/less');		              
                echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');
		echo $this->Html->script('/design300/assets/js/enquire');
		echo $this->Html->script('/design300/assets/js/jquery.cookie');
		echo $this->Html->script('/design300/assets/js/jquery.nicescroll.min');
		echo $this->Html->script('/design300/assets/js/application');
		echo $this->Html->script('custom.min');
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();
		$UserArr=$this->Session->read('frontUser');
 ?>
<?php if($translate>0){?>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php }?>
</head>
    <body class="">
    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>
        
	<div class="navbar-header pull-left">
	  <a class="navbar-brand" href="#"><?php echo$siteName;?></a>
        </div>

        <div class="navbar-header pull-right"><a class="navbar-brand" href="#"><?php echo $UserArr['User']['name'];?></a></div>
    </header>
    <div id="page-container">
	    <nav id="page-leftbar" role="navigation">
                <!-- BEGIN SIDEBAR MENU -->
            <ul class="acc-menu" id="sidebar">
	      <?php foreach ($menuArr as $menu):
	      $menuIcon=$menu['Page']['icon'];$menuName=$menu['Page']['model_name'];?>
	      <li <?php echo (strtolower($this->params['controller'])==strtolower($menu['Page']['controller_name']) || in_array(strtolower($this->params['controller']),explode(",",strtolower($menu['Page']['sel_name']))))?"class=\"active\"":"";?>><?php echo $this->Html->link("<i class=\"$menuIcon\"></i>&nbsp;<span>$menuName</span>",array('controller' => $menu['Page']['controller_name'],'action'=>$menu['Page']['action_name']),array('escape' => false));?></li>
	      <?php endforeach;unset($menu);?>
	    </ul> 
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
    

</div> <!-- page-container -->
    </body>
</html>
        <?php } else{?>
<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-translate-customization" content="839d71f7ff6044d0-328a2dc5159d6aa2-gd17de6447c9ba810-f"></meta>
	<?php echo $this->Html->charset();?>
	<title>
		<?php echo $siteTitle;?>
	</title>
	<meta name="description" content="<?php echo$siteDescription;?>"/>
		<?php echo $this->Html->meta('icon');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:300,400,700');
		echo $this->Html->css('/design900/assets/css/bootstrap.min.css');
		echo $this->Html->css('/design900/assets/css/font-awesome.min.css');
		echo $this->Html->css('/design900/assets/css/bootstrap-theme.css');
		echo $this->Html->css('/design900/assets/css/style.css');
		echo $this->Html->css('/design900/assets/css/camera.css');
		echo $this->Html->css('/design900/assets/js/fancybox/jquery.fancybox.css');
		echo $this->Html->css('validationEngine.jquery');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
		echo $this->Html->script('jquery-1.8.2.min');
		echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');
		echo $this->Html->script('/design900/assets/js/modernizr-latest.js');		              
                echo $this->Html->script('/design900/assets/js/fancybox/jquery.fancybox.pack.js');
		echo $this->Html->script('/design900/assets/js/jquery.mobile.customized.min.js');
		echo $this->Html->script('/design900/assets/js/jquery.easing.1.3.js');
		echo $this->Html->script('/design900/assets/js/camera.min.js');
		echo $this->Html->script('/design900/assets/js/bootstrap.min');
		echo $this->Html->script('/design900/assets/js/custom.js');
		echo $this->Html->script('custom.min');
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();
?>   
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="design900/assets/js/html5shiv.js"></script>
	<script src="design900/assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<!-- Fixed navbar -->

	<!-- /.navbar -->

	<!-- Header -->
	<?php if($frontSlides==1 && $this->params['controller']==""){?>
	<header id="front-head">
		<div class="container">
					<div class="fluid_container">
                    
                </div><!-- .fluid_container -->
		</div>
	</header>
	<?php }?>
	<!-- /Header -->
<div>
   <section class="news-box top-margin">
        <div class="container">
  <?php echo $this->fetch('content');?>
   </div>
      </section>
</div>
      
    	 
    
    <?php if($frontSlides==1 && $this->params['controller']==""){?>
	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    <script>
		jQuery(function(){
			
			jQuery('#camera_wrap_4').camera({
				height: '600',
				loader: 'bar',
				pagination: false,
				thumbnails: false,
				hover: false,
				opacityOnGrid: false
			});

		});
	</script>
    <?php }?>
	
</body>
</html>
<?php  }?>