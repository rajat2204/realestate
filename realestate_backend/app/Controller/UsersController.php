<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeTime', 'Utility');
class UsersController extends AppController
{
    var $name = 'Users';
    var $helpers = array('Form');
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->currentDateTime=CakeTime::format('Y-m-d H:i:s',CakeTime::convert(time(),$this->siteTimezone));
    }
    public function login()
    {
        if (empty($this->data['User']['email']) == false)
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $password=$passwordHasher->hash($this->request->data['User']['password']);            
            $user = $this->User->find('first', array('conditions' => array('User.email' => $this->data['User']['email'], 'User.password' =>$password)));            
            if($user != false)
            {
                if($user['User']['status']=="Active")
                {
                    $record_arr=array('User'=>array('id'=>$user['User']['id'],'last_login'=>$this->currentDateTime));
                    $this->User->save($record_arr);
                    $this->Session->setFlash('Thank you for logging in!','flash', array('alert'=> 'success'));
                    $this->Session->write('frontUser', $user);                
                    $this->Redirect(array('controller' => 'Dashboards', 'action' => 'index'));
                    exit();
                }
                else
                {
                    $status=$user['User']['status'];
                    $this->Session->setFlash("You are $status Member! Please contact administrator",'flash', array('alert'=> 'danger'));
                    $this->Redirect(array('action' => 'login'));
                    exit();
                }
            }
            else
            {
                $this->Session->setFlash('Incorrect username/password!','flash', array('alert'=> 'danger'));
                $this->Redirect(array('action' => 'login'));
                exit();
            }
        } 
    }
    public function logout()
    {
        $this -> Session -> destroy();
        $this -> Session -> setFlash('You have logged out','flash', array('alert'=> 'success'));
        $this -> Redirect(array('action' => 'login'));
        exit();
    }    
}
