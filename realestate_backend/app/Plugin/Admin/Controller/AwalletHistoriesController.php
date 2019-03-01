<?php
class AwalletHistoriesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('id'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
    }
    public function index($id=null)
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $cond="";
        if($id)
        $cond=" 1=1 AND `agent_id`=$id ";
        $this->Paginator->settings['conditions'] = array($this->AwalletHistory->parseCriteria($this->Prg->parsedParams()),$cond);
        $this->loadModel('Awallet');
        if(strlen($cond)>0)
        $this->set('aWallet',$this->Awallet->find('first',array('conditions'=>$cond)));
        else
        {
            $this->Awallet->virtualFields=array('credit'=>'SUM(credit)','debit'=>'SUM(debit)','balance'=>'SUM(balance)');
            $this->set('aWallet',$this->Awallet->find('first',array('conditions'=>$cond)));
        }
        $this->set('record', $this->Paginator->paginate());
        $this->set('id',$id);
    }
    
}
