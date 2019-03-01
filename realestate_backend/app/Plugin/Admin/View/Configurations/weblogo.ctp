<?php echo $this->Session->flash();?>
<div class="row">
    <div class="col-md-12">    
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="widget">
                    <h4 class="widget-title">Organisation <span>Logo</span></h4>
                </div>
            </div>            
                <div class="panel-body">
                <?php echo $this->Html->link('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back To Contents',array('controller' => 'Contents','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
                <?php echo $this->Form->create('Configuration', array( 'controller' => 'Configurations', 'action' => 'weblogo','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small>Upload Image(* height less than 220px)</small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'class'=>'form-control input-sm validate[required]','placeholder'=>'Upload Image','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>                            
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-trash"></span>&nbsp;Delete Logo',array('controller'=>'Contents','action'=>'weblogodel'),array('escape'=>false,'class'=>'btn btn-danger'));?>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>