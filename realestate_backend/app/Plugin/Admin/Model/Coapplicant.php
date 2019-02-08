<?php
class Coapplicant extends AppModel
{
  public $useTable="clients_coapplicants";
  public $actsAs = array('search-master.Searchable','Upload.Upload' => array('photo' => array('pathMethod'=>'flat','thumbnailSizes' => array('' => '150x150',),
                                                                                              'thumbnailMethod' => 'php','thumbnailPrefixStyle' => false,'thumbnailType'=>true,'deleteOnUpdate'=>true),
                                                                             'id_proof' => array('pathMethod'=>'flat','thumbnailType'=>false,'deleteOnUpdate'=>true),
                                                                             'address_proof' => array('pathMethod'=>'flat','thumbnailType'=>false,'deleteOnUpdate'=>true),));
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Coapplicant.name'));
  public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'father_name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'address' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'district' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'state' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => false,'message' => 'Only letters and numbers allowed')),
                           'pincode' => array('numeric'=>array('rule'=>'numeric','message'=>'Only Number','allowEmpty' => true)),
                           'nationality' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'pan' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'dob' => array('numeric'=>array('rule'=>'date','message'=>'Only Date')),
                           'occupation' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty' => true,'message' => 'Only letters and numbers allowed')),
                           'email' => array('email'=>array('rule' => 'email','message' => 'Enter a valid email','allowEmpty' => true)),
                           'phone' => array('numeric'=>array('rule'=>'numeric','message'=>'Only Number','allowEmpty' => true)),
                           'photo' => array('isValidExtension' =>array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png'),false),'allowEmpty'=>true,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'allowEmpty'=>true,'message' => 'You must supply a JPG, GIF  or PNG File.')),
                           'id_proof' => array('isValidExtension' =>array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png'),false),'allowEmpty'=>true,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'allowEmpty'=>true,'message' => 'You must supply a JPG, GIF  or PNG File.')),
                           'address_proof' => array('isValidExtension' =>array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png'),false),'allowEmpty'=>true,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'allowEmpty'=>true,'message' => 'You must supply a JPG, GIF  or PNG File.')),
                           );
  public function beforeValidate($options = array())
  {
      if (!empty($this->data['Coapplicant']['dob'])) {
      $this->data['Coapplicant']['dob'] = $this->dateFormatBeforeSave($this->data['Coapplicant']['dob']);
      }
      return true;
  }  
}
?>