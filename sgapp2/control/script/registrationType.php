<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id=0;
$imagerend=time();
if($id!=0):
$QueryObj =new query('registrationType');
$QueryObj->Where="where id='".$id."'";
$getDetails=$QueryObj->DisplayOne();
endif;
#handle actions here.
switch ($action):
	case 'list':
		$QueryObj = new query('registrationType');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->DisplayAll();
		$AllRecords = new query('content');
		$AllRecords->DisplayAll();
		break;
	case 'view':
		if($id!=0):
			
		endif;
		break;
	case 'update':
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
			$QueryObj->InitilizeSQL();
			$QueryObj->TableName='registrationType';
			$not=array('submit');
			$Data=MakeDataArray($_POST, $not);
			$Data['id']=$id;
			$QueryObj->Data=$Data;
			$QueryObj->Update();
			$admin_user->set_pass_msg('The registration details been updated successfully.');
			Redirect(make_admin_url('registrationType', 'list', 'list'));
		endif;
		break;
	
	
	default:break;
endswitch;


?>
