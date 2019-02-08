<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->Html->script('select2.min');
$clientUrl=$this->Html->url(array('controller'=>'Deals','action'=>'clientsearch'));
$propertyUrl=$this->Html->url(array('controller'=>'Deals','action'=>'propertysearch'));
$propertyFlat=$this->Html->url(array('controller'=>'Deals','action'=>'propertyflat'));
$flatDetails=$this->Html->url(array('controller'=>'Deals','action'=>'flatdetails'));
$propertyPlans=$this->Html->url(array('controller'=>'Deals','action'=>'plandetails'));
?>
<script type="text/javascript">
    $(document).ready(function(){
        calculateAmount();
        $('#startDate').datetimepicker({format: '<?php echo$dpFormat;?>'});
        $('#recurring').hide();
        $('#rec_type').click(function () {$("#recurring").toggle(this.checked);});
        $('#DealDiscount').blur(function (){calculateAmount();});
        $('#clientId').select2({
        placeholder: "Search Client Name",
        minimumInputLength: 1,
        ajax: {
          url: '<?php echo$clientUrl;?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },
          
          results: function (data, page) {
            return { results: data };
          }
        }
      });
        $('#propertyId').select2({
        placeholder: "Search Property Name",
        minimumInputLength: 1,
        ajax: {
          url: '<?php echo$propertyUrl;?>',
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
        $('#flatId').select2({
        placeholder: "Search Flat/Plot Name",
        minimumInputLength: 1,
        ajax: {
          url: '<?php echo$propertyFlat;?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term,
              q1: $('#propertyId').val()
            };
          },
          results: function (data, page) {
            return { results: data };
          }
        }
      }).on("change", function(e) {
          $.ajax({
      dataType: 'json',
      cache: false ,
      url: '<?php echo$flatDetails;?>',
      data: {id: e.val}})
      .done(function(data) {
        $.each(data,function(index,item){
           $(index).val(item);});
        calculateAmount();
      });
        });
        });
    function calculateAmount()
    {
        var discount=0;
        dealArea=$('#DealArea').val();
        dealAmount=$('#DealAmount').val();
        dealDiscount=$('#DealDiscount').val();
        if(dealDiscount!="")
        discount=dealDiscount;      
        totalAmount=(parseFloat(dealAmount)-parseFloat(discount));
        if(isNaN(totalAmount))
        totalAmount=0;
        $('#totalAmount').html('Area : ' + dealArea+ '<br/>Amount : ' + dealAmount+ '<br/>Discount : ' + discount+ '<br/>Payable Amount : '+totalAmount);
    }
</script>
<div class="col-md-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading">Add Deal</div>
        <div class="panel-body">
        <?php echo $this->Form->create('Deal', array( 'controller' => 'Deals', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Deal On:</small></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->input('client_id',array('type'=>'text','id'=>'clientId','label' => false,'class'=>'form-control','div'=>false));?>
                </div>                        
            </div>
             <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Deal For:</small></label>
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
                <label for="group_name" class="col-sm-2 control-label"><small>Flat/Plot Name:</small></label>
                <div class="col-sm-10"><?php echo $this->Form->input('properties_flat_id',array('type'=>'text','id'=>'flatId','label' => false,'class'=>'form-control','div'=>false));?>
                </div>                                     
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Invoice #:</small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('invoice_no',array('value'=>$invoiceNo,'label' => false,'class'=>'form-control','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Invoice Date:</small></label>
                <div class="col-sm-2">
                   <div class="input-group date" id="startDate">                        
                    <?php echo $this->Form->input('date',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                </div>
            </div>
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small>Area:</small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('area',array('label' => false,'class'=>'form-control','placeholder'=>'Area','div'=>false,'readonly'=>'readonly'));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Amount:</small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('amount',array('label' => false,'class'=>'form-control','placeholder'=>'Amount','div'=>false,'readonly'=>'readonly'));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small>Discount:</small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('discount',array('label' => false,'class'=>'form-control','placeholder'=>'Discount','div'=>false));?>
                </div>
            </div>
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small>Payment Method:</small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->select('plan_id',$plan,array('label' => false,'class'=>'form-control','empty'=>'Please Select','div'=>false));?>
                </div>
                <div class="col-sm-2">
                   <?php echo$this->Form->select('recurring',array('M'=>'Monthly','Q'=>'Quarterly','H'=>'Half Yearly','Y'=>'Yearly'),array('empty'=>'Manually','label'=>false,'class'=>'form-control'));?>
                </div>                
                <label for="group_name" class="col-sm-2 control-label"><small>Agent if any:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('agent_id',$agent,array('label' => false,'class'=>'form-control','empty'=>'Please Select','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small>Comment/Remarks:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('remarks',array('label' => false,'class'=>'form-control','placeholder'=>'Comment/Remarks','div'=>false));?>
                </div>
                <div class="col-sm-offset-2 col-sm-4"><strong id="totalAmount"></strong></div>
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> Save</button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> Close',array('controller'=>'Deals','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
               
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>