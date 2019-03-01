<?php
App::uses('CakeTime', 'Utility');
class InventoriesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Inventory.id'=>'desc'));
    public function index($id=null)
    {
        $cond=array();
        if($id!=null)
        $cond=array('Inventory.project_id'=>$id);
        $this->Prg->commonProcess();
        $this->Inventory->virtualFields= array('qty' => 'SELECT SUM(InventoriesBalance.qty) as Inventories__qty FROM `inventories_balances` as `InventoriesBalance` WHERE `InventoriesBalance`.`inventory_id`=`Inventory`.`id`');
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Inventory->parseCriteria($this->Prg->parsedParams()),$cond);
        $this->set('Inventory', $this->Paginator->paginate());        
    }    
    public function add()
    {
        $this->loadModel('Project');
        $this->set('projectName',$this->Project->find('list'));
        $this->loadModel('Vendor');
        $this->set('vendorName',$this->Vendor->find('list'));
        $this->loadModel('ExpenseCategory');
        $this->set('expenseCategory',$this->ExpenseCategory->find('list',array('conditions'=>array('status'=>'Active'))));
        $this->set('date',CakeTime::format($this->dtFormat,CakeTime::convert(time(),$this->siteTimezone)));
        if ($this->request->is('post'))
        {
            $this->Inventory->create();
            try
            {
                if ($this->Inventory->save($this->request->data))
                {
                    $this->Session->setFlash('Your Inventory has been saved.','flash',array('alert'=>'success'));
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
            $post[]=$this->Inventory->findByid($id);
        }
        $this->loadModel('ExpenseCategory');
        $this->set('expenseCategory',$this->ExpenseCategory->find('list',array('conditions'=>array('status'=>'Active'))));
        $this->loadModel('Project');
        $this->set('projectName',$this->Project->find('list'));
         $this->loadModel('Vendor');
        $this->set('vendorName',$this->Vendor->find('list'));
        $this->set('Inventory',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Inventory->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Your Inventories has been saved.','flash',array('alert'=>'success'));
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
                foreach($this->data['Inventory']['id'] as $key => $value)
                {
                    $this->Inventory->delete($value);
                }
                $this->Session->setFlash('Your Inventories has been deleted.','flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
}
