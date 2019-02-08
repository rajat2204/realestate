<?php echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
echo $this->fetch('script');
$clientUrl=$this->Html->url(array('controller'=>'Leads','action'=>'clientsearch'));
$propertyUrl=$this->Html->url(array('controller'=>'Leads','action'=>'propertysearch'));
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        $('.startDate').datetimepicker({format:'<?php echo $dpFormat;?> HH:mm'});        
    });
</script>
<div class="container">
<div class="row">
<?php echo $this->Session->flash();?>
    <div class="col-md-12">    
        <div class="panel panel-default mrg">
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">Edit <span>Leads</span></strong></h4><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div></div>
                <div class="panel-body">
					<?php echo $this->Form->create('Lead', array( 'controller' => 'Leads','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Lead as $k=>$post): $id=$post['Lead']['id'];$form_no=$k+1;?>
					<script type="text/javascript">
					$(document).ready(function(){        
					     $('#propertyId<?php echo$id;?>').select2({
						minimumInputLength: 1,
						ajax: {
						  url: '<?php echo$propertyUrl;?>',
						  dataType: 'json',
						  data: function (term, page) {
						    return {
						      q: term,
						      q1: $('input[name="typelead<?php echo$id;?>"]:checked').val(),
						      q2: $("#projectId<?php echo$id;?>").val()
						    };
						  },
						  results: function (data, page) {
						    return { results: data };
						  }
						},
						initSelection: function (element, callback) {
						callback({"id": <?php echo$post['Property']['id'];?>, "text": "<?php echo$post['Property']['name'];?>"});
						}
						});					     
					});
				    </script>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger">Form <?php echo$form_no?></small></strong></div>
							<div class="panel-body">								
                     <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small>Name:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Lead.name",array('label' => false,'class'=>'form-control','placeholder'=>'Name of Contact','div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><small>Address:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Lead.address",array('label' => false,'class'=>'form-control','placeholder'=>'Address','div'=>false));?>
			</div>
		    </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Email:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Lead.email",array('label' => false,'class'=>'form-control','placeholder'=>'Email','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Phone No.:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Lead.phone",array('label' => false,'class'=>'form-control','placeholder'=>'Phone No.','div'=>false));?>
                </div>
            </div>
                     <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small>Lead For:</small></label>
                        <div class="col-sm-3">
                           <?php echo $this->Form->input("$k.Lead.typelead",array('type'=>'radio','options'=>array("Commercial"=>"Commercial","Residential"=>"Residential"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
                           </label>
                     </div>
		     <label for="group_name" class="col-sm-1 control-label"><small>Project:</small></label>
                        <div class="col-sm-2">
                           <?php echo $this->Form->select("$k.Lead.project_id",$projectName,array('id'=>"projectId$id",'label' => false,'class'=>'form-control','empty'=>'Please Select','div'=>false));?>
                           </label>
                        </div>
                     <div class="col-sm-4">
                           <?php echo $this->Form->input("$k.Lead.property_id",array('type'=>'text','id'=>"propertyId$id",'value'=>$post['Property']['id'],'label' => false,'class'=>'form-control','div'=>false));?>
                        </div>                         
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small>Follow Up:</small></label>
                        <div class="col-sm-4">
                           <div class="input-group date startDate" id="startDate">                        
                            <?php echo $this->Form->input("$k.Lead.follow_up",array('type'=>'text','value'=>$this->Time->format($dtFormat.$dateGap.$sysHour.$timeSep.$sysMin,$post['Lead']['follow_up']),'label' => false,'class'=>'form-control','div'=>false));?>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small>Comment/Remarks:</small></label>
                        <div class="col-sm-10">
                           <?php echo $this->Form->input("$k.Lead.remarks",array('label' => false,'class'=>'form-control','placeholder'=>'Comment/Remarks','div'=>false));?>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small>Status:</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input("$k.Lead.status",array('options'=>array('Awaiting/Closed'=>'Awaiting/Closed','In Process'=>'In Process','Cancelled'=>'Cancelled','Site Visited'=>'Site Visited','Document Collected'=>'Document Collected'),'empty'=>'(Please Select)','label' => false,'class'=>'form-control','div'=>false));?>
                        </div>                        
                    </div>            
			<div class="form-group text-left">
			    <div class="col-sm-offset-3 col-sm-7">
			    <?php echo $this->Form->input("$k.Lead.id", array('type' => 'hidden'));?>
			    </div>
			</div>
							</div>
						</div>						
                    <?php endforeach; ?>
                        <?php unset($post); ?>
			<div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">                            
                            <button type="submit" class="btn btn-success" id="save"><span class="fa fa-refresh"></span> Update</button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>