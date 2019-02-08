<?php
class CoapplicantsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Coapplicant.id'=>'asc'));
    public function index($clientId=null)
    {
        if(!$clientId)
        {
            $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Clients','action' => 'index'));            
        }
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Coapplicant->parseCriteria($this->Prg->parsedParams()),'Coapplicant.client_id'=>$clientId);
        $this->set('Coapplicant', $this->Paginator->paginate());
        $this->set('clientId',$clientId);
    }    
    public function add($clientId=null)
    {
        if ($this->request->is('post'))
        {
            $this->Coapplicant->create();
            try
            {
                $this->request->data['Coapplicant']['client_id']=$clientId;
                if ($this->Coapplicant->save($this->request->data))
                {
                    $this->Session->setFlash('Your Coapplicant has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add',$clientId));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index',$clientId));
            }
        }
        $this->set('clientId',$clientId);
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
            $post[$k]=$this->Coapplicant->findByid($id);
        }
        $this->set('Coapplicant',$post);
        $clientId=$post[1]['Coapplicant']['client_id'];
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $clientId=$this->data['clientId'];
            unset($this->request->data['clientId']);
            try
            {
                if ($this->Coapplicant->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Your Coapplicant has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index',$clientId));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index',$clientId));
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
        $this->set('clientId',$clientId);
    }    
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Coapplicant']['id'] as $key => $value)
                {
                    $this->Coapplicant->delete($value);
                }
                $clientId=$this->data['clientId'];
                $this->Session->setFlash('Your Coapplicant has been deleted.','flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index',$clientId));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash('Please Delete Deal first.','flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index',$clientId));
        }
    }
}
