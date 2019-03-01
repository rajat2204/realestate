<?php
App::uses('CakeTime', 'Utility');
class LeadsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Lead.id'=>'desc'));
    public function index($id=null)
    {
        $cond=array();
        if($id!=null)
        $cond=array('Property.project_id'=>$id);
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Lead->parseCriteria($this->Prg->parsedParams()),$cond);
        $this->set('Lead', $this->Paginator->paginate());        
    }
    public function propertysearch()
    {
        $this->autoRender = false;
        // get the search term from URL
        $this->loadModel('Property');
        $term = $this->request->query['q'];
        $cond=array();$cond1=array();
        if(isset($this->request->query['q1']))
        {
            $type=$this->request->query['q1'];
            $cond=array('Property.type' => $type);
        }
        if($this->request->query['q2'])
        {
            $cond1=array('Property.project_id' => $this->request->query['q2']);
        }
        $users = $this->Property->find('all',array('conditions' => array('Property.name LIKE' => '%'.$term.'%','Property.status'=>'Availiable',$cond,$cond1)));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = (int) $user['Property']['id'];
            $result[$key]['text'] = $user['Property']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }    
    public function add()
    {
        $this->loadModel('Property');
        $this->loadModel('Project');
        $this->set('propertyId',$this->Property->find('list',array('fields'=>array('id','name'))));
        $this->set('projectName',$this->Project->find('list'));
        if ($this->request->is('post'))
        {
            $this->Lead->create();
            try
            {
                if ($this->Lead->save($this->request->data))
                {
                    $this->Session->setFlash('Your Lead has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Please Select Property Name','flash',array('alert'=>'danger'));
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
        foreach($ids as $id)
        {
            $post[]=$this->Lead->findById($id);
        }
        $this->set('Lead',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
         $this->loadModel('Project');
        $this->set('projectName',$this->Project->find('list'));
        if ($this->request->is(array('post', 'put')))
        {
            $this->Lead->id = $id;
            try
            {
                if ($this->Lead->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Your Lead has been updated.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Please Select Client Name & Property Name.','flash',array('alert'=>'danger'));
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
            foreach($this->data['Lead']['id'] as $key => $value)
            {
                $this->Lead->delete($value);
            }
            $this->Session->setFlash('Your Lead has been deleted.','flash',array('alert'=>'success'));
        }        
        $this->redirect(array('action' => 'index'));
    }
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Lead->findById($id);
        $this->set('post',$post);
    }
}
