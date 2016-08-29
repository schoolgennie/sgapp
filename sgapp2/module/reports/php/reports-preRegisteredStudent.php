<?
check_logged_in_for_myaccount('school');

isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#school unique id
$school_id=$login_session->get_user_id();
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);
#handle actions here.
switch ($action):
	case'list':
		 #fetch class list
         $studentList=get_all_record_by_query('student_pre_registration');
		
		break;
	 case'download':
		#download student list
		download_student();
	    Redirect(make_url('reports-preRegisteredStudent'));
		break;
	default:break;
endswitch;
?>
