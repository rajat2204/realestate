<?php
class Property extends AppModel
{
  public $hasMany=array('PropertiesPhoto','PropertiesDocument');
  public $belongsTo=array('Project');
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Property.name'),
                             'skeyword' => array('field'=>'Property.status'));
  public $validate = array('project_id' => array('rule' => 'numeric','message' => 'Please Select an item in the list'),
                           'name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'type' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Please select one of these options.')),
                           'availiable' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Please select one of these options.')),
                           'remarks' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')));
}
?>