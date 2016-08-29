<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['page'])?$page=$_GET['page']:$page='1';
isset($_GET['id'])?$id=$_GET['id']:$id=0;
if($id):
$page_cotent =get_object_by_query('content','id='.$id);
endif;
#handle actions here.
switch ($action):
	case 'list':
		   $QueryObj=get_all_object_by_query('content','',true,$page,20);
		break;
	case 'view':
		
		break;
	case 'update':
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
			 $not=array('submit');
			 $data=$_POST;
			 $where="id='".$id."'";																																																																																			
			 update_record_in_table('content',$where,$data,$not);
			 $admin_user->set_pass_msg('The page has successfully been updated.');
			 Redirect(make_admin_url('content', 'list', 'list'));
		endif;
		break;
	case 'insert':
			if(isset($_POST['submit']) && $_POST['submit']=='Insert'):
				$not=array('submit');
				$data=$_POST;
				insert_record_in_table('content',$data,$not);
				$admin_user->set_pass_msg('The page has successfully been Added.');
				Redirect(make_admin_url('content', 'list', 'list'));
			endif;
			break;
	case 'delete':
			$QueryObj->InitilizeSQL();
			$QueryObj->TableName='content';
			$QueryObj->id=$id;
			$QueryObj->Delete();
			$admin_user->set_pass_msg('The page has successfully been deleted.');
			Redirect(make_admin_url('content', 'list', 'list'));
	default:break;
endswitch;

?>
