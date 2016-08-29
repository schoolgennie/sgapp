<?
function get_order_item_total($item_id)
{
	$item= get_object('order_detail', $item_id);
	$order=get_object('orders', $item->order_id);
	if($order->config_add_att_price_to_pro):
		return ($item->quantity*$item->price)+ get_item_attribute_total($item_id);
	endif;

	if($order->config_att_price_overlap):
		return get_item_attribute_total($item_id);
	endif;

	return $item->quantity*$item->price;

}

function get_item_attribute_total($item_id)
{
	$item= get_object('order_detail', $item_id);
	$query= new query('order_detail_attribute');
	$query->Where="where order_detail_id='$item_id'";
	$query->DisplayAll();
	$total=0;
	while($obj= $query->GetArrayFromRecord()):
		if($obj['is_attribute_paid']):
			$total+=$obj['price']*$item->quantity;
		endif;
	endwhile;
	return $total;
}

function display_attributes_for_cart($item_id)
{//print_r($item_id);exit;
	$query= new query('order_detail_attribute');
	$query->Where="where order_detail_id='$item_id'";
	$query->DisplayAll();
	$items='';
	if($query->GetNumRows()):
		
		while($obj=$query->GetArrayFromRecord()):
			if($obj['is_attribute_paid']):
				$items.='<b>'.$obj['attribute_name'].'</b>:-'.$obj['attribute_value_name'].'('.number_format($obj['price'], 2).')'.'<br/>';
			else:
				$items.='<b>'.$obj['attribute_name'].'</b>:-'.$obj['attribute_value_name'].'<br/>';
			endif;
		endwhile;
	endif;
	return $items;
}

function order_status_drop_down($name, $selected)
{
	global $conf_order_status;
	echo '<select name="'.$name.'" size="1">';
	foreach ($conf_order_status as $value):
	if(strtolower($value)==strtolower($selected)):
		echo '<option selected="selected" value="'.strtolower($value).'">'.ucfirst($value).'</option>';
	else:
		echo '<option value="'.strtolower($value).'">'.ucfirst($value).'</option>';
	endif;
	endforeach;
	echo '</select>';
}

function if_sub_cat_or_product_exist($cat_id)
{
	#check for sub categories.
	$query= new query('category');
	$query->Where="where parent_id='$cat_id'";
	$query->DisplayAll();
	if($query->GetNumRows()):
		return true;
	endif;

	#check for products.
	$query= new query('product');
	$query->Where="where parent_id='$cat_id'";
	$query->DisplayAll();
	return ($query->GetNumRows())?true:false;
}

function echo_y_or_n($status)
{
	echo ($status)?'Yes':'No';
}

function target_dropdown($name, $selected='', $tabindex=1)
{
	$values=array('new window'=>'_blank', 'same window'=>'_parent');
	echo '<select name="'.$name.'" size="1" tabindex="'.$tabindex.'">';
	foreach ($values as $k=>$v):
		if($v==$selected):
			echo '<option value="'.$v.'" selected>'.ucfirst($k).'</option>';
		else:
			echo '<option value="'.$v.'">'.ucfirst($k).'</option>';
		endif;
	endforeach;
	echo '</select>';
}

function download_users()
{
	$users= new query('user');
	$users->DisplayAll();
	$users_arr= array();
	while($user= $users->GetArrayFromRecord()):
		$user['total orders']=get_total_orders_by_user($user['id']);
		array_push($users_arr, $user);
	endwhile;
	$file=make_csv_from_array($users_arr);
	$filename="users".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
}

function get_total_orders_by_user($id)
{
	$q= new query('orders');
	$q->Field="count(*) as total";
	$q->Where="where user_id='".$id."'";
	$o=$q->DisplayOne();
	return $o->total;
}



function get_all_sub_cats($tablename, $id)
{
	$sub_cat='';
	$q= new query($tablename);
	$q->Where="where parent_id='".$id."'";
	$q->DisplayAll();
	if($q->GetNumRows()):
		while ($item= $q->GetObjectFromRecord()) {
			$sub_cat.="'".$item->id."'".', ';
		}
		return substr($sub_cat, 0, strlen($sub_cat)-2);
	else:
		return false;
	endif;
}

