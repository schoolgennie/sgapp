<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id=0;


if($id!=0):
$QueryObj =new query('video');
$QueryObj->Where="where id='".$id."'";			
$getObject=$QueryObj->DisplayOne();
endif;

#handle actions here.
switch ($action):
	case 'list':
		$QueryObj = new query('video');
                $QueryObj->Where=" order by position";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->DisplayAll();
		
		break;
	case 'view':
		if($id!=0):
			
		endif;
		break;
	case 'update':	
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
			$QueryObj->InitilizeSQL();
			$QueryObj->TableName='video';
			$not=array('submit','status');
			$Data=MakeDataArray($_POST, $not);
                        $Data['status']=isset($_POST['status'])?$_POST['status']:0;
			$QueryObj->Data=$Data;
			$QueryObj->Update();
			$admin_user->set_pass_msg('This video details have been updated successfully.');
			Redirect(make_admin_url('video', 'list', 'list'));
		endif;
		break;
	case 'insert':
			if(isset($_POST['submit']) && $_POST['submit']=='Insert'):
				$QueryObj->InitilizeSQL();
				$QueryObj->TableName='video';
				$not=array('submit');
				$Data=MakeDataArray($_POST, $not);
				$QueryObj->Data=$Data;
				$QueryObj->Insert();
				$admin_user->set_pass_msg('New video has been Added successfully.');
				Redirect(make_admin_url('video', 'list', 'list'));
			endif;
			break;
        case 'list_ops':
	
		#update position.
		if(is_var_set_in_post('position_update')):
			foreach ($_POST['position'] as $k=>$v):
				$q= new query('video');
				$q->Data['id']=$k;
				$q->Data['position']=$v;
				$q->Update();	
			endforeach;
			$admin_user->set_pass_msg('video(s) position has been updated successfully.');
			Redirect(make_admin_url('video', 'list', 'list'));
		endif;
		#status update.
		if(is_var_set_in_post('status_update')):
		
			foreach ($_POST['status'] as $k=>$v):
				$q= new query('video');
				$q->Data['id']=$k;
				$q->Data['status']=$v;
				$q->Update();	
			endforeach;
			$admin_user->set_pass_msg('video(s) status has been updated successfully.');
			Redirect(make_admin_url('video', 'list', 'list'));
		endif;
	break;
	case 'delete':
			$QueryObj->InitilizeSQL();
			$QueryObj->TableName='video';
			$QueryObj->id=$id;
			$QueryObj->Delete();
			$admin_user->set_pass_msg('video has been deleted successfully.');
			Redirect(make_admin_url('video', 'list', 'list'));
	default:break;
endswitch;



?>
