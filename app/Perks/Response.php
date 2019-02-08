<?php
namespace Perks;

/**
* 
*/
class Response
{
	private $errors;
	private $response;
	private $language;
	function __construct($data){
		$this->errors 		= $data;
		$this->response 	= $data;
		$this->language     = \App::getLocale();
	}
	
	public function api_error_response(){
		$this->errors = json_decode(json_encode($this->errors));
		$errorData = [];
		if(!empty($this->errors)){
			$i = 0;
            foreach ($this->errors as $key => $value) {
                $errorData[$i]['key'] = $key;
                $errorData[$i]['value'] = $value[0];
                break;
            }
        }
        return ($errorData);
    }

    public function web_error_response(){
        $error_array = json_decode(json_encode($this->errors),true);
        return (object)[array_keys($error_array)[0] => [current($error_array)[0]]];
	}

	public function api_common_response(){
        $data = json_decode(json_encode($this->response),true);
        
        array_walk_recursive($data,function(&$item, $key){
            
            if(empty($item)){
                $item = '';
            } 

            /*CANDIDATE WORK EXPERIENCE*/
            if($key === 'relieving_month'){
                $item = !empty($item) ? month('F',$item,$this->language) : trans('website.till_date',[],NULL, $this->language);
            }

            if($key === 'joining_month'){
               $item = !empty($item) ? month('F',$item,$this->language) : trans('website.till_date',[],NULL, $this->language);
            }

            if($key === 'experience_level'){
                $item = experience_level(false,$item,$this->language);
            }

            /*CANDIDATE CERTIFICATE*/
            if($key === 'received_month'){
                $item = !empty($item) ? month('F',$item,$this->language) : trans('website.till_date',[],NULL, $this->language);
            }

            if($key === 'till_month'){
               $item = !empty($item) ? month('F',$item,$this->language) : trans('website.till_date',[],NULL, $this->language);
            }

            /*CANDIDATE LANGUAGE*/

            if($key === 'ilr_level'){
            	$item = ilr_level($item,$this->language);
            }
        });

        return $data;
	}	

    public function json_change($array, $newkey, $oldkey) {
        $json = str_replace('"'.$oldkey.'":', '"'.$newkey.'":', json_encode($array));
        return json_decode($json,true);  
    }
}

?>

