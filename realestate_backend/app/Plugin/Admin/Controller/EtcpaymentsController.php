<?php
class EtcpaymentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Etcpayment.id'=>'desc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Etcpayment->parseCriteria($this->Prg->parsedParams());
        $this->set('Etcpayment', $this->Paginator->paginate());        
    }    
    public function add()
    {
        $this->loadModel('Unit');
        $unitOption=$this->Unit->find('list');
        $this->set('unitOption',$unitOption);
        if ($this->request->is('post'))
        {
            $this->Etcpayment->create();
            try
            {
                if ($this->Etcpayment->save($this->request->data))
                {
                    $this->Session->setFlash('Extra payment has been saved.','flash',array('alert'=>'success'));
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
        $this->loadModel('Unit');
        $unitOption=$this->Unit->find('list');
        $this->set('unitOption',$unitOption);
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->Etcpayment->findByid($id);
        }
        $this->set('Etcpayment',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Etcpayment->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Extra payment has been saved.','flash',array('alert'=>'success'));
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
                foreach($this->data['Etcpayment']['id'] as $key => $value)
                {
                    $this->Etcpayment->delete($value);
                }
                $this->Session->setFlash('Extra payment has been deleted.','flash',array('alert'=>'danger'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash('Please delete related record first.','flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
}
