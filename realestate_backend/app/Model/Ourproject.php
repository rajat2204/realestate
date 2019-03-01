<?php
class Ourproject extends AppModel
{
    public $useTable='projects';
    public $hasMany=array('ProjectsPhoto','ProjectsLayoutplan','ProjectsLocationmap');
    
}
