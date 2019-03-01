<?php
class CurrenciesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('name'=>'asc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Currency->parseCriteria($this->Prg->parsedParams());
        $this->set('Currency', $this->Paginator->paginate());        
    }    
    public function add()
    {
        if ($this->request->is('post'))
        {
            if ($this->request->is('post'))
            {
                $this->Currency->create();
                try
                {
                    if ($this->Currency->save($this->request->data))
                    {
                        $this->Session->setFlash('Your Currency has been saved.','flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'add'));
                    }
                }
                catch (Exception $e)
                {
                    $this->Session->setFlash('Currency Name already exist.','flash',array('alert'=>'danger'));
                }
            }
        }
    }    
    public function deleteall()
    {
        if ($this->request->is('post'))
        {
            foreach($this->data['Currency']['id'] as $key => $value)
            {
                $this->Currency->delete($value);
            }
            $this->Session->setFlash('Your Currency has been deleted.','flash',array('alert'=>'success'));
        }        
        $this->redirect(array('action' => 'index'));
    }
}
