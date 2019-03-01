<script type="text/javascript">
    $(document).ready(function(){
	$('#pgurl1').hide();
	$( "#ContentIsUrlInternal" ).click(function() {
	$('#pgurl').show();
	$('#pgurl1').hide();
	});
	$( "#ContentIsUrlExternal" ).click(function() {
	$('#pgurl').hide();
	$('#pgurl1').show();
	});
	$( "#ContentLinkName").blur(function() {
	    var link_name=$('#ContentLinkName').val();
	    var link_url=link_name.replace(/ /g,"-");
	$('#ContentPageUrl').val(link_url);
	});
	  });
</script>

<div class="page-title"> <div class="title-env"> <h1 class="title">Add Pages</h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Content', array( 'controller' => 'Contents', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small>Link Name</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('link_name',array('label' => false,'class'=>'form-control','placeholder'=>'Link Name','div'=>false));?>
                        </div>
			<label for="group_name" class="col-sm-2 control-label"><small>Link Order</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('ordering',array('label' => false,'class'=>'form-control','placeholder'=>'Link Order','div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small>Page Type</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('is_url',array('type'=>'radio','options'=>array("Internal"=>"Internal","External"=>"External"),'default'=>'Internal','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                        </div>			
                    </div>		    
		    <div class="form-group" id="pgurl1">
                        <label for="group_name" class="col-sm-2 control-label"><small>External Url</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('url',array('label' => false,'class'=>'form-control','placeholder'=>'External Url','div'=>false));?>
                        </div>
			<label for="group_name" class="col-sm-2 control-label"><small>Url Target</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('url_target',array('type'=>'radio','options'=>array("_self"=>"_self","_blank"=>"_blank"),'default'=>'_self','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                        </div>
                    </div>
		    <div id="pgurl">
		     <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small>Page Name</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('page_name',array('label' => false,'class'=>'form-control','placeholder'=>'Page Name','div'=>false));?>
                        </div>
			<label for="group_name" class="col-sm-2 control-label"><small>Page Url</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('page_url',array('label' => false,'class'=>'form-control','placeholder'=>'Page Url','div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small>Page Content</small></label>
                        <div class="col-sm-10">
                           <?php echo $this->Tinymce->input('main_content', array('class'=>'form-control','label' => false),array('language'=>'en'),'full');?>
                        </div>
                    </div>
		    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">
                            <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span> Save',array('class'=>'btn btn-success','escpae'=>false));?>
			    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
			</div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>