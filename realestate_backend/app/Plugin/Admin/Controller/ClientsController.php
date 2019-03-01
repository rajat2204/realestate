<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
class ClientsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Client.name'=>'asc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Client->parseCriteria($this->Prg->parsedParams());
        $this->set('Client', $this->Paginator->paginate());        
    }    
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->Client->create();
            try
            {
                $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                $password = rand();
                $this->request->data['Client']['password'] = $passwordHasher->hash($password);
                if ($this->Client->save($this->request->data))
                {
                    $email=$this->request->data['Client']['email'];$clientName=$this->request->data['Client']['name'];
                    $mobileNo=$this->request->data['Client']['phone'];
                    $siteName=$this->siteName;$contactNo=$this->contact;$url=$this->siteDomain;
                    if($email)
                    {
                        if($this->emailNotification)
                        {                          
                            /* Send Email */
                            $this->loadModel('Emailtemplate');
                            $emailSettingArr=$this->Emailtemplate->findByType('CLC');
                            if($emailSettingArr['Emailtemplate']['status']=="Published")
                            {
                                $message=eval('return "' . addslashes($emailSettingArr['Emailtemplate']['description']) . '";');
                                $Email = new CakeEmail();
                                $Email->transport($this->emailSettype);
                                if($this->emailSettype=="SMTP")
                                $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword));
                                $Email->from(array($this->siteEmail =>$this->siteName));
                                $Email->to($email);
                                $Email->template('default');
                                $Email->emailFormat('html');
                                $Email->subject($emailSettingArr['Emailtemplate']['name']);
                                $Email->send($message);
                                /* End Email */
                            }
                        }
                    }
                    if($mobileNo)
                    {
                        if($this->smsNotification)
                        {
                            /* Send Sms */
                            $this->loadModel('Smstemplate');
                            $smsTemplateArr=$this->Smstemplate->findByType('CLC');
                            if($smsTemplateArr['Smstemplate']['status']=="Published")
                            {
                                $url="$this->siteDomain";
                                $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                                $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                            }
                            /* End Sms */
                        }
                    }
                    $this->Session->setFlash('Your Client has been saved.','flash',array('alert'=>'success'));
                    if($this->request->data['Client']['coapplicant']=="1")
                    return $this->redirect(array('controller'=>'Coapplicants','action' => 'add',$this->Client->id));
                    else
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $k=>$id)
        {$k++;
            $post[$k]=$this->Client->findByid($id);
        }
        $this->set('Client',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Client->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Your Client has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }    
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Client']['id'] as $key => $value)
                {
                    $this->Client->delete($value);
                }
                $this->Session->setFlash('Your Client has been deleted.','flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash('Please Delete Deal first.','flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Client->findById($id);
        $this->set('post',$post);
    }
    public function printclient($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Client->findById($id);
        $this->set('post',$post);
    }
    public function changepass($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Client->findById($id);
        if (!$post)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $this->Client->id = $id;
            $this->request->data['Client']['password'] = $passwordHasher->hash($this->request->data['Client']['password']);
            if ($this->Client->save($this->request->data,array('validate'=>false)))
            {
                $this->Session->setFlash('Password Changed Successfully','flash',array('alert'=>'success'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
}
