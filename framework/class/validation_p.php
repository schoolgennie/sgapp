<?
# All the validation functions will be added here.
class valid
{
	var $error= array();
	
	function validate($arr, $varr)
	{//print_r($varr);exit;
		foreach ($arr as $key=>$value)
		{
			foreach ($varr as $k=>$v):
				if($v['on']==$key):	
					$this->$v['type']($key,$value,$v);
				endif;
			endforeach;
		}
		if(count($this->error)>0)
		{return false;}
		else
		{return true;}
		
	}
	
	function req($key, $value, $v)   # required 
	{
		if(empty($value)):
			$this->error[]='You cannot leave <b> '.$v['p1'].'</b> field blank.';
			return false;
		else:
			return true;
		endif;	
	}
	
	
	function alphanum($key, $value, $v)
	{
		if($value && !ctype_alnum($value)):
			$this->error[]= '<b> '.$v['p1'].'</b> field has to be alpha-numeric.';
		endif;
		return true;
	}
	
	function num($key, $value, $v)
	{
		if($value && !is_numeric($value)):
			$this->error[]= '<b> '.$v['p1'].'</b> field has to be numeric.';
		endif;
		return true;
	}
	
	function fixlength($key, $value, $v)
	{
		if($value && strlen($value)!=$v['p2']):
			$this->error[]= '<b> '.$v['p1'].'</b> field length should be '.$v['p2'].' characters.';
		endif;
		return true;
	}
	function maxlength($key, $value, $v)
	{
		if(strlen($value)>$v['p2']):
			$this->error[]= '<b> '.$v['p1'].'</b> field cannot be longer than '.$v['p2'].' characters.';
		endif;
		return true;
	}
	
	function minlength($key, $value, $v)
	{
		if(strlen($value)<$v['p2']):
			$this->error[]= '<b> '.$v['p1'].'</b> field cannot be shorter than '.$v['p2'].' characters.';
		endif;
		return true;
	}
	
	function alpha($key, $value, $v)
	{
		if($value && !ctype_alpha($value)):
			$this->error[]= '<b> '.$v['p1'].'</b> field has to be alphabetic.';
		endif;
		return true;
	}
	
	function email($key, $value, $v)
	{
		if($value && !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $value)):
			$this->error[]= 'Please use correct <b>'.$v['p1'].'</b> format: <b>xxxx@xxxxx.com</b>.';
		endif;
		return true;
	}
        function phone($key, $value, $v)
	{
		if(!eregi($v['p1'], $value)):
			$this->error[]= 'Please use correct <b>Phone</b> format: <b>xxx-xxx-xxxx</b>.';
		endif;
		return true;
	}
	function compare($key, $value, $v)
	{
		if($value!=$v['p2']):
			$this->error[]='<b>'.$v['p1'].'<b>'.' does not match.';
		endif;
		return true;
	}
		function compareTime($key, $value, $v)
	{
		if(strtotime($value)>strtotime($v['p2'])):
			$this->error[]='<b>'.$v['p1'].'<b>'.' should be greater.';
		endif;
		return true;
	}
        function captcha($key, $value, $v)
	{
		if($value!=$v['p1']):
			$this->error[]='please enter right captcha value.';
		endif;
		return true;
	}
	
	function icompare($key, $value, $v)
	{
		if(strtolower($value)!=strtolower($v['p1'])):
			$this->error[]='<b>'.$v['p1'].'<b>'.' does not match.';
		endif;
		return true;
	}
	function checkDate($key, $value, $v)
	{
		 if ($value):
		   $matches=explode('-',$value);
           if (!checkdate($matches[1], $matches[0], $matches[2])) 
		   { 
            $this->error[]='Please use correct <b>'.$v['p1'].'</b> format: <b>DD-MM-YYYY</b>.';
            } 
		 endif;
		 return true;
	}
	function arrayNoElementBlank($key, $value, $v)
	{
	   if($value && count($value)!=count(array_filter($value))):
			$this->error[]='You can not leave any <b> '.$v['p1'].'</b> field blank.';
		endif;
		return true;
	}
	function arrayAllNumericValue($key, $value, $v)
	{
	   if($value):
	     $validate='';
	      foreach($value as $key=>$val):
		   if(!is_numeric($val)):
			$validate='All  <b> '.$v['p1'].'</b> field has to be numeric.';
		   endif;	
		  endforeach;	
		  
		  
		   if($validate):
		     $this->error[] = $validate;
	      endif;
		endif;
		return true;
	}
	
	function arrayValueLessThan($key, $value, $v)
	{ 
	  if($value):
	    $validate='';
	    foreach($value as $key=>$val):
			if($val>$v['p2']):
				$validate= 'all <b> '.$v['p1'].'</b> field value cannot be greater than '.$v['p2'];
				
			endif;
		  endforeach;	
		 if($validate)
		     $this->error[] = $validate;
	      endif;	
		return true;
	}
	
	
};

	
	
