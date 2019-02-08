<?php
class AgentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Agent.id'=>'desc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Agent->parseCriteria($this->Prg->parsedParams());
        $this->set('Agent', $this->Paginator->paginate());        
    }    
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->Agent->create();
            $this->Agent->unbindValidation('remove', array('amount','action','remarks'), true);
            try
            {
                if ($this->Agent->save($this->request->data))
                {
                    $this->Session->setFlash('Agent has been saved.','flash',array('alert'=>'success'));
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
        foreach($ids as $id)
        {
            $post[]=$this->Agent->findByid($id);
        }
        $this->set('Agent',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->Agent->unbindValidation('remove', array('amount','action','remarks'), true);
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Agent->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Agent has been saved.','flash',array('alert'=>'success'));
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
                foreach($this->data['Agent']['id'] as $key => $value)
                {
                    $this->Agent->delete($value);
                }
                $this->Session->setFlash('Agent has been deleted.','flash',array('alert'=>'danger'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash('Please delete related record first.','flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function wallet($id = null)
    {
        $this->layout = null;
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->Agent->findById($id);
        }
        $this->set('Agent',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                $this->Agent->unbindValidation('keep', array('amount','action','remarks'), true);
                foreach($this->request->data as $value)
                {
                    if($this->CustomFunction->awalletInsert($value['Agent']['id'],$value['Agent']['amount'],$value['Agent']['action'],$value['Agent']['remarks']))
                    {
                        $this->Session->setFlash('Agent Wallet has been updated.','flash',array('alert'=>'success'));
                    }
                    else
                    {
                        $this->Session->setFlash('Invalid Amount.','flash',array('alert'=>'danger'));
                    }
                }                
                return $this->redirect(array('action' => 'index'));
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Agent record not found.','flash',array('alert'=>'danger'));
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
}
