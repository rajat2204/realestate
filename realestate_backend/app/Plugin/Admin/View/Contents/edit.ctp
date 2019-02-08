<div <?php if(!$isError){?>class="container"<?php }?>>    
    <div class="panel panel-custom mrg">
        <div class="panel-heading">Edit Pages<?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
<div class="panel">
     <div class="panel-body"><?php echo $this->Session->flash();?>
					<?php echo $this->Form->create('Content', array( 'controller' => 'Contents','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Content as $k=>$post): $id=$post['Content']['id'];$form_no=$k+1;?>
					<script type="text/javascript">
					$(document).ready(function(){
					    <?php if($post['Content']['is_url']=="External"){?>
					    $('#pgurl<?php echo$id;?>').hide();<?php }else{?>
					    $('#pgurl1<?php echo$id;?>').hide();<?php }?>
					    $( "#ContentIsUrl<?php echo$id;?>Internal" ).click(function() {
					    $('#pgurl<?php echo$id;?>').show();
					    $('#pgurl1<?php echo$id;?>').hide();
					    });
					    $( "#ContentIsUrl<?php echo$id;?>External" ).click(function() {
					    $('#pgurl<?php echo$id;?>').hide();
					    $('#pgurl1<?php echo$id;?>').show();
					    });
					    $( "#ContentLinkName<?php echo$id;?>").blur(function() {
						var link_name=$('#ContentLinkName<?php echo$id;?>').val();
						var link_url=link_name.replace(/ /g,"-");
					    $('#ContentPageUrl<?php echo$id;?>').val(link_url);
					    });
					      });
				    </script>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger">Form <?php echo$form_no?></small></strong></div>
							<div class="panel-body"><?php echo $this->Session->flash();?>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label">Link Name</label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.Content.link_name",array('id'=>"ContentLinkName$id",'label' => false,'class'=>'form-control','placeholder'=>'Link Name','div'=>false));?>
									</div>
									<label for="group_name" class="col-sm-2 control-label">Link Order</label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.Content.ordering",array('label' => false,'class'=>'form-control','placeholder'=>'Link Order','div'=>false));?>
									</div>
								</div>
								 <div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><small>Page Type</small></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.Content.is_url$id",array('type'=>'radio','options'=>array("Internal"=>"Internal","External"=>"External"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
								    </div>
								</div>
								 <div class="form-group" id="pgurl1<?php echo$id;?>">
								    <label for="group_name" class="col-sm-2 control-label"><small>External Url</small></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.Content.url",array('label' => false,'class'=>'form-control','placeholder'=>'External Url','div'=>false));?>
								    </div>
								    <label for="group_name" class="col-sm-2 control-label"><small>Url Target</small></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.Content.url_target",array('type'=>'radio','options'=>array("_self"=>"_self","_blank"=>"_blank"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
								    </div>
								</div>
								<div id="pgurl<?php echo$id;?>">
								 <div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><small>Page Name</small></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.Content.page_name",array('label' => false,'class'=>'form-control','placeholder'=>'Page Name','div'=>false));?>
								    </div>
								    <label for="group_name" class="col-sm-2 control-label"><small>Page Url</small></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.Content.page_url",array('id'=>"ContentPageUrl$id",'label' => false,'class'=>'form-control input-sm validate[required]','data-errormessage'=>'Page Url Required','placeholder'=>'Page Url','div'=>false));?>
								    </div>
								</div>
								<div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><small>Page Content</small></label>
								    <div class="col-sm-10">
								       <?php echo $this->Tinymce->input("$k.Content.main_content", array('id'=>$id,'class'=>'form-control','label' => false),array('language'=>'en'),'full');?>
								    </div>
								</div>
								</div>
								<div class="form-group text-left">
									<div class="col-sm-offset-3 col-sm-7">
										<?php echo $this->Form->input("$k.Content.id", array('type' => 'hidden'));?>                            
									</div>
								</div>
							</div>	
						</div>					
                    <?php endforeach; ?>
                        <?php unset($post); ?>
    
                        <div class="form-group text-left">
		<div class="col-sm-offset-2 col-sm-5">
		    <?php echo$this->Form->button('<span class="fa fa-refresh"></span> Update',array('class'=>'btn btn-success','escpae'=>false));?>
			    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button><?php }else{
			    echo$this->Html->link('<span class="fa fa-close"></span> Close',array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
	</div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
	    
    </div>