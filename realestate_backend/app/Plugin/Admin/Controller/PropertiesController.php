<?php
class PropertiesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg','CustomFunction');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Property.id'=>'desc'));
    public function index($id=null)
    {
        $cond=array();
        if($id!=null)
        $cond=array('project_id'=>$id);
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Property->parseCriteria($this->Prg->parsedParams()),$cond);
        $this->set('Property', $this->Paginator->paginate());        
    }    
    public function add()
    {
        $this->loadModel('Project');
        $this->set('projectName',$this->Project->find('list'));
        $this->loadModel('Unit');
        $this->set('unitName',$this->Unit->find('list'));
        if ($this->request->is('post'))
        {
            $this->Property->create();
            try
            {
                $this->loadModel('PropertiesPhoto');
                $this->loadModel('PropertiesDocument');                
                if ($this->Property->save($this->request->data))
                {
                    $prPhoto=array();
                    $dirName="propertiesphotos";
                    foreach($this->request->data['Pr']['PropertiesPhoto'] as $propertyPhoto)
                    {
                        $fileName=$this->CustomFunction->Upload($propertyPhoto['tmp_name'],$propertyPhoto['name'],$dirName,200,200);
                        if(strlen($fileName)>0)
                        {
                            $prPhoto[]=(array('property_id'=>$this->Property->id,'photo' => $fileName,'dir'=>$dirName));
                        }
                    }
                    $prDocument=array();
                    $dirName="propertiesdocuments";
                    foreach($this->request->data['Pr']['PropertiesDocument'] as $propertyPhoto)
                    {
                        $fileName=$this->CustomFunction->Upload($propertyPhoto['tmp_name'],$propertyPhoto['name'],$dirName);
                        if(strlen($fileName)>0)
                        {
                            $prDocument[]=(array('property_id'=>$this->Property->id,'photo' => $fileName,'dir'=>$dirName));
                        }
                    }                    
                    $this->PropertiesPhoto->saveAll($prPhoto);
                    $this->PropertiesDocument->saveAll($prDocument);                    
                    $this->Session->setFlash('Property has been saved. Add Flats/Plots','flash',array('alert'=>'success'));
                    return $this->redirect(array('controller'=>'PropertiesFlats','action' => 'add',$this->Property->id));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash("Invalid Post",'flash',array('alert'=>'danger'));
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
            $post[]=$this->Property->findByid($id);
        }
        $this->set('Property',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->loadModel('Project');
        $this->set('projectName',$this->Project->find('list'));
        $this->loadModel('Unit');
        $this->set('unitName',$this->Unit->find('list'));
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Property->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Your Property has been updated.','flash',array('alert'=>'success'));
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
                foreach($this->data['Property']['id'] as $key => $value)
                {
                    $this->Property->delete($value);
                }
                $this->Session->setFlash('Your Property has been deleted.','flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash('Please Delete Deal First.','flash',array('alert'=>'danger'));
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
        $post = $this->Property->findById($id);
        $this->set('post',$post);
    }
}