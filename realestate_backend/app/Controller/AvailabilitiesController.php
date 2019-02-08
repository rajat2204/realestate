<?php
class AvailabilitiesController extends AppController
{   
    public function index()
    {
         
        $this->loadModel('Project');
        $this->loadModel('Property');
        $this->loadModel('PropertiesFlat');
        $this->set('project',$this->Project->find('list'));
        $this->set('propertyName',$this->Property->find('list'));        
        $flats=array();
        if($this->request->is('post'))
        {
            $cond=array();
            if($this->request->data['Availability']['name'])
            $cond=array('PropertiesFlat.name'=>$this->request->data['Availability']['name']);
            $flats=$this->PropertiesFlat->find('all',array('joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'INNER','conditions'=>array('Property.id=PropertiesFlat.property_id'))),
                                                          'conditions'=>array('Property.project_id'=>$this->request->data['Availability']['project_id'],'PropertiesFlat.property_id'=>$this->request->data['Availability']['property_id'],$cond)));            
        }
        $this->set('flats',$flats);
    }
    public function showproperties()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        if (!$id)
        {
            return $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('Property');
        $propertyName=$this->Property->find('list',array('fields'=>array('id','name'),'conditions'=>array('project_id'=>$id)));
        $this->set(compact('propertyName'));
        $this->render('showproperties','ajax');
    }
}