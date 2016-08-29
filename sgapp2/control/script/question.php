<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['fid'])?$fid=$_GET['fid']:$fid='0';
isset($_GET['page'])?$page=$_GET['page']:$page='1';
if($id!=0):
$QueryObjQuestion =new query('question');
$QueryObjQuestion->Where="where id='$id'";
$questionDetails=$QueryObjQuestion->DisplayOne();
endif;

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('question');
		$QueryObj->Where="where factorId=$fid order by questionPosition"; 
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=20;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
	break;
	case'insert':
		
		if(isset($_POST['insert']) && $_POST['insert']=='Submit'):
			$not=array('insert');
			$QueryObj =new query('question');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			$admin_user->set_pass_msg('New question has been created successfully.');
			Redirect(make_admin_url('question', 'list', 'list','fid='.$fid));
		endif;	
	break;
	case'update':
		if(isset($_POST['update']) && $_POST['update']=='Update'):
			$not=array('update','questionStatus');
			$QueryObj =new query('question');
			$data=MakeDataArray($_POST, $not);
			$data['questionStatus']=isset($_POST['questionStatus'])?$_POST['questionStatus']:"0";
			$QueryObj->Data=$data;
			$QueryObj->Update();
			
			$admin_user->set_pass_msg('Question has been updated successfully.');
			Redirect(make_admin_url('question', 'list', 'list', 'page='.$page.'&fid='.$fid));
		endif;
	break;
	case 'list_ops':
	
		#update position.
		if(is_var_set_in_post('position_update')):
			foreach ($_POST['position'] as $k=>$v):
				$q= new query('question');
				$q->Data['id']=$k;
				$q->Data['questionPosition']=$v;
				$q->Update();	
			endforeach;
			$admin_user->set_pass_msg('Question(s) position has been updated successfully.');
			Redirect(make_admin_url('question', 'list', 'list', 'page='.$page.'&fid='.$fid));
		endif;
		#status update.
		if(is_var_set_in_post('status_update')):
		
			foreach ($_POST['status'] as $k=>$v):
				$q= new query('question');
				$q->Data['id']=$k;
				$q->Data['questionStatus']=$v;
				$q->Update();	
			endforeach;
			$admin_user->set_pass_msg('Question(s) status has been updated successfully.');
			Redirect(make_admin_url('question', 'list', 'list', 'page='.$page.'&fid='.$fid));
		endif;
	break;
	case'delete':
	 
		#delete question.
		$query= new query('question');
		$query->id=$id;
		$query->Delete();
		
		$admin_user->set_pass_msg('Question has been deleted.');
		Redirect(make_admin_url('question', 'list', 'list','page='.$page.'&fid='.$fid));
	break;
	default:break;
endswitch;
?>
