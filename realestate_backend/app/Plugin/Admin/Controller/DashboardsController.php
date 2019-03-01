<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
class DashboardsController extends AdminAppController
{
    public $components = array('HighCharts.HighCharts');
    public function index()
    {
        $limit=5;
        $this->loadModel('Deal');
        $this->loadModel('DealsPayment');
        $this->loadModel('ExpensesPayment');
        $this->loadModel('PurchasesPayment');
        $currentDateTime=CakeTime::format('Y-m-d',CakeTime::convert(time(),$this->siteTimezone));
        for ($i = 0; $i < 12; ++$i)
        {
            $year=CakeTime::format("-$i months",'%Y',$this->siteTimezone);
            $month=CakeTime::format("-$i months",'%m',$this->siteTimezone);
            $monthName=CakeTime::format("-$i months",'%b %Y',$this->siteTimezone);
            $graphMonth[]=$monthName;
            $earningArr=$this->DealsPayment->find('all',array('fields'=>array('SUM(DealsPayment.total_amount) AS earning'),
                                                              'conditions'=>array('MONTH(DealsPayment.payment_date)'=>$month,'YEAR(DealsPayment.payment_date)'=>$year)));
            if($earningArr[0][0]['earning']==null)
            $earning=0;
            else
            $earning=$earningArr[0][0]['earning'];
            $earningChartData[]=(float) $earning;
            
            $expenseArr=$this->ExpensesPayment->find('all',array('joins'=>array(array('table'=>'expenses','alias'=>'Expense','type'=>'LEFT','conditions'=>array('Expense.id=ExpensesPayment.expense_id'))),
                                                         'fields'=>array('SUM(ExpensesPayment.amount) AS expense'),
                                                         'conditions'=>array('MONTH(date)'=>$month,'YEAR(date)'=>$year)));
            if($expenseArr[0][0]['expense']==null)
            $expense=0;
            else
            $expense=$expenseArr[0][0]['expense'];
            $expenseChartData[]=(float) $expense;
            
            $purchaseArr=$this->PurchasesPayment->find('all',array('joins'=>array(array('table'=>'purchases','alias'=>'Purchase','type'=>'LEFT','conditions'=>array('Purchase.id=PurchasesPayment.purchase_id'))),
                                                         'fields'=>array('SUM(PurchasesPayment.amount) AS purchase'),
                                                         'conditions'=>array('MONTH(date)'=>$month,'YEAR(date)'=>$year)));
            if($purchaseArr[0][0]['purchase']==null)
            $purchase=0;
            else
            $purchase=$purchaseArr[0][0]['purchase'];
            $purchaseChartData[]=(float) $purchase;
            
            $profitChartData[]=(float) $earning-$purchase-$expense;
        }
        $graphMonth=array_reverse($graphMonth);
        $tooltipFormatFunction ="function() { return '<b>'+ this.series.name +'</b><br/>'+ this.x +': '+''+ this.y ;}";
        $chartName = "My Chartsr";
        $mychart = $this->HighCharts->create($chartName,'line');
        $this->HighCharts->setChartParams(
                                          $chartName,
                                          array(
                                                'renderTo'=> "mywrappersr",  // div to display chart inside
                                                'titleAlign'=> 'center',
                                                'creditsEnabled'=> FALSE,
                                                'xAxisLabelsEnabled'=> TRUE,
                                                'xAxisCategories'=> $graphMonth,
                                                'yAxisTitleText'=> '',
                                                'tooltipEnabled'=> TRUE,
                                                'tooltipFormatter'=> $tooltipFormatFunction,
                                                'enableAutoStep'=> FALSE,
                                                'plotOptionsShowInLegend'=> TRUE,                                              
                                                )
                                          );
        $series = $this->HighCharts->addChartSeries();
        $series->addName('Sales Report')->addData(array_reverse($earningChartData));
        $mychart->addSeries($series);
        $series = $this->HighCharts->addChartSeries();
        $series->addName('Purchase Report')->addData(array_reverse($purchaseChartData));
        $mychart->addSeries($series);
        $series = $this->HighCharts->addChartSeries();
        $series->addName('Expense Report')->addData(array_reverse($expenseChartData));
        $mychart->addSeries($series);
        $series = $this->HighCharts->addChartSeries();
        $series->addName('Profit & Loss Report')->addData(array_reverse($profitChartData));
        $mychart->addSeries($series);
        
        
        $this->loadModel('Lead');
        $this->Lead->bindModel(array('belongsTo'=>array('Property')));
        $Lead=$this->Lead->find('all',array(
                                            'fields'=>array('Lead.name','Lead.phone','Property.name','Lead.follow_up'),
                                            'conditions'=>array('Lead.status'=>'In Process','Lead.follow_up >='=>$currentDateTime),
                                            'order'=>array('Lead.follow_up'=>'asc'),
                                            'limit'=>$limit));
        $this->set('Lead',$Lead);
        
        $this->Deal->bindModel(array('belongsTo'=>array('Client','Property')));
        $Deal=$this->Deal->find('all',array(
                                            'fields'=>array('Client.name','Property.name','Deal.date','Deal.total_amount'),
                                            'order'=>array('Deal.date'=>'desc'),
                                            'limit'=>$limit));
        $this->set('Deal',$Deal);
        
        $this->loadModel('Property');
        $Property=$this->Property->find('all',array(
                                            'fields'=>array('Property.name','Property.type','Property.availiable'),
                                            'order'=>array('Property.id'=>'desc'),
                                            'limit'=>$limit));
        $this->set('Property',$Property);
        
        $Expense=$this->ExpensesPayment->find('all',array(
                                                'joins'=>array(array('table'=>'expenses','alias'=>'Expense','type'=>'LEFT','conditions'=>array('Expense.id=ExpensesPayment.expense_id')),
                                                               array('table'=>'expense_categories','alias'=>'ExpenseCategory','type'=>'LEFT','conditions'=>array('ExpenseCategory.id=Expense.expense_category_id'))),
                                                  'fields'=>array('ExpenseCategory.name','ExpensesPayment.amount','ExpensesPayment.date','ExpensesPayment.remarks'),
                                                  'order'=>array('Expense.id'=>'desc'),
                                                  'limit'=>$limit));
        $this->set('Expense',$Expense);
    }    
}