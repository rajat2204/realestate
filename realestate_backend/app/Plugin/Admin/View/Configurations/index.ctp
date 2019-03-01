<?php echo $this->Session->flash();?>
<div class="row">
    <div class="col-md-12">    
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="widget">
                    <h4 class="widget-title">Configuration<span> Options</span></h4>
                </div>
            </div>
               <div class="panel-body">
                <?php echo $this->Form->create('Configuration', array( 'controller' => 'Configurations', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">Site Name</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>'Site Name','div'=>false));?>
                        </div>
                         <label for="site_name" class="col-sm-2 control-label">Organization Name</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('organization_name',array('label' => false,'class'=>'form-control','placeholder'=>'Organization Name','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>'Address','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label">Account Details</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('account_details',array('label' => false,'class'=>'form-control','placeholder'=>'Account Details','div'=>false));?>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">Domain Name</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('domain_name',array('label' => false,'class'=>'form-control','placeholder'=>'Domain Name','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label">Organization Email</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>'Organization Email','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Meta Title');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('meta_title',array('label' => false,'class'=>'form-control','placeholder'=>__('Meta Title'),'div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Meta Description');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('meta_desc',array('label' => false,'class'=>'form-control','placeholder'=>__('Meta Description'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">Time Zone</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->select('timezone',$timezones,array('empty'=>'Please Select Timezone','label' => false,'class'=>'form-control','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label">Currency</label>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('currency',array('options'=>$allcurrency,'empty'=>false,'label' => false,'class'=>'form-control','div'=>false,'escape'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">Date Format</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('date_format',array('label' => false,'class'=>'form-control','data-errormessage'=>'Date Format Required','placeholder'=>'Date Format','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-6 control-label">Date, Month, Year, Hour, Min, Sec, Meridian, Date Seprator, Time Seprator</label>                        
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">Short Name</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('short_name',array('label' => false,'class'=>'form-control','placeholder'=>'Short Name','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label">Contact Nos.</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('contact',array('label' => false,'class'=>'form-control','placeholder'=>'Contact No. should be comma seprated','div'=>false));?>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">Due Days</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('due_days',array('label' => false,'class'=>'form-control','placeholder'=>'Number of Due Days','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label">Late Fees(% annually)</label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('late_fees',array('label' => false,'class'=>'form-control','placeholder'=>'Late Fees(% annually)','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label">Email Notification</label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->input('email_notification',array('label' => false,'class'=>'form-control','data-errormessage'=>'Date Format Required','placeholder'=>'Date Format','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-3 control-label">SMS Notification</label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->checkbox('sms_notification',array('label' => false,'class'=>'form-control','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-3 control-label">Translation</label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->checkbox('translate',array('label' => false,'class'=>'form-control','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;Save Settings</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>