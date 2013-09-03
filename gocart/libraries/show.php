<?php
class Show{
	var $CI;
	function __construct()
	{
		$this->CI =& get_instance();
	}
	public function p($array)
    {	
    	if(isset($array) && !empty($array))
		{	
			
			echo "<pre>";
			print_r($array);
		}	
	}
	
	
	public function pe($array)
    {	
    		if(isset($array) && !empty($array))
			{
				echo "<pre>";
				print_r($array);
				exit;
			}
	}
	
}
?>