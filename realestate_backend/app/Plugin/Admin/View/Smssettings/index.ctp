<?php echo $this->Session->flash();?>
<div class="row">
    <div class="col-md-12">    
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="widget">
                    <h4 class="widget-title">SMS<span> Settings</span></h4>
                </div>
            </div>
               <div class="panel-body">
                <?php echo $this->Form->create('Smssetting', array('controller' => 'Smssettings', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="form-group">
                         <label for="site_name" class="col-sm-2 control-label">API Link</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('api',array('label' => false,'class'=>'form-control','placeholder'=>'API Link','div'=>false));?>
                        </div>
			<label for="site_name" class="col-sm-2 control-label">Sender ID</label>
                        <div class="col-sm-4">
			 <?php echo $this->Form->input('senderid',array('label' => false,'class'=>'form-control','placeholder'=>'Sender ID','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">User Name</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('username',array('label' => false,'class'=>'form-control','placeholder'=>'User Name','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label">Password/API Key</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('password',array('type'=>'password','label' => false,'class'=>'form-control','placeholder'=>'Password/API Key','div'=>false));?>
                        </div>                        
                    </div>
		    <div class="form-group">
                         <label for="site_name" class="col-sm-2 control-label">Heading Username</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('husername',array('label' => false,'class'=>'form-control','placeholder'=>'Username field provided by sms gateway','div'=>false));?>
                        </div>
			<label for="site_name" class="col-sm-2 control-label">Heading Password</label>
                        <div class="col-sm-4">
			 <?php echo $this->Form->input('hpassword',array('label' => false,'class'=>'form-control','placeholder'=>'Password field provided by sms gateway','div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
                         <label for="site_name" class="col-sm-2 control-label">Heading Mobile No</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('hmobile',array('label' => false,'class'=>'form-control','placeholder'=>'Mobile No field provided by sms gateway','div'=>false));?>
                        </div>
			<label for="site_name" class="col-sm-2 control-label">Heading Message</label>
                        <div class="col-sm-4">
			 <?php echo $this->Form->input('hmessage',array('label' => false,'class'=>'form-control','placeholder'=>'Message field provided by sms gateway','div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">Heading Sender Id</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('hsenderid',array('label' => false,'class'=>'form-control','placeholder'=>'Sender Id field provided by sms gateway','div'=>false));?>
                        </div>
			<label for="site_name" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('type',array('type'=>'radio','options'=>array("Get"=>__('Get'),"Post"=>__('Post')),'default'=>'Get','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Save Settings</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>