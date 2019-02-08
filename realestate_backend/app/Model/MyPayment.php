<?php
class MyPayment extends AppModel
{
  public $useTable="deals_payments";
  public $belongsTo=array('Paymenttype');
}
?>