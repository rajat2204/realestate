<?php
App::uses('CakeEmail', 'Network/Email');
class ContactsController extends AppController
{
    public function index()
    {
        $this->loadModel('Content');
	$contactValueArr=$this->Content->find('first',array('conditions'=>array('id'=>2)));
	$this->set('contactValue',$contactValueArr['Content']['main_content']);		
        if ($this->request->is('post'))
        {
            try
            {
		$toEmail=$this->siteEmail;
                if($toEmail)
                {
                    $this->loadModel('Emailsetting');
		    $emailSettingArr=$this->Emailsetting->findById(1);
		    $settingType=$emailSettingArr['Emailsetting']['type'];
		    if($settingType=="Smtp")
		    {
			$host=$emailSettingArr['Emailsetting']['host'];
			$port=$emailSettingArr['Emailsetting']['port'];
			$username=$emailSettingArr['Emailsetting']['username'];
			$password=$emailSettingArr['Emailsetting']['password'];
		    }
		    $Email = new CakeEmail();
		    if($settingType=="Mail")
		    {
			$Email->transport('Mail');
		    }
		    if($settingType=="Smtp")
		    {
			$Email->transport('Smtp');
			$Email->config(array('host' => $host,'port' => $port,'username' => $username,'password' => $password));
		    }
		    $subject=$this->request->data['Contact']['subject'];
		    $message='Name: '.$this->request->data['Contact']['name'].'<br><br>Email: '.$this->request->data['Contact']['email'].
		    '<br><br>Phone/Mobile: '.$this->request->data['Contact']['phone'].'<br><br>Message: '.$this->request->data['Contact']['message'].'<br><br>';
		    $Email->from(array($this->request->data['Contact']['email'] =>$this->request->data['Contact']['name']));
		    $Email->to($toEmail);
		    $Email->template('default');
		    $Email->emailFormat('html');
		    $Email->subject($subject);
		    $Email->send($message);
                    $this->Session->setFlash('E-Mail send successfylly .','flash',array('alert'=>'success'));
                    return $this->redirect(array('controller'=>'Contacts','action' => 'index'));
                }
		else
		{
		    $this->Session->setFlash('No email to send!','flash',array('alert'=>'danger'));
		    return $this->redirect(array('action' => 'index'));
		}
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
        
    }
}