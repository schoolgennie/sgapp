<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id=0;
$imagerend=time();
if($id!=0):
$QueryObj =new query('contact_us');
$QueryObj->Where="where id='".$id."'";
$getDetails=$QueryObj->DisplayOne();
endif;
#handle actions here.
switch ($action):
	case 'list':
		$QueryObj = new query('contact_us');
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
		
		break;
	
	case'delete':
	 
		#delete .
		$query= new query('contact_us');
		$query->id=$id;
		$query->Delete();
		
		$admin_user->set_pass_msg('contact us details has been deleted.');
		Redirect(make_admin_url('contactus', 'list', 'list'));
	break;
	default:break;
endswitch;


?>
