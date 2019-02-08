<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
echo $this->fetch('script');
$clientUrl=$this->Html->url(array('controller'=>'Leads','action'=>'clientsearch'));
$propertyUrl=$this->Html->url(array('controller'=>'Leads','action'=>'propertysearch'));
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#startDate').datetimepicker({format:'<?php echo $dpFormat;?> HH:mm'});
        $('#propertyId').select2({
        placeholder: "Search Property Name",
        minimumInputLength: 1,
        ajax: {
          url: '<?php echo$propertyUrl?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term,
              q1: $('input[name="typelead"]:checked').val(),
              q2: $('#projectId').val()
            };
          },
          results: function (data, page) {
            return { results: data };
          }
        }
      });
        });
</script>
<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Lead</div>
        <div class="panel-body">
        <?php echo $this->Form->create('Lead', array( 'controller' => 'Leads', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Name:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Name of Contact','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Address:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>'Address','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Email:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>'Email','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Phone No.:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('phone',array('label' => false,'class'=>'form-control','placeholder'=>'Phone No.','div'=>false));?>
                </div>
            </div>
             <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Lead For:</small></label>
                <div class="col-sm-3">
                   <?php echo $this->Form->input('typelead',array('name'=>'typelead','type'=>'radio','options'=>array("Commercial"=>"Commercial","Residential"=>"Residential"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
                   </label>
                </div>
                <label for="group_name" class="col-sm-1 control-label"><small>Project:</small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->select('project_id',$projectName,array('id'=>'projectId','label' => false,'class'=>'form-control','empty'=>'Please Select','div'=>false));?>
                   </label>
                </div>
             <div class="col-sm-4">
                   <?php echo $this->Form->input('property_id',array('type'=>'text','id'=>'propertyId','label' => false,'class'=>'form-control','div'=>false));?>
                </div>                         
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Follow Up:</small></label>
                <div class="col-sm-4">
                   <div class="input-group date" id="startDate">                        
                    <?php echo $this->Form->input('follow_up',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Comment/Remarks:</small></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->input('remarks',array('label' => false,'class'=>'form-control','placeholder'=>'Comment/Remarks','div'=>false));?>
                </div>                        
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Status:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('status',array('options'=>array('In Process'=>'In Process','Site Visited'=>'Site Visited','Document Collected'=>'Document Collected'),'empty'=>'(Please Select)','label' => false,'class'=>'form-control','div'=>false,'default'=>'In Process'));?>
                </div>                        
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'Leads','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>