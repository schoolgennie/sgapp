<?

function MakeDataArray($post, $not)
	{
		$data=array();
		foreach ($post as $key=>$value):
			if(!in_array($key, $not)):
				$data[$key]=$value;
			endif;
		endforeach;
		return $data;
	}

function is_var_set_in_post($var, $check_value=false)
{
//print_r($var);exit;
	if(isset($_POST[$var])):
	//print_r($_POST[$var]);exit;
		if($check_value):
			if($_POST[$var]===$check_value):
				return true;
			else:
				return false;
			endif;
		endif;
		return true;
	else:
		return false;
	endif;
}

function category_drop_down($data, $name, $size=1, $type="mulitple", $selected=array())
{
	echo '<select name="'.$name.'" size="'.$size.'" style="width:600px;" '.$type.'>';
	foreach ($data as $value):
		if(in_array($value['id'], $selected)):
			echo '<option value="'.$value['id'].'" selected="selected">'.ucfirst($value['name']).'</option>';
		else:
			echo '<option value="'.$value['id'].'">'.ucfirst($value['name']).'</option>';
		endif;
	endforeach;
	echo'</select>';
}

function product_drop_down($data, $name, $selected=array())
{
//print_r($data);exit;
	echo '<select name="'.$name.'" size="10" style="width:600px;" multiple>';
	foreach ($data as $value):
		if(in_array($value['id'],$selected)):
			echo '<option value="'.$value['id'].'" selected="selected">'.ucfirst($value['name']).'</option>';
		else:
			echo '<option value="'.$value['id'].'">'.ucfirst($value['name']).'</option>';
		endif;
	endforeach;
	echo'</select>';
}

function get_country_drop_down($name, $selected=array())
{
	$query= new query('country');
	$query->Where="where is_active='1'";
	$query->DisplayAll();
	echo '<select name="'.$name.'" size="1" style="width:178px;" >';
	
	echo '<option value="'.'222'.'" selected="selected">'.'United Kingdom'.'</option>';
	
	while ($value=$query->GetArrayFromRecord()):
		if(in_array($value['id'],$selected)):
			echo '<option value="'.$value['id'].'" selected="selected">'.ucfirst($value['name']).'</option>';
		else:
			echo '<option value="'.$value['id'].'">'.ucfirst($value['name']).'</option>';
		endif;
	endwhile;
	echo'</select>';
}

?>