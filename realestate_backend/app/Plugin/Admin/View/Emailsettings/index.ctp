<script type="text/javascript">
    $(document).ready(function(){
	<?php if($this->request->data['Emailsetting']['type']=="Smtp"){?>$('#smtp').show();<?php }else{?>$('#smtp').hide();<?php }?>
	$('#EmailsettingTypeSmtp').click(function(){$('#smtp').show();});
	$('#EmailsettingTypeMail').click(function(){$('#smtp').hide();});
	});
</script>
<?php echo $this->Session->flash();?>
<div class="row">
    <div class="col-md-12">    
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="widget">
                    <h4 class="widget-title">E-Mail<span> Settings</span></h4>
                </div>
            </div>
               <div class="panel-body">
                <?php echo $this->Form->create('Emailsetting', array('controller' => 'Emailsettings', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">Email Type</label>
                        <div class="col-sm-4">
				<?php echo $this->Form->input('type',array('type'=>'radio','options'=>array("Mail"=>"LOCALHOST","Smtp"=>"SMTP"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
			</div>                        
                    </div>
		    <div id="smtp">
			<div class="form-group">
			    <label for="site_name" class="col-sm-2 control-label">Server Name/Host</label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->input('host',array('label' => false,'class'=>'form-control','placeholder'=>'Server Name','div'=>false));?>
			    </div>
			    <label for="site_name" class="col-sm-2 control-label">Port</label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->input('port',array('label' => false,'class'=>'form-control','placeholder'=>'Port','div'=>false));?>
			    </div>
			</div>
			<div class="form-group">
			    <label for="site_name" class="col-sm-2 control-label">User Name</label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->input('username',array('label' => false,'class'=>'form-control','placeholder'=>'User Name','div'=>false));?>
			    </div>
			    <label for="site_name" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->input('password',array('type'=>'password','label' => false,'class'=>'form-control','placeholder'=>'Password','div'=>false));?>
			    </div>                        
			</div>
		    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Save Settings</button>
                        </div>
                    </div>
                <?php echo$this->Form->end(null);?>
                </div>
            </div>
        </div>
    </div>
</div>