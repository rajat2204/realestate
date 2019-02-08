<?php
App::uses('AdminAppController', 'Admin.Controller');
App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
class UsersController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('User.name'=>'asc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array('deleted IS NULL',$this->User->parseCriteria($this->Prg->parsedParams()));
        $this->set('User', $this->Paginator->paginate());        
    }
    public function add()
    {
        $this->loadModel('Ugroup');
        $this->set('ugroup',$this->Ugroup->find('list'));
        if ($this->request->is('post'))
        {
            $this->User->create();
            try
            {
                $password=$this->request->data['User']['password'];
                if ($this->User->save($this->request->data))
                {
                    $email=$this->request->data['User']['email'];$name=$this->request->data['User']['name'];$mobileNo=$this->request->data['User']['mobile'];
		    $userName=$this->request->data['User']['username'];
		    $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain.'/admin';
		    if($email)
		    {
			if($this->emailNotification)
			{
			    /* Send Email */
			    $this->loadModel('Emailtemplate');
			    $emailSettingArr=$this->Emailtemplate->findByType('ULC');
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
                            $smsTemplateArr=$this->Smstemplate->findByType('ULC');
                            if($smsTemplateArr['Smstemplate']['status']=="Published")
                            {
                                $url="$this->siteDomain";
                                $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                                $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                            }
                            /* End Sms */
                        }
                    }
                    $this->Session->setFlash('Your User has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e.'Invalid Post','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function edit($id = null)
    {
        $this->loadModel('Ugroup');
        $this->set('ugroup',$this->Ugroup->find('list'));
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->User->findByid($id);
        }
        $this->set('User',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->User->id = $id;
            try
            {
                $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                foreach($this->request->data as $key => $value)
                {
                    if(strlen($this->request->data[$key]['User']['password'])>0)
                    $this->request->data[$key]['User']['password']=$passwordHasher->hash($this->request->data[$key]['User']['password']);
                    else
                    unset($this->request->data[$key]['User']['password']);                    
                }
                if ($this->User->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Your User has been updated.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
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
        if ($this->request->is('post'))
        {
            foreach($this->data['User']['id'] as $key => $value)
            {
                if($value!=1)
                $this->User->delete($value);
            }
            $this->Session->setFlash('Your User has been deleted.','flash',array('alert'=>'success'));
        }        
        $this->redirect(array('action' => 'index'));
    }
    public function myProfile()
    {
        $userValue=$this->Session->read('User');
        $post = $this->User->findById($userValue['User']['id']);
        $this->set('post',$post);
    }
    public function assignrights()
    {
        $this->loadModel('Ugroup');
        $Ugroup=$this->Ugroup->find('all',array('conditions'=>array('id >'=>1),'order'=>'name asc'));
        $this->set('Ugroup',$Ugroup);
    }
    public function assignrightsedit($id=null)
    {
        $this->layout = null;
        $this->loadModel('Ugroup');
        $this->loadModel('PageRight');
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $isPost=$this->Ugroup->find('count',array('conditions'=>array('id'=>$id)));
        if($isPost==0)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $post=$this->User->assingPages($id);
        $this->set('PageRight',$post);
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                $this->PageRight->deleteAll(array('ugroup_id'=>$id));
                foreach($this->request->data['PageRight']['id'] as $value)
                {
                    if($value>0)
                    {
                        $this->PageRight->create();
                        $this->PageRight->save(array('page_id'=>$value,'ugroup_id'=>$id,'view_right'=>1));
                        
                    }                    
                }
                $this->Session->setFlash('Permission update successfully','flash',array('alert'=>'success'));
                return $this->redirect(array('action' => 'assignrights'));
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Error in updation','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'assignrights'));
            }
        }
        $this->set('id',$id);
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
    function login_form()
    {
        if (empty($this->data['User']['username']) == false)
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $password=$passwordHasher->hash($this->request->data['User']['password']);
            $user = $this->User->find('first', array('conditions' => array('User.username' => $this->data['User']['username'],
                                                                           'User.password' =>$password,
                                                                           'User.status'=>'Active',
                                                                           'User.deleted IS NULL')));            
            if($user != false)
            {   
                $this->Session->setFlash('Thank you for logging in!','flash', array('alert'=> 'success'));
                $this->Session->write('User', $user);                
                $this->Redirect(array('controller' => 'Dashboards', 'action' => 'index'));
                exit();
            }
            else
            {
                $this -> Session -> setFlash('Incorrect username/password!','flash', array('alert'=> 'danger'));
                $this -> Redirect(array('action' => 'login_form'));
                exit();
            }
        } 
    }
    function logout() {

        $this -> Session -> destroy();
        $this -> Session -> setFlash('You have logged out','flash', array('alert'=> 'success'));

        $this -> Redirect(array('action' => 'login_form'));
        exit();
    }
    public function changePass()
    {
        if ($this->request->is(array('post', 'put')))
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $userValue=$this->Session->read('User');
            $post = $this->User->findById($userValue['User']['id']);
            if($post['User']['password']==$passwordHasher->hash($this->request->data['User']['oldPassword']))
            {
                $this->User->id = $userValue['User']['id'];
                $this->request->data['User']['password']=$passwordHasher->hash($this->request->data['User']['password']);
                $this->User->unbindValidation('remove', array('name','username','mobile','email'), true);
                if ($this->User->save($this->request->data))
                {
                    $this->Session->setFlash('Password Changed Successfully','flash',array('alert'=>'success'));
                }                
            }
            else
            {
                $this->Session->setFlash('Invalid Password.','flash',array('alert'=>'danger'));
            }
            $this->redirect(array('action' => 'changePass'));
        }
    }
    public function leveladd()
    {
        $this->loadModel('Ugroup');
        if ($this->request->is('post'))
        {
            $this->Ugroup->create();
            try
            {
                $this->request->data['Ugroup']['name']=$this->request->data['User']['name'];
                $string=$this->request->data['Ugroup']['name'];
                $pattern='/^[a-z0-9 .-]*$/i';
                if(preg_match($pattern, $string))
                {
                    if ($this->Ugroup->save($this->request->data))
                    {
                        $this->Session->setFlash('Your Level User has been saved.','flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'assignrights'));
                    }
                }
                else
                {
                    $this->Session->setFlash('Invalid Level Name','flash',array('alert'=>'danger'));
                    return $this->redirect(array('action' => 'assignrights'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Level Name already exist.','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'assignrights'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
    }
    public function deletelevel()
    {
        $this->loadModel('Ugroup');
        if ($this->request->is('post'))
        {
            try
            {
                foreach($this->data['Ugroup']['id'] as $key => $value)
                {
                    $this->Ugroup->delete($value);
                }
                $this->Session->setFlash('Your Level user has been deleted.','flash',array('alert'=>'success'));
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Delete user first!','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'assignrights'));
            }
        }        
        $this->redirect(array('action' => 'assignrights'));
    }

}
