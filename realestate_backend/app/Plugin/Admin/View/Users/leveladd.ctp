<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        });
</script>
<div class="container">
<div class="row">
<?php echo $this->Session->flash();?>
    <div class="col-md-6 col-sm-offset-3">    
        <div class="panel panel-default mrg">
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Add <span>Level Users</span></strong></h4><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div></div>
                <div class="panel-body">
                <?php echo $this->Form->create('User', array( 'controller' => 'User', 'action' => 'leveladd','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small>Level User</small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Level User','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button><?php }?>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>