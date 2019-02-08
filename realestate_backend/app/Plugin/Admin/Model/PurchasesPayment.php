<?php
class PurchasesPayment extends AppModel
{
  public $belongsTo=array('Purchase','Paymenttype');
  public $validate = array('date' => array('numeric'=>array('rule'=>'date','message'=>'Only Date')),
                           'paymenttype_id' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           'amount' =>array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),                           
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')));
}
?>