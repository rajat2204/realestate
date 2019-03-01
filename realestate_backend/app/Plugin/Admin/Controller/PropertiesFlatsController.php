<?php
class PropertiesFlatsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('PropertiesFlat.id'=>'desc'));
    public function index($id=null)
    {
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Properties','action' => 'index'));            
        }
        $this->loadModel('Property');
        $post=$this->Property->findById($id);
        if(!$post)
        {
            $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Properties','action' => 'index'));  
        }
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->PropertiesFlat->parseCriteria($this->Prg->parsedParams()),array('property_id'=>$id));
        $this->set('PropertiesFlat', $this->Paginator->paginate());
        $this->set('propertyId',$id);
    }    
    public function add($propertyId=null)
    {
        $this->loadModel('Unit');
        $this->set('unitName',$this->Unit->find('list'));
        if ($this->request->is('post'))
        {
            $propertyId=$this->data['propertyId'];
            $this->PropertiesFlat->create();
            try
            {
                $flatCount=$this->PropertiesFlat->find('count',array('conditions'=>array('PropertiesFlat.property_id'=>$propertyId,'PropertiesFlat.name'=>$this->request->data['PropertiesFlat']['name'])));
                $this->request->data['PropertiesFlat']['property_id']=$propertyId;
                if($flatCount==0)
                {
                    if($this->PropertiesFlat->save($this->request->data))
                    {
                        $this->Session->setFlash('Flat/Plot has been saved.','flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => "add/$propertyId"));
                    }
                }
                else
                {
                    $this->Session->setFlash('Flat/Plot Name has been already exist','flash',array('alert'=>'danger'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
            }            
        }
        $this->set('propertyId',$propertyId);
    }
    public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        $this->loadModel('Unit');
        $this->set('unitName',$this->Unit->find('list'));
        foreach($ids as $id)
        {
            $post[]=$this->PropertiesFlat->findByid($id);
        }
        $this->set('PropertiesFlat',$post);
        $propertyId=$post[0]['PropertiesFlat']['property_id'];
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $propertyId=$this->data['propertyId'];
            unset($this->request->data['propertyId']);
            try
            {
                if ($this->PropertiesFlat->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Flats/Posts has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "index/$propertyId"));
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
        $this->set('propertyId',$propertyId);
    }
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['PropertiesFlat']['id'] as $key => $value)
                {
                    $this->PropertiesFlat->delete($value);
                }
                $this->Session->setFlash('Flats/Plots has been deleted.','flash',array('alert'=>'success'));
                $propertyId=$this->data['propertyId'];
            }
            $this->redirect(array('action' => "index/$propertyId"));
            $this->set('propertyId',$propertyId);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => "index/$propertyId"));
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
        $post = $this->PropertiesFlat->findById($id);
        if (!$post)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('post',$post);        
    }
}
