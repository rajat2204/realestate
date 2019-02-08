<?php
class Lead extends AppModel
{
  public $belongsTo=array('Property');
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Lead.status'));
  public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'address' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'phone' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'email' => array('email'=>array('rule' => 'email','message' => 'Enter a valid email','allowEmpty' => true)),
                           'follow_up' => array('numeric'=>array('rule'=>'datetime','message'=>'Only Date & Time')),
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'status' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'message' => 'Only letters and numbers allowed')));
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['Lead']['follow_up'])) {
      $this->data['Lead']['follow_up'] = $this->dateTimeFormatBeforeSave($this->data['Lead']['follow_up']);
      }
      return true;
  }
}
?>