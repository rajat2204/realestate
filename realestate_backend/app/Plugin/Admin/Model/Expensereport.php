<?php
class Expensereport extends AppModel
{
    public $useTable = 'expenses_payments';
    public $belongsTo=array('Expense');
}
?>