<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';


#handle actions here.
switch ($action):
	case'list':
		
		$QueryObj = new query('home_banner');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=20;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['new_banner']) && $_POST['new_banner']=='Submit'):
		#check dimensions
		if($_FILES['image']['name']!=''):
		  $dimensions = getimagesize($_FILES['image']['tmp_name']); 
		  if($dimensions[0]!='991' || $dimensions[1]!='295'):
		    $admin_user->set_pass_msg('uploaded image dimensions must be 991x295 pixels.');
			Redirect(make_admin_url('home_banner', 'insert', 'insert'));
		  endif;
		endif;
		#check dimensions
			$not=array('new_banner','description');
			$QueryObj =new query('home_banner');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$imagerend=time();
			if(upload_photo('home_banner', $_FILES['image'],$imagerend)):
				$QueryObj->Data['image']=$imagerend.$_FILES['image']['name'];
			endif;
			$QueryObj->Data['description']=html_entity_decode($_POST['description']);
			$QueryObj->Insert();
			$admin_user->set_pass_msg('banner has been inserted successfully.');
			Redirect(make_admin_url('home_banner', 'list', 'list', 'id='.$id));
		endif;	
		break;
	case'update':
	
		
		if(isset($_GET['id'])):
			$QueryObj =new query('home_banner');
			$QueryObj->Where="where id='$id'";
			$product=$QueryObj->DisplayOne();
		endif;
		
		if(isset($_POST['update_banner']) && $_POST['update_banner']=='Update'):
		
		  if($_FILES['image']['name']!=''):
		     $dimensions = getimagesize($_FILES['image']['tmp_name']); 
		     if($dimensions[0]!='991' || $dimensions[1]!='295'):
		        $admin_user->set_pass_msg('uploaded image dimensions must be 991x295 pixels.');
			     Redirect(make_admin_url('home_banner', 'update', 'update','id='.$id));
			endif;
		  endif;
			$not=array('update_banner','is_active','description');
			$QueryObj =new query('home_banner');
			$data=MakeDataArray($_POST, $not);
			
			
			if(!empty($_FILES['image']['name'])):
			  delete_if_image_exists('home_banner', 'large', $product->image);
			  delete_if_image_exists('home_banner', 'medium', $product->image);
			  delete_if_image_exists('home_banner', 'thumb', $product->image);
			endif;
			
			$imagerend=time();
			if(upload_photo('home_banner', $_FILES['image'],$imagerend)):
				$data['image']=$imagerend.$_FILES['image']['name'];
			endif;
			$data['is_active']=($_POST['is_active'])?"1":"0";
			$data['description']=html_entity_decode($_POST['description']);
			$QueryObj->Data=$data;
			$QueryObj->Update();
			$admin_user->set_pass_msg('banner has been updated successfully.');
			Redirect(make_admin_url('home_banner', 'list', 'list', 'id='.$id));
		endif;
		break;
	case 'list_ops':
		
		#update position.
		if(is_var_set_in_post('position_update')):
			foreach ($_POST['position'] as $k=>$v):
				$q= new query('product');
				$q->Data['id']=$k;
				$q->Data['position']=$v;
				$q->Update();	
			endforeach;;
			$admin_user->set_pass_msg('Product(s) position has been updated successfully.');
			Redirect(make_admin_url('product', 'list', 'list', 'id='.$id));
		endif;
		#status update.
		if(is_var_set_in_post('status_update')):
			foreach ($_POST['status'] as $k=>$v):
				$q= new query('home_banner');
				$q->Data['id']=$k;
				$q->Data['is_active']=$v;
				$q->Update();	
			endforeach;;
			$admin_user->set_pass_msg('banner status has been updated successfully.');
			Redirect(make_admin_url('home_banner', 'list', 'list', 'id='.$id));
		endif;
		break;
	
	case'delete':
		# delete all images:
		$obj= get_object_by_col('home_banner', 'id', $id);
			delete_if_image_exists('home_banner', 'large', $obj->image);
			delete_if_image_exists('home_banner', 'medium', $obj->image);
			delete_if_image_exists('home_banner', 'thumb', $obj->image);
		#delete actual product.
		$query= new query('home_banner');
		$query->id=$id;
		$query->Delete();
				
		$admin_user->set_pass_msg('banner  has been deleted.');
		Redirect(make_admin_url('home_banner', 'list', 'list', 'id='.$id));
		break;
 
	default:break;
endswitch;
?>
