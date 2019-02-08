<?php
class Agent extends AppModel {
    public $actsAs = array('search-master.Searchable');
    public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Agent.name'));
    public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'address' => array('alphaNumeric'=>array('rule' => 'alphaNumericCustom','message' => 'Address Required.')),
                           'status' => array('alphaNumeric'=>array('rule' => 'alphaNumeric','required' =>true)),
                           'mobile' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')),
                           'amount' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')),
                          'action' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message' => 'Please select')),
                          'remarks' => array('alphaNumeric'=>array('rule' =>'alphaNumeric','required'=>true,'allowEmpty'=>false,'message'=>'Only Alphabets')),
                           'commission' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')));
    public $hasOne=array('Awallet');
}
?>