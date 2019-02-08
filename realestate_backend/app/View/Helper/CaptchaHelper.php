<?php

class CaptchaHelper extends AppHelper {
  public $helpers = array('Html', 'Form');
  function render($settings=array()) {
    switch($settings['captchaType']):
      case 'image':
        echo $this->Html->image($this->Html->url(array('action'=>'captcha'), true),array('id'=>'img-captcha','vspace'=>2));
	echo$this->Html->link($this->Html->image('refresh_icon.png',array('title'=>'Can\'t read? Reload','class'=>'img-thumbnail')),'#',array('escape'=>false,'id'=>'a-reload','style'=>'margin-left:5px;'));
        echo $this->Form->input($settings['modelName'].'.'.$settings['fieldName'], array('autocomplete'=>'off','label'=>false,'class'=>'form-control input-sm validate[required]','placeholder'=>'Enter security code shown above','value'=>'','data-errormessage'=>'* Please enter security code','div'=>false));
        if($settings['jquerylib'])  {
          echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>';
        }
?>
        <script>
        jQuery('#a-reload').click(function() {
          var $captcha = jQuery("#img-captcha");
            $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
          return false;
        });
        </script>
<?php
      break;
      case 'math':
        echo '<p>Answer simple math:</p>'.$settings['stringOperation'].' = ?';
        echo $this->Form->input($settings['modelName'].'.'.$settings['fieldName'],array('autocomplete'=>'off','label'=>false,'class'=>'form-control input-sm validate[required]','placeholder'=>'Enter security code shown above','value'=>'','div'=>false));
      break;
    endswitch;
  }
}