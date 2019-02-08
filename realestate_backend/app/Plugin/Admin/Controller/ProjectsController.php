<?php
class ProjectsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('name'=>'asc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Project->parseCriteria($this->Prg->parsedParams());
        $this->set('Project', $this->Paginator->paginate());        
    }    
    public function add()
    {
        $this->loadModel('ProjectsPhoto');
        $this->loadModel('ProjectsLayoutplan');
        $this->loadModel('ProjectsLocationmap');
        if ($this->request->is('post'))
        {
            $this->Project->create();
            try
            {
                if ($this->Project->save($this->request->data))
                {
                    $prPhoto=array();
                    $dirName="projectsphotos";
                    foreach($this->request->data['Pr']['ProjectsPhoto'] as $projectPhoto)
                    {
                        $fileName=$this->CustomFunction->Upload($projectPhoto['tmp_name'],$projectPhoto['name'],$dirName,200,200);
                        if(strlen($fileName)>0)
                        {
                            $prPhoto[]=(array('project_id'=>$this->Project->id,'photo' => $fileName,'dir'=>$dirName));
                        }
                    }
                    $prLayoutPlan=array();
                    $dirName="projectslayoutplans";
                    foreach($this->request->data['Pr']['ProjectsLayoutplan'] as $projectPhoto)
                    {
                        $fileName=$this->CustomFunction->Upload($projectPhoto['tmp_name'],$projectPhoto['name'],$dirName);
                        if(strlen($fileName)>0)
                        {
                            $prLayoutPlan[]=(array('project_id'=>$this->Project->id,'photo' => $fileName,'dir'=>$dirName));
                        }
                    }
                    $prLocationMap=array();
                    $dirName="projectslocationmaps";
                    foreach($this->request->data['Pr']['ProjectsLocationmap'] as $projectPhoto)
                    {
                        $fileName=$this->CustomFunction->Upload($projectPhoto['tmp_name'],$projectPhoto['name'],$dirName);
                        if(strlen($fileName)>0)
                        {
                            $prLocationMap[]=(array('project_id'=>$this->Project->id,'photo' => $fileName,'dir'=>$dirName));
                        }
                    }
                    $this->ProjectsPhoto->saveAll($prPhoto);
                    $this->ProjectsLayoutplan->saveAll($prLayoutPlan);
                    $this->ProjectsLocationmap->saveAll($prLocationMap);
                    $this->Session->setFlash('Your Project has been saved.','flash',array('alert'=>'success'));
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
            $post[]=$this->Project->findByid($id);
        }
        $this->set('Project',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Project->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Your Project has been saved.','flash',array('alert'=>'success'));
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
                foreach($this->data['Project']['id'] as $key => $value)
                {
                    $this->Project->delete($value);
                }
                $this->Session->setFlash('Your Project has been deleted.','flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash('Please delete all realted entry first','flash',array('alert'=>'danger'));
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
        $post = $this->Project->findById($id);
        $this->set('post',$post);
    }
}
