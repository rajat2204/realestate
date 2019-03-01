<?php
class OurprojectsController extends AppController
{   
    public function index()
    {
        $project=$this->Ourproject->find('all');
        $this->set('project',$project);
    }
}