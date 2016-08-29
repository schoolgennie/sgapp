<?
check_logged_in_for_myaccount('school');
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['faculty_id'])?$faculty_id=$_GET['faculty_id']:$faculty_id='0';

#school unique id
$school_id=$login_session->get_user_id();

#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);



#handle actions here.
switch ($action):
	case'list':
		#fetch class list
         $facultyList=get_all_record_by_query('faculty','school_id="'.$school_id.'" order by faculty_is_active desc');
		break;
	
	case'download':
		#download faculty list
		download_faculty();
	    Redirect(make_url('reports-faculty'));
		exit;
		break;
   					
 
	default:break;
endswitch;
?>
