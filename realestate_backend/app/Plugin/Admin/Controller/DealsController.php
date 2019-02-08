<?php
class DealsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Deal.id'=>'desc'));
    public function index($id=null)
    {
        $cond=array();
        if($id!=null)
        $cond=array('Property.project_id'=>$id);
        $this->Prg->commonProcess();
        $this->Deal->virtualFields= array('payment' => 'SELECT SUM(DealPayment.emi) as Deal__payment FROM `deals_payments` as `DealPayment` WHERE `DealPayment`.`deal_id`=`Deal`.`id`');
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Deal->parseCriteria($this->Prg->parsedParams()),$cond);
        $this->set('Deal', $this->Paginator->paginate());
    }
    public function select2()
    {
        $this->Client->recursive = 0;
        $this->set('clients', $this->paginate());
    }
    public function clientsearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Client');
        $term = $this->request->query['q'];
        $users = $this->Client->find('all',array('conditions' => array('Client.name LIKE' => '%'.$term.'%')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = (int) $user['Client']['id'];
            $result[$key]['text'] = $user['Client']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
    public function propertysearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Property');
        $term = $this->request->query['q'];
        $cond=array();$cond1=array();
        if(isset($this->request->query['q1']))
        {
            $cond=array('Property.type' => $this->request->query['q1']);
        }
        if($this->request->query['q2'])
        {
            $cond1=array('Property.project_id' => $this->request->query['q2']);
        }
        $users = $this->Property->find('all',array('fields'=>array('Property.id','Property.name'),
                                               'conditions' => array('Property.name LIKE' => '%'.$term.'%',$cond,'Property.status'=>'Availiable',$cond1)));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = (int) $user['Property']['id'];
            $result[$key]['text'] = $user['Property']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
    public function propertyflat()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('PropertiesFlat');
        $term = $this->request->query['q'];
        $cond=array();$cond1=array();
        if(isset($this->request->query['q1']))
        {
            $cond=array('Property.id' => $this->request->query['q1']);
        }
        $users = $this->PropertiesFlat->find('all',array('fields'=>array('PropertiesFlat.id','PropertiesFlat.name'),
                                               'joins'=>array(array('table'=>'properties','alias'=>'Property','type'=>'INNER','conditions'=>array('PropertiesFlat.property_id=Property.id'))),
                                               'conditions' => array('PropertiesFlat.name LIKE' => '%'.$term.'%',$cond,'Property.status'=>'Availiable','PropertiesFlat.status'=>'Availiable'),
                                               'group'=>array('PropertiesFlat.id')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = (int) $user['PropertiesFlat']['id'];
            $result[$key]['text'] = $user['PropertiesFlat']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
    public function flatdetails()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        $id=$this->request->query['id'];
        $this->loadModel('PropertiesFlat');
        $post=$this->PropertiesFlat->find('first',array('fields'=>array('PropertiesFlat.area','PropertiesFlat.price','Unit.name'),
                                                        'joins'=>array(array('table'=>'units','alias'=>'Unit','conditions'=>array('PropertiesFlat.unit_id=Unit.id'))),
                                                        'conditions'=>array('PropertiesFlat.id'=>$id)));
        $postArr=array('#DealArea'=>$post['PropertiesFlat']['area'],'#DealAmount'=>$post['PropertiesFlat']['price']);
        echo json_encode($postArr);
    }
    public function plandetails()
    {
        $this->layout=null;
        $this->autoRender = false;
        $this->layout=null;
        $this->request->onlyAllow('ajax');
        $id=$this->request->query['id'];
        $this->loadModel('Plan');
        $plan=$this->Plan->find('list',array('fields'=>array('Plan.id','Plan.name'),'conditions'=>array('Plan.properties_id'=>$id)));
        $this->set(compact('plan'));
        $this->render('showplan');
    }
    public function add()
    {
        $this->loadModel('Client');
        $this->loadModel('Property');
        $this->loadModel('PropertiesFlat');
        $this->loadModel('Project');
        $this->loadModel('Agent');
        $this->loadModel('Plan');
        $this->set('clientId',$this->Client->find('list',array('fields'=>array('id','name'))));
        $this->set('propertyId',$this->Property->find('list',array('fields'=>array('id','name'))));
        $this->set('flatId',$this->PropertiesFlat->find('list',array('fields'=>array('id','name'))));
        $this->set('projectName',$this->Project->find('list'));
        $this->set('plan',$this->Plan->find('list'));
        $this->set('agent',$this->Agent->find('list',array('fields'=>array('id','name'),'conditions'=>array('Agent.status'=>'Active'),'order'=>array('Agent.name'=>'asc'))));
        $lastRecord=$this->Deal->find('first',array('fields' => array ('id'),'order' => array('id'=>'DESC')));
        $currYear=date('Y');
        if($lastRecord)
        $invoiceNo=$this->siteShort.'-'.$currYear.'-'.str_pad($lastRecord['Deal']['id']+1,4,"0",STR_PAD_LEFT);
        else
        $invoiceNo=$this->siteShort.'-'.$currYear.'-0001';
        $this->set('invoiceNo',$invoiceNo);
        if ($this->request->is('post'))
        {
            $this->Deal->create();
            try
            {
                $dealDiscount=0;
                $flatArr=$this->PropertiesFlat->findById($this->request->data['Deal']['properties_flat_id']);
                $dealAmount=$flatArr['PropertiesFlat']['price'];
                $dealArea=$flatArr['PropertiesFlat']['area'];
                $dealDiscount=$this->request->data['Deal']['discount'];
                $totalAmount=($dealAmount-$dealDiscount);
                $this->request->data['Deal']['area']=$dealArea;
                $this->request->data['Deal']['amount']=$dealAmount;
                $this->request->data['Deal']['total_amount']=$totalAmount;
                if ($this->Deal->save($this->request->data))
                {
                    $this->PropertiesFlat->save(array('id'=>$flatArr['PropertiesFlat']['id'],'status' => 'Sold'));
                    $this->Session->setFlash('Your Deal has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('controller'=>'plans_payments','action' => 'add',$this->Deal->id));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Please Select Client Name & Property Name','flash',array('alert'=>'danger'));
            }
        }
    }
    public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $post = $this->Deal->find('first',array('conditions'=>array('Deal.id'=>$id)));
        $this->set('post',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->Deal->id = $id;
            try
            {
                if ($this->Deal->save($this->request->data))
                {
                    $this->Session->setFlash('Your Deal has been updated.','flash',array('alert'=>'success'));
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
                $this->loadModel('PropertiesFlat');
                foreach($this->data['Deal']['id'] as $key => $value)
                {
                    $dealArr=$this->Deal->findById($value);
                    if($dealArr)
                    {
                        $propertyFlatId=$dealArr['Deal']['properties_flat_id'];
                        $this->PropertiesFlat->save(array('id'=>$propertyFlatId,'status' => 'Availiable'));
                    }
                    $this->Deal->delete($value);
                }
                $this->Session->setFlash('Your Deal has been deleted.','flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash('Please Delete Deals Payment first','flash',array('alert'=>'danger'));
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
        $post = $this->Deal->find('first',array('conditions'=>array('Deal.id'=>$id)));
        $this->set('post',$post);
    }
    public function printinvoice($id = null)
    {
        $this->layout = null;
        $this->loadModel('PlansPayment');
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('DealsPayment');
        $post = $this->Deal->findById($id);
        if(!$post)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('plansPaymentArr',$this->PlansPayment->find('all',array('conditions'=>array('PlansPayment.deal_id'=>$id))));
        $this->set('post',$post);
    }
}
