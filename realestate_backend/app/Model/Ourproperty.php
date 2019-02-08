<?php
class Ourproperty extends AppModel
{
    public $useTable='properties';
    public $hasMany=array('PropertiesPhoto','PropertiesDocument');
    
}
