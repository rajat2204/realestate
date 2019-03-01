<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class ChangepasswordsController extends AppController
{
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session');
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->userId=$this->userValue['User']['id'];
    }
    public function index()
    {
       if ($this->request->is(array('post', 'put')))
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $userValue=$this->Changepassword->findById($this->userId);
            $oldPassword=$passwordHasher->hash($this->request->data['Changepassword']['oldPassword']);
            $newPassword=$passwordHasher->hash($this->request->data['Changepassword']['password']);
            if($userValue['Changepassword']['password']==$oldPassword)
            {
                if($this->Changepassword->save(array('id'=>$this->userId,'password'=>$newPassword)))
                {
                    $this->Session->setFlash('Password Changed Successfully','flash',array('alert'=>'success'));
                }
            }
            else
            {
                $this->Session->setFlash('Invalid Password.','flash',array('alert'=>'danger'));
            }
            $this->redirect(array('action' => 'index'));
        }   
    }
}