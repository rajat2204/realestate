<?php
class OurflatsController extends AppController
{
    public function index($id=null)
    {
        $this->loadModel('Property');
        $project=$this->Ourflat->findAllByPropertyId($id);
        $this->set('project',$project);
        $property=$this->Property->findById($id);
        $this->set('propertyName',$property['Property']['name']);
        if(!$project)
        {
            $this -> Session -> setFlash('No Flats / Plots found !','flash', array('alert'=> 'danger'));
        }
        
    }
}