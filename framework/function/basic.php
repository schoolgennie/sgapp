<?
function include_functions($functions)
{
	foreach ($functions as $value):
		if(file_exists(DIR_FS_SITE_INCLUDE_FUNCTION.$value.'.php')):
			include_once(DIR_FS_SITE_INCLUDE_FUNCTION.$value.'.php');
		endif;
	endforeach;
}

function display_message($unset=0)
{
	$admin_user= new admin_session();
	if($admin_user->isset_pass_msg()):
	?>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td align="center" valign="top"><?	$array=is_array($admin_user->get_pass_msg())?$admin_user->get_pass_msg():$admin_user->get_pass_msg();		
                        foreach ($array as $value):
                        echo $value.'<br/>';
                        endforeach;?>
        </td>
      </tr>
    </table>
    <?
	endif;
	($unset)?$admin_user->unset_pass_msg():'';
}
function display_messageindex($unset=0)
{
	$admin_user= new admin_session();
	if($admin_user->isset_pass_msg()):
	?>
    <table width="100%" height="20px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#606060">
      <tr>
        <td align="center" valign="top"><?			foreach ($admin_user->get_pass_msg() as $value):
            echo $value;
        endforeach;?>
        </td>
      </tr>
    </table>
    <?
	endif;
	($unset)?$admin_user->unset_pass_msg():'';
}



function get_var_if_set($array, $var)
{
	return isset($array[$var])?$array[$var]:'';
}




function array_map_recursive($callback, $array) {
  $b = Array();
  foreach ($array as $key => $value) {
    $b[$key] = is_array($value) ? array_map_recursive($callback, $value) : call_user_func($callback, $value);
  }
  return $b;
}


	
	function comaSepratedStringConversion($string)
	{
	  $array = explode(',', $string);
	  $newArray = array();
	  foreach($array as $value)
	  {
		$newArray[] = '"' . $value . '"';
	  }
	  $newString = implode(',', $newArray);
	  return $newString;
	}
	
	
	function serialNo($pageNo,$numberOfRecords)
	{   
		$value=(($pageNo*$numberOfRecords)-$numberOfRecords)+1;
		return $value;
	}
	
	

function generateCode($characters) 
{
$possible = '23456789bcdfghjkmnpqrstvwxyz';
$code = '';
$i = 0;
while ($i < $characters) 
{ 
  $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
  $i++;
}
return $code;
}


?>
