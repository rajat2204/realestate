<?php
class OurpropertiesController extends AppController
{
    public function index($id=null)
    {
        $this->loadModel('Ourproject');
        $projectName=$this->Ourproject->findById($id);
        $this->set('projectName',$projectName['Ourproject']['name']);
        $project=$this->Ourproperty->findAllByProjectId($id);
        $this->set('project',$project);
        if(!$project)
        {
            $this -> Session -> setFlash('No properties found !','flash', array('alert'=> 'danger'));
        }
        
    }
}