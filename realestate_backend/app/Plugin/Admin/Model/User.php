<?php
class User extends AppModel {
    public $actsAs = array('search-master.Searchable');
    public $filterArgs = array('keyword' => array('type' => 'like','field'=>'User.name'));
    public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'username' => array('isUnique'=>array('rule' => 'isUnique','message' => 'This Username has already been taken.'),
                                            'alphaNumeric'=>array('rule'=>'alphaNumericCustom','message'=>'Only letters and numbers allowed')),
                           'mobile' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')),
                           'email' => array('rule' => 'email','message' => 'Enter a valid email','required' => true,'allowEmpty' => true));
    public function assingPages($id)
    {
        $Page=ClassRegistry::init('Page');
        return$Page->find('all',array('joins'=>array(array('table'=>'page_rights','alias'=>'PageRight','type'=>'Left',
                                                        'conditions'=>array('Page.id=PageRight.page_id',"PageRight.ugroup_id=$id"))),
                                      'fields'=>array('Page.*,PageRight.*'),                                      
                                   'order'=>'Page.model_name asc'));
    }
    public function beforeSave($options = array())
    {
        if (!empty($this->data['User']['password'])) {
        $this->data['User']['password'] = $this->passwordHasher($this->data['User']['password']);
        }
        else
        {
          unset($this->data['User']['password']);  
        }
        return true;
    }
}
?>