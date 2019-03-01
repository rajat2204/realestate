      <section class="container">
      <div class="row">
          
          <header id="front-head">
		<div class="container">
					<div class="fluid-container" style="padding-top:15px;">
                       <!--front page-->
                             <div class="row">
                                  <div class="col-md-12">
                                      <div class="col-md-6">
                                       <div class="panel panel-default" style="background:#ddd;">
                                <div class="panel-heading" style="background:#428bca;color:white;">Admin Login</div>
                                 <div class="panel-body">
                                     <br>
                                    <span>
                                        <i class="fa fa-user" style="font-size: 60px;
    color: black;"></i>
                                    </span>
                                       <br>
                                     <?php
                                           
	 echo$this->Html->link('Login As Admin',array('controller'=>'admin','action'=>'users'),array('class'=>'btn btn-primary','target'=>'_self','title'=>'login as admin','escape'=>false));
                                           ?>
                                 </div>
                                 </div>
                                    </div><!--col-md-6-->
                                    
                                    <div class="col-md-6">
                                       <div class="panel panel-default" style="background:#ddd;">
                                <div class="panel-heading" style="background:#428bca;color:white;">Client Login</div>
                                 <div class="panel-body">
                                     <br>
                                    <span>
                                        <i class="fa fa-user" style="font-size: 60px;
    color: black;"></i>
                                    </span>
                                       <br>
                                           <?php
                                           
	 echo$this->Html->link('Login As Client',array('controller'=>'Users','action'=>'login'),array('class'=>'btn btn-primary','target'=>'_self','title'=>'login as client','escape'=>false));
                                           ?>
                                       
                                    
                                 </div>
                                 </div>
                                    </div><!--col-md-6-->
                                  </div><!--col-md-8-->
                             </div>
                             
                        <!--end front page-->
                        
                        
                </div><!--fluid-container -->
		</div>
	</header>
          
      	<!--div class="col-md-4"><div class="title-box clearfix "><h2 class="title-box_primary"><? if($contentValue){?>About Us<?php }?></h2></div> 
        <p><span>
	<?php if($contentValue)
	{ echo substr($contentValue['Content']['main_content'],0,282);
	 echo$this->Html->link('read more',array('controller'=>'Contents','action'=>'pages',$contentValue['Content']['page_url']),array('class'=>'btn-inline','target'=>'_self','title'=>'read more','escape'=>false));
	}?>
	</div-->
	
	
        
         
         
         
      