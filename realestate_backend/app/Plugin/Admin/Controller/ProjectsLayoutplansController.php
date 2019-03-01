<?php
class ProjectsLayoutplansController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session','CustomFunction');
    public function index($id=null)
    {
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Projects','action' => 'index'));            
        }
        $this->loadModel('Project');
        $post=$this->Project->findById($id);
        if(!$post)
        {
            $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Projects','action' => 'index'));  
        }
        $projectsPhoto=$this->ProjectsLayoutplan->findAllByProjectId($id);
        $this->set('ProjectsLayoutplan', $projectsPhoto);
        $this->set('projectId',$id);
    }    
    public function add($id=null)
    {
        if ($this->request->is('post'))
        {
            if ($this->request->is('post'))
            {
                $this->ProjectsLayoutplan->create();
                try
                {
                    $prPhoto=array();
                    $projectId=$this->data['projectId'];
                    $dirName="projectslayoutplans";
                    foreach($this->request->data['ProjectsLayoutplan']['photo'] as $propertyPhoto)
                    {
                        $fileName=$this->CustomFunction->Upload($propertyPhoto['tmp_name'],$propertyPhoto['name'],$dirName,200,200);
                        if(strlen($fileName)>0)
                        {
                            $prPhoto[]=(array('project_id'=>$projectId,'photo' => $fileName,'dir'=>$dirName));
                        }
                    }
                    $this->ProjectsLayoutplan->saveAll($prPhoto);
                    $this->Session->setFlash('Layout Plan has been saved','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "index/$projectId"));
                }
                catch (Exception $e)
                {
                    $this->Session->setFlash('Something wrong','flash',array('alert'=>'danger'));
                    return $this->redirect(array('action' => 'index'));
                }
            }            
            $this->set('isError',true);
            $this->set('projectId',$projectId);
        }        
        else
        {
            $this->layout = null;
            $this->set('projectId',$id);
            $this->set('isError',false);
        }
    }    
    public function deleteall()
    {
        if ($this->request->is('post'))
        {
            foreach($this->data['ProjectsLayoutplan']['id'] as $key => $value)
            {
                $ProjectsLayoutplan=$this->ProjectsLayoutplan->findById($value);
                if($ProjectsLayoutplan)
                {
                    $fileName=$ProjectsLayoutplan['ProjectsLayoutplan']['photo'];
                    $dirName=$ProjectsLayoutplan['ProjectsLayoutplan']['dir'];
                    $this->ProjectsLayoutplan->delete($value);
                    $this->CustomFunction->fileDelete($fileName,$dirName);
                }
            }
            $this->Session->setFlash('Layout Plan has been deleted.','flash',array('alert'=>'success'));
            $projectId=$this->data['projectId'];
        }
        $this->redirect(array('action' => "index/$projectId"));
        $this->set('projectId',$projectId);
    }
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->ProjectsLayoutplan->findById($id);
        if (!$post)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $photoImg=$post['ProjectsLayoutplan']['dir'].'/'.$post['ProjectsLayoutplan']['photo'];
        $this->set('photoImg',$photoImg);        
    }
}
