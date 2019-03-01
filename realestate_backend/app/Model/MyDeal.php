<?php
class MyDeal extends AppModel
{
  public $useTable="deals";
   public $belongsTo=array('Client','Property','PropertiesFlat'=>array('className'=>'PropertiesFlat'),'Plan','Agent','Unit'=>array('foreignKey'=>false,'conditions'=> array('PropertiesFlat.unit_id=Unit.id')));
}
?>