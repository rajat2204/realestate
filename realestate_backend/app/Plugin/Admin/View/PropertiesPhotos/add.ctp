<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        });
</script>
<div class="container">
<div class="row">
<?php echo $this->Session->flash();?>
    <div class="col-md-12">    
        <div class="panel panel-default mrg">
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Add <span>Property Photos</span></strong></h4><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div></div>
                <div class="panel-body">
                <?php echo $this->Form->create('PropertiesPhoto', array( 'controller' => 'PropertiesPhotos', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small>Add Photo:</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('photo.', array('type' => 'file','label'=>false,'multiple','class'=>'validate[required]')); ?>
                        </div>                                           
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                            <?php echo$this->Form->input('propertyId',array('type'=>'hidden','name'=>'propertyId','value'=>$propertyId));?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>