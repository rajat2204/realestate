<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
echo $this->fetch('script');
$clientUrl=$this->Html->url(array('controller'=>'Sendsms','action'=>'clientsearch'));
$leadUrl=$this->Html->url(array('controller'=>'Sendsms','action'=>'leadsearch'));
$agentUrl=$this->Html->url(array('controller'=>'Sendsms','action'=>'agentsearch'));
echo $this->Session->flash();?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#clientId').select2({
        placeholder: "Default all client if you add manually then search clients name",
        minimumInputLength: 1,
	tags: true,
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
        $('#leadId').select2({
        placeholder: "Default all client if you add manually then search leads name",
         minimumInputLength: 1,
	tags: true,
        ajax: {
          url: '<?php echo$leadUrl;?>',
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
	$('#agentId').select2({
        placeholder: "Default all client if you add manually then search agents name",
         minimumInputLength: 1,
	tags: true,
        ajax: {
          url: '<?php echo$agentUrl;?>',
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
	$('#clients').hide();
	$('#leads').hide();
	$('#agents').hide();
	$('#any').hide();
    $('#SendsmsType').change(function(){
    if($('#SendsmsType').val()=="Client")
    {
	$('#clients').show();
	$('#leads').hide();
	$('#agents').hide();
	$('#any').hide();
    }
    else if($('#SendsmsType').val()=="Lead")
    {
	$('#leads').show();
	$('#clients').hide();
	$('#agents').hide();
	$('#any').hide();
    }
    else if($('#SendsmsType').val()=="Agent")
    {
	$('#agents').show();
	$('#leads').hide();
	$('#clients').hide();
	$('#any').hide();
    }
    else if($('#SendsmsType').val()=="Any")
    {
	$('#any').show();
	$('#clients').hide();
	$('#leads').hide();
	$('#agents').hide();	
    }
    else
    {
	$('#any').hide();
	$('#clients').hide();
	$('#leads').hide();
	$('#agents').hide();	
    }
    });
    $('#SendsmsSmsTemplate').change(function() {
    $('#SendsmsMessage').val($('#SendsmsSmsTemplate').val());
    sms_character_count();
    });
    $('#characterLeft').text(' 0 character (1 sms)');
    $('#SendsmsMessage').keyup(function () {
	sms_character_count();
    });
    $('#SendsmsMessage').focus(function () {
	sms_character_count();
    });
    function sms_character_count()
    {
	var len = $('#SendsmsMessage').val().length;
	if(len<160)
	sms=1;
	else
	{
	    var sms = Math.floor(len/160)+1;	
	}
	var ch = len;
	$('#characterLeft').text(ch + ' characters'+ '('+sms+' sms)');
    }
    });
</script>
<div class="row">
    <div class="col-md-12">    
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="widget">
                    <h4 class="widget-title">Send <span> Sms</span></h4>
                </div>
            </div>
               <div class="panel-body">
		    <?php echo $this->Form->create('Sendsms', array('class'=>'form-horizontal'));?>                    
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label">Type</label>
			<div class="col-sm-10">
			   <?php echo $this->Form->select('type',array('Client'=>'Clients','Lead'=>'Leads','Agent'=>'Agents','Any'=>'Any Sms'),array('required'=>'required','empty'=>'Please Select','label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="clients">
			<label for="site_name" class="col-sm-2 control-label">Clients</label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('client_id',array('type'=>'text','id'=>'clientId','label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="leads">
			<label for="site_name" class="col-sm-2 control-label">Leads</label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('lead_id',array('type'=>'text','id'=>'leadId','label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="agents">
			<label for="site_name" class="col-sm-2 control-label">Agents</label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('agent_id',array('type'=>'text','id'=>'agentId','label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="any">
			<label for="site_name" class="col-sm-2 control-label">Any Number</label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('any_sms',array('type'=>'text','placeholder'=>'Type any number comma seprated','label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label">Select Sms Template</label>
			<div class="col-sm-10">
			   <?php echo $this->Form->select('sms_template',$smsTemplate,array('empty'=>'Please Select','label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label">Sms Template:</label>
			<div class="col-sm-8">
			    <?php echo $this->Form->textarea('message',array('label' => false,'class'=>'form-control','placeholder'=>'If you do not want to select sms template then simply type sms message.','div'=>false,'rows'=>5));?>
			</div>
			<div class="span2"><div id="characterLeft"></div></div>
		    </div>
		    <div class="form-group text-left">
			<div class="col-sm-offset-2 col-sm-10">
			    <button type="submit" class="btn btn-success"><span class="fa fa-send"></span>&nbsp;Send</button>
			    <?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;Reset',array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
			</div>
		    </div>
		    <?php echo$this->Form->end(null);?>
                </div>
            </div>
        </div>
    </div>
</div>