<?php
class MyInvpastduesController extends AppController
{
    public $components = array('Session','search-master.Prg');
    public function index()
    {
        $startDate=CakeTime::format('Y-m-d',CakeTime::convert(time(),$this->siteTimezone));
        $endDate=CakeTime::format('Y-m-31',CakeTime::convert(time(),$this->siteTimezone));
        $deal=$this->MyInvpastdue->find('all',array('fields'=>array('Client.id','Client.name','Client.phone','Client.address','Client.email','Property.name','Property.remarks','Project.name','PropertiesFlat.name','PropertiesFlat.type','PropertiesFlat.floor_no','PropertiesFlat.area','Deal.id','Deal.plan_id','Deal.invoice_no','MyInvpastdue.id','MyInvpastdue.name','MyInvpastdue.date','Deal.total_amount','MyInvpastdue.amount'),
                                                    'conditions'=>array('DealsPayment.id IS NULL','MyInvpastdue.date <='=>$startDate,'MyInvpastdue.date <='=>$endDate,'Deal.client_id'=>$this->userValue['User']['id'])));
        $this->set('deal',$deal);
    }    
}