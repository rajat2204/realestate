<?php
class Tax extends AppModel
{
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Tax.name'));
  public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'percent' => array('numeric'=>array('rule'=>'numeric','message'=>'Only Number')),
                           );
}
?>