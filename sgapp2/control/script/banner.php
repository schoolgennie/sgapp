<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';


#handle actions here.
switch ($action):
	case'list':
		
		$QueryObj = new query('banner');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=20;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
	
		
		break;
	case'update':
	
		
		if(isset($_GET['id'])):
			$QueryObj =new query('banner');
			$QueryObj->Where="where id='$id'";
			$product=$QueryObj->DisplayOne();
		endif;
		if(isset($_POST['update_banner']) && $_POST['update_banner']=='Update'):
		  if($_FILES['image']['name']!=''):
		    $dimensions = getimagesize($_FILES['image']['tmp_name']); 
		    if($dimensions[0]!='277' || $dimensions[1]!='146'):
		        $admin_user->set_pass_msg('uploaded image dimensions must be 277x146 pixels.');
			    Redirect(make_admin_url('banner', 'update', 'update','id='.$id));
			endif;
		  endif;
			$not=array('update_banner','description');
			$QueryObj =new query('banner');
			$data=MakeDataArray($_POST, $not);
			
			if(!empty($_FILES['image']['name'])):
				delete_if_image_exists('banner', 'large', $product->image);
			    delete_if_image_exists('banner', 'medium', $product->image);
			    delete_if_image_exists('banner', 'thumb', $product->image);
			endif;
			
			$imagerend=time();
			if(upload_photo('banner', $_FILES['image'],$imagerend)):
				$data['image']=$imagerend.$_FILES['image']['name'];
			endif;
			$data['description']=html_entity_decode($_POST['description']);
			$QueryObj->Data=$data;
			$QueryObj->Update();
			$admin_user->set_pass_msg('banner has been updated successfully.');
			Redirect(make_admin_url('banner', 'list', 'list', 'id='.$id));
		endif;
		break;
	
	
	case'delete':
		
		break;
 
	default:break;
endswitch;
?>
