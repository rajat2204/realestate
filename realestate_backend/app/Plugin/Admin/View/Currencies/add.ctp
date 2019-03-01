<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Currency</div>
        <div class="panel-body">
                <div class="panel-body">
                <?php echo $this->Form->create('Currency', array( 'controller' => 'Currencies', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small>Cuurency Name</small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Currency Name','div'=>false));?>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small>Upload Currency (Less or equal to 50*50)</small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'class'=>'','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'Currencies','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>