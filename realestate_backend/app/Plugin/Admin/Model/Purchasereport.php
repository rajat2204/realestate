<?php
class Purchasereport extends AppModel
{
    public $useTable = 'purchases_payments';
    public $belongsTo=array('Purchase');
}
?>