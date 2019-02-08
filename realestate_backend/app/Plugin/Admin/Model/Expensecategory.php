<?php
class ExpenseCategory extends AppModel
{
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('name' => 'like','field'=>'Expensecategory.name'));
  public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),                           
                           );
}
?>