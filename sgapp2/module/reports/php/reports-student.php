<?
check_logged_in_for_myaccount('school');

isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['student_id'])?$student_id=$_GET['student_id']:$student_id='0';
isset($_GET['p'])?$p=$_GET['p']:$p='1';

#school unique id
$school_id=$login_session->get_user_id();

#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

#count no of student account
$totalStudent=get_object_by_query_count('student','school_id="'.$school_id.'"');

#fetch class list
$classList=get_all_record_by_query('class','school_id="'.$school_id.'" and class_is_active=1 order by class_position');



#handle actions here.
switch ($action):
	case'list':
		#search parameter
		$class=(isset($_REQUEST['class']) && $_REQUEST['class']!='')?$_REQUEST['class']:'';
		$where=($class)?" and a.class_id='".$class."'":'';
		 #fetch class list
         $studentList=get_all_object_by_query('student as a ,class as b','a.class_id=b.class_id '.$where.'  order by a.student_is_active desc');
		 #fetch class list
         $studentErrorList=get_all_record_by_query('student_error_records','school_id="'.$school_id.'"');
		break;
	
   case'download':
		#download student list
		download_student();
	    Redirect(make_url('reports-student'));
		break;
  
	default:break;
endswitch;
?>
