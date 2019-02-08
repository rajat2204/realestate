<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Email Template</div>
        <div class="panel-body">
        <?php echo $this->Form->create('Emailtemplate', array( 'controller' => 'Emailtemplates', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Name:</small></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Name','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Email Template:</small></label>
                <div class="col-sm-10">
                    <?php echo $this->Tinymce->input('description',array('label' => false,'class'=>'form-control','placeholder'=>'Email Template','div'=>false),array('language'=>'en'),'absolute');?>
                </div>
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'Emailtemplates','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>