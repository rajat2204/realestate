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
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Change <span>Password</span></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>
                <div class="panel-body">  
                <?php echo $this->Form->create('Client', array( 'controller' => 'Clients', 'action' => 'changepass','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('password',array('id'=>'password','value'=>'','label' => false,'class'=>'form-control input-sm validate[required,minSize[4],maxSize[15]]','placeholder'=>'Password','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('con_password',array('type'=>'password','label' => false,'class'=>'form-control input-sm validate[required,minSize[4],maxSize[15],equals[password]]','placeholder'=>'Confirm Password','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('id', array('type' => 'hidden'));?>                            
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>