function get_zones_box($selected=0)
{
	$q= new query('zone');
	$q->DisplayAll();
	echo '<select name="zone" size="1">';
	while($obj=$q->GetObjectFromRecord()):
		if($selected=$obj->id):
			echo '<option value="'.$obj->id.'" selected>'.$obj->name.'</option>';
		else:
			echo '<option value="'.$obj->id.'">'.$obj->name.'</option>';
		endif;
	endwhile;
	echo '</select>';
}

function get_y_n_drop_down($name, $selected)
{
	echo '<select name="'.$name.'" size="1">';
	if($selected):
		echo '<option value="1" selected>Yes</option>';
		echo '<option value="0">No</option>';
	else:
		echo '<option value="0" selected>No</option>';
		echo '<option value="1">Yes</option>';
	endif;
	echo '</select>';
}

function get_setting_control($key, $type, $value)
{
	switch ($type)
	{
	case 'text':
			echo '<input type="text" name="key['.$key.']" value="'.$value.'" size="30">';
			break;
	case 'select':
			echo get_y_n_drop_down('key['.$key.']', $value);
			break;
	default: echo get_y_n_drop_down('key['.$key.']', $value);
	}
}

function css_active($page, $value, $class)
{
	if($page==$value)
		echo 'class='.$class;
}

function get_category_list_control($id)
{
	if(!get_total_sub_categories($id) && !get_total_products($id)):
	?>
	<a href="<?php echo make_admin_url('category', 'list', 'list', 'id='.$id);?>"><?php echo get_control_icon('folder_explore')?>Category</a>&nbsp;(<?php echo get_total_sub_categories($id);?>)<br/>
	<a href="<?php echo make_admin_url('product', 'list', 'list', 'id='.$id);?>"><img src="<?php echo DIR_WS_SITE_CONTROL_IMAGE?>file.gif" border="0" align="absmiddle"/>Person Info</a>&nbsp;(<?php echo get_total_products($id)?>)
	<?php
	elseif(get_total_sub_categories($id) && !get_total_products($id)):?>
	<a href="<?php echo make_admin_url('category', 'list', 'list', 'id='.$id);?>"><?php echo get_control_icon('folder_explore')?>Category</a>&nbsp;(<?php echo get_total_sub_categories($id);?>)<br/>
	<?php
	elseif(!get_total_sub_categories($id) && get_total_products($id)):?>
	<a href="<?php echo make_admin_url('product', 'list', 'list', 'id='.$id);?>"><img src="<?php echo DIR_WS_SITE_CONTROL_IMAGE?>file.gif" border="0" align="absmiddle"/>Person Info</a>&nbsp;(<?php echo get_total_products($id)?>)
	<?php
	endif;

}

function get_category_status_link($id, $status)
{
	echo '<select name="is_active['.$id.']" size="1">';
	if($status):
		echo '<option value="1" selected>Active</option>';
		echo '<option value="0">Not-Active</option>';
	else:
		echo '<option value="1" selected>Active</option>';
		echo '<option value="0" selected>Not-Active</option>';
	endif;
	echo '</select>';
}

function get_category_position_control($catid, $id, $position=1, $page=1)
{
	echo '<a href="'.make_admin_url('category', 'update2', 'list', 'page='.$page.'&id='.$id.'&up='.$position.'&cat_id='.$catid).'"><img src="'.DIR_WS_SITE_CONTROL_IMAGE.'up.gif"></a>';
	echo '&nbsp;';
	echo '<a href="'.make_admin_url('category', 'update2', 'list', 'page='.$page.'&id='.$id.'&down='.$position.'&cat_id='.$catid).'"><img src="'.DIR_WS_SITE_CONTROL_IMAGE.'down.gif"></a>';
}


function parse_into_array($string)
{
	return explode(',', $string);
}
function admin_own_database_access_control($page)
{
  $accessPage=array('udetail');
  if(!in_array($page,$accessPage) &&  $_SESSION['admin_session_secure']['database_name']):
           
            unset($_SESSION['admin_session_secure']['database_name']);
			Redirect('#'); 
  endif;
}
?>