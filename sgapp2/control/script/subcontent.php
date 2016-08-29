
<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id=0;
isset($_GET['cid'])?$cid=$_GET['cid']:$cid=0;
$imagerend=time();
#handle actions here.
switch ($action):
	case 'list':
		$QueryObj = new query('subcontent');
		$QueryObj->Where="where contentId=".$cid." order by position";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->DisplayAll();
	
		break;
	case 'view':
		if($id!=0):
			$QueryObj =new query('subcontent');
			$QueryObj->Where="where id='".$id."'";
			//$QueryObj->print=1;
			$page_cotent=$QueryObj->DisplayOne();
		endif;
		break;
	case 'update':
	
		if($id!=0):
			$QueryObj =new query('subcontent');
			$QueryObj->Where="where id='".$id."'";
			//$QueryObj->print=1;
			$page_cotent=$QueryObj->DisplayOne();
		endif;
		
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
		  
			$QueryObj->InitilizeSQL();
			$QueryObj->TableName='subcontent';
			$not=array('submit');
			$Data=MakeDataArray($_POST, $not);
			$Data['id']=$id;
			$QueryObj->Data=$Data;
			$QueryObj->Update();
			$admin_user->set_pass_msg('The content has  been updated successfully.');
			Redirect(make_admin_url('subcontent', 'list', 'list','cid='.$cid));
		endif;
		break;
	case 'insert':
			if(isset($_POST['submit']) && $_POST['submit']=='Insert'):
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='subcontent';
				$not=array('submit');
				$Data=MakeDataArray($_POST, $not);
				$Data['contentId']=$cid;
				$QueryObj->Data=$Data;
				$QueryObj->Insert();
				$admin_user->set_pass_msg('The content has  been Added successfully.');
				Redirect(make_admin_url('subcontent', 'list', 'list','cid='.$cid));
			endif;
			break;
	case 'update2':
       if(is_var_set_in_post('positionUpdate')):
		 	foreach ($_POST['position'] as $key=>$value) {
		 		$query= new query('subcontent');
		 		$query->Data['position']=$value;
		 		$query->Data['id']=$key;
		 		$query->Update();
		 	}
		 	$admin_user->set_pass_msg('Right side contents position has been updated successfully.');
		 	Redirect(make_admin_url('subcontent', 'list', 'list', 'cid='.$cid));
		 endif;
		 if(is_var_set_in_post('statusUpdate')):
		 	foreach ($_POST['is_active'] as $key=>$value) {
		 		$query= new query('subcontent');
		 		$query->Data['is_active']=$value;
		 		$query->Data['id']=$key;
		 		$query->Update();
		 	}
		 	$admin_user->set_pass_msg('Right side contents status has been updated successfully.');
		 	Redirect(make_admin_url('subcontent', 'list', 'list', 'cid='.$cid));
		 endif;
		


			break;		
	case 'delete':
			$QueryObj->InitilizeSQL();
			$QueryObj->TableName='subcontent';
			$QueryObj->id=$id;
			$QueryObj->Delete();
			$admin_user->set_pass_msg('The content has successfully been deleted.');
			Redirect(make_admin_url('subcontent', 'list', 'list','cid='.$cid));
	default:break;
endswitch;


function get_name_by_id($id)
{
	if($id!=0):
		$q= new query('content');
		$q->Where="where id='".$id."'";
		$r=$q->DisplayOne();
		return $r->name;
	else:
		return 'Root';
	endif;
}
?>
