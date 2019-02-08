<?php
App::uses('CakeTime', 'Utility');
class DealsPaymentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','NumToWord');
    public $components = array('Session');
    public function index($id=null)
    {
        if(!$id)
        {
            $this->Session->setFlash('Invalid Post','flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Deals','action' => 'index'));            
        }
        $post = $this->DealsPayment->find('all',array('joins'=>array(array('table'=>'deals','alias'=>'Deal','type'=>'LEFT','conditions'=>array('DealsPayment.deal_id=Deal.id')),
                                                                       array('table'=>'clients','alias'=>'Client','type'=>'LEFT','conditions'=>array('Deal.client_id=Client.id')),
                                                                       array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Deal.property_id=Property.id')),
                                                                       array('table'=>'properties_flats','alias'=>'PropertiesFlat','type'=>'LEFT','conditions'=>array('Deal.properties_flat_id=PropertiesFlat.id')),
                                                                        array('table'=>'units','alias'=>'Unit','type'=>'LEFT','conditions'=>array('PropertiesFlat.unit_id=Unit.id')),
                                                                       array('table'=>'plans','alias'=>'Plan','type'=>'LEFT','conditions'=>array('Deal.plan_id=Plan.id')),
                                                                       array('table'=>'plans_payments','alias'=>'PlansPayment','type'=>'LEFT','conditions'=>array('DealsPayment.plans_payment_id=PlansPayment.id'))),
                                                      'fields'=>array('DealsPayment.*','Deal.*','Client.*','Property.*','PropertiesFlat.*','Unit.*','Plan.*','PlansPayment.*','Paymenttype.*'),
                                                      'conditions'=>array('Deal.id'=>$id),
                                                      'order'=>array('DealsPayment.id'=>'asc')));
        if(!$post)
        {
            $this->Session->setFlash('No Payment','flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Deals','action' => 'index'));
        }
        $this->set('dealPayment',$post);
        $this->set('dealId',$id);
    }    
    public function add($dealId=null)
    {
        $this->loadModel('Paymenttype');
        $this->loadModel('Deal');
        $this->loadModel('Tax');
        $this->set('tax',$this->Tax->find('list',array('fields'=>array('id','percent','name',))));
        $this->set('paymentType',$this->Paymenttype->find('list',array('fields'=>array('id','name'))));
        $this->set('date',CakeTime::format($this->dtFormat,CakeTime::convert(time(),$this->siteTimezone)));
        $paymentCount=$this->DealsPayment->find('count',array('conditions'=>array('deal_id'=>$dealId)));
        $paymentArr=$this->Deal->find('first',array('joins'=>array(array('table'=>'plans','alias'=>'Plan','type'=>'Left','conditions'=>array('Deal.plan_id=Plan.id')),
                                                                   array('table'=>'plans_payments','alias'=>'PlansPayment','type'=>'Left','conditions'=>array('PlansPayment.deal_id=Deal.id')),
                                                                   array('table'=>'agents','alias'=>'Agent','type'=>'Left','conditions'=>array('Deal.agent_id=Agent.id'))),
                                                  'fields'=>array('PlansPayment.id','Deal.property_id','Deal.total_amount','Deal.agent_id','Deal.invoice_no','PlansPayment.name','PlansPayment.amount','PlansPayment.date','Agent.commission'),
                                                  'conditions'=>array('Deal.id'=>$dealId),'limit'=>1,'offset'=>$paymentCount,'order'=>array('PlansPayment.id'=>'asc')));
        if(!$paymentArr)
        {
            $this->Session->setFlash('All Payments Paid','flash',array('alert'=>'success'));
            return $this->redirect(array('action' => "index/$dealId"));
        }
        $paymentName=$paymentArr['PlansPayment']['name'];
        $plansPaymentId=$paymentArr['PlansPayment']['id'];
        $emi=$paymentArr['PlansPayment']['amount'];
        $dueDate=$paymentArr['PlansPayment']['date'];
        $commission=$paymentArr['Agent']['commission'];
        $invoiceNo=$paymentArr['Deal']['invoice_no'];
        $propertyId=$paymentArr['Deal']['property_id'];
        
        if ($this->request->is('post'))
        {
            $dealId=$this->data['dealId'];
            $this->DealsPayment->create();
            try
            {
                $dueDays=$this->dueDays;
                $extraPayment=$this->request->data['DealsPayment']['extra_payment'];
                $totalAmount=$emi+$extraPayment;
                $taxId=$this->request->data['DealsPayment']['tax_id'];
                $taxPost=$this->Tax->findById($taxId);
                $dealTax=0;
                if($taxPost)
                $dealTax=$taxPost['Tax']['percent'];
                $taxAmount=round(($totalAmount*$dealTax)/100);
                $amount=$totalAmount+$taxAmount;
                $this->request->data['DealsPayment']['property_id']=$propertyId;
                $this->request->data['DealsPayment']['deal_id']=$dealId;
                $this->request->data['DealsPayment']['emi']=$emi;
                $this->request->data['DealsPayment']['total_amount']=$totalAmount;
                $this->request->data['DealsPayment']['amount']=$amount;
                $this->request->data['DealsPayment']['plans_payment_id']=$plansPaymentId;
                $lastRecord=$this->DealsPayment->find('first',array('fields' => array ('id'),'order' => array('id'=>'DESC')));
                if($lastRecord)
                $receiptNo=$invoiceNo.'-'.str_pad($lastRecord['DealsPayment']['id']+1,4,"0",STR_PAD_LEFT);
                else
                $receiptNo=$invoiceNo.'-0001';
                $this->request->data['DealsPayment']['receipt_no']=$receiptNo;
                if ($this->DealsPayment->save($this->request->data))
                {
                    $agentId=$paymentArr['Deal']['agent_id'];
                    if($commission!=null && strlen($agentId)>0)
                    {
                        $commissionAmount=($commission*$totalAmount)/100;
                        $this->CustomFunction->awalletInsert($agentId,$commissionAmount,"CR",'Added for generating commission',$this->DealsPayment->id);
                    }
                    $this->Session->setFlash('Your Payment has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "add/$dealId"));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e.'Invalid Post','flash',array('alert'=>'danger'));
            }            
        }
        $dueDays=$this->dueDays;
        $targetDueDate=date('Y-m-d',strtotime($dueDate."+$dueDays days"));
        if($targetDueDate<$this->currentDate)
        {
            $lateDate=floor((strtotime($this->currentDate)-strtotime($dueDate))/(60*60*24));
            $extraPayment=round((($emi*$this->lateFees)/100)*$lateDate/365);
        }
        else
        $extraPayment=0;
        $this->set('dealId',$dealId);
        $this->set('paymentName',$paymentName);
        $this->set('emi',$emi);
        $this->set('totalAmount',$emi);
        $this->set('extraPayment',$extraPayment);
        $this->set('dueDays',$dueDays);
        $this->set('dueDate',$dueDate);
        $this->set('lateFees',$this->lateFees);
    }
    public function edit($id = null)
    {
        $this->loadModel('Paymenttype');
        $this->set('paymentType',$this->Paymenttype->find('list',array('fields'=>array('id','name'))));
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->DealsPayment->findById($id);
        }
        $this->set('DealsPayment',$post);
        $dealId=$post[0]['DealsPayment']['deal_id'];
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $dealId=$this->data['dealId'];
            unset($this->request->data['dealId']);
            try
            {
                if ($this->DealsPayment->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Your Payment has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "index/$dealId"));
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
        $this->set('dealId',$dealId);
    }
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                $this->loadModel('AwalletHistory');
                foreach($this->data['DealsPayment']['id'] as $key => $value)
                {
                    if($value>0)
                    {
                        $post=$this->AwalletHistory->findByDealsPaymentId($value);
                        if($post)
                        {
                            $agentId=$post['AwalletHistory']['agent_id'];
                            $commissionAmount=$post['AwalletHistory']['amount'];
                            $this->CustomFunction->awalletDelete($agentId,$commissionAmount);
                            $this->AwalletHistory->delete($post['AwalletHistory']['id']);
                        }
                        $this->DealsPayment->delete($value);
                        $this->Session->setFlash('Your Payment has been deleted.','flash',array('alert'=>'success'));
                        $dealId=$this->data['dealId'];
                    }                    
                }
            }
            $this->redirect(array('action' => "index/$dealId"));
            $this->set('dealId',$dealId);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e.'Invalid Post.','flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => "index/$dealId"));
        }
    }
    public function printreceipt($id = null)
    {
        $this->layout = null;
        $this->loadModel('PlansPayment');
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->DealsPayment->find('first',array('joins'=>array(array('table'=>'deals','alias'=>'Deal','type'=>'LEFT','conditions'=>array('DealsPayment.deal_id=Deal.id')),
                                                                       array('table'=>'clients','alias'=>'Client','type'=>'LEFT','conditions'=>array('Deal.client_id=Client.id')),
                                                                       array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Deal.property_id=Property.id')),
                                                                       array('table'=>'properties_flats','alias'=>'PropertiesFlat','type'=>'LEFT','conditions'=>array('Deal.properties_flat_id=PropertiesFlat.id')),
                                                                        array('table'=>'units','alias'=>'Unit','type'=>'LEFT','conditions'=>array('PropertiesFlat.unit_id=Unit.id')),
                                                                       array('table'=>'plans','alias'=>'Plan','type'=>'LEFT','conditions'=>array('Deal.plan_id=Plan.id')),
                                                                       array('table'=>'plans_payments','alias'=>'PlansPayment','type'=>'LEFT','conditions'=>array('DealsPayment.plans_payment_id=PlansPayment.id'))),
                                                      'fields'=>array('DealsPayment.*','Deal.*','Client.*','Property.*','PropertiesFlat.*','Unit.*','Plan.*','PlansPayment.*','Paymenttype.*'),
                                                      'conditions'=>array('DealsPayment.id'=>$id)));
        $dealId=$post['Deal']['id'];
        $dueDateArr = $this->PlansPayment->find('first',array('fields'=>array('PlansPayment.*'),
                                                             'conditions'=>array('PlansPayment.deal_id'=>$dealId,'PlansPayment.id >'=>$post['PlansPayment']['id']),
                                                             'order'=>array('PlansPayment.id'=>'asc')));
        if(!$post)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if($dueDateArr)
        $dueDate=$dueDateArr['PlansPayment']['date'];
        else
        $dueDate=null;
        $this->set('dueDate',$dueDate);
        $this->set('post',$post);
    }
}
