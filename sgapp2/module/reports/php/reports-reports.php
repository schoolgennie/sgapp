<?
$userType=($login_session->get_usertype())?$login_session->get_usertype():'';
check_logged_in_for_myaccount($userType);

if($login_session->get_usertype()==$userTypeArray[0]):# school
   #school unique id
   $school_id=$login_session->get_user_id();
   
	# add validations start
	$validation=new user_validation();
	$validation->add('class_id', 'req','class name');	
	$validation->add('student_id', 'req','student name');	
	$validation->add('reportType', 'req','report Type');
	# check validations.
	$valid= new valid();
	if(!$valid->validate($_POST, $validation->get())):
					$login_session->pass_msg=$valid->error;
					$login_session->set_pass_msg();
					Redirect(make_url('reports-reports')); 
					exit;
	endif;
	# add validationsend
	
	$classId=(isset($_REQUEST['class_id']) && $_REQUEST['class_id']!='')?$_REQUEST['class_id']:'';
	$student_id=(isset($_REQUEST['student_id']) && $_REQUEST['student_id']!='')?$_REQUEST['student_id']:'';
	$subject_id=(isset($_REQUEST['subject_id']) && $_REQUEST['subject_id']!='')?$_REQUEST['subject_id']:'';
	$reportType=(isset($_REQUEST['reportType']) && $_REQUEST['reportType']!='')?$_REQUEST['reportType']:'';
	#get class list
	$classList=get_all_record_by_query('class','school_id="'.$school_id.'" and class_is_active=1');
	
   

elseif($login_session->get_usertype()==$userTypeArray[1]):# faculty

   #faculty unique id
   $faculty_id=$login_session->get_user_id();
   #fetch faculty details
   $facultyDetail=get_object_by_query('faculty','faculty_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$facultyDetail->school_id;
   
   # add validations start
	$validation=new user_validation();
	$validation->add('class_id', 'req','class name');	
	$validation->add('student_id', 'req','student name');	
	$validation->add('reportType', 'req','report Type');
	# check validations.
	$valid= new valid();
	if(!$valid->validate($_POST, $validation->get())):
					$login_session->pass_msg=$valid->error;
					$login_session->set_pass_msg();
					Redirect(make_url('reports-reports')); 
					exit;
	endif;
	# add validationsend
	$classId=(isset($_REQUEST['class_id']) && $_REQUEST['class_id']!='')?$_REQUEST['class_id']:'';
	$student_id=(isset($_REQUEST['student_id']) && $_REQUEST['student_id']!='')?$_REQUEST['student_id']:'';
	$subject_id=(isset($_REQUEST['subject_id']) && $_REQUEST['subject_id']!='')?$_REQUEST['subject_id']:'';
	$reportType=(isset($_REQUEST['reportType']) && $_REQUEST['reportType']!='')?$_REQUEST['reportType']:'';
	#get class list
	$classList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1 group by a.class_id order by c.class_position');
	
  
elseif($login_session->get_usertype()==$userTypeArray[2]):# student
   #fetch student details
   $studentDetail=get_object_by_query('student','student_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$studentDetail->school_id;
   
    # add validations start
	$validation=new user_validation();	
	$validation->add('reportType', 'req','report Type');
	# check validations.
	$valid= new valid();
	if(!$valid->validate($_POST, $validation->get())):
					$login_session->pass_msg=$valid->error;
					$login_session->set_pass_msg();
					Redirect(make_url('reports-reports')); 
					exit;
	endif;
	# add validationsend
	$classId=$studentDetail->class_id;
	$student_id=$login_session->get_user_id();
	$subject_id=(isset($_REQUEST['subject_id']) && $_REQUEST['subject_id']!='')?$_REQUEST['subject_id']:'';
	$reportType=(isset($_REQUEST['reportType']) && $_REQUEST['reportType']!='')?$_REQUEST['reportType']:'';
	#student subject list
	$studentSubjectList=get_all_record_by_query('faculty_management as a ,subject as b,class as c,faculty as d','a.class_id="'.$studentDetail->class_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and d.faculty_id=a.faculty_id and b.subject_is_active=1 and c.class_is_active=1 and d.faculty_is_active=1 and a.faculty_management_is_active=1 group by a.subject_id');
   
   
endif;

$section=isset($reportType)?$reportType:'';

#fetch school detail
$schoolDetail=get_object_by_query('school','school_id='.$school_id);


#student detail
if($student_id):
$studentDetail=get_object_by_query('student','student_id='.$student_id);
endif;


$where='';
$where.=($classId)?'a.class_id="'.$classId.'" and ':'';
$where.=($school_id)?'a.school_id="'.$school_id.'" and ':'';
$where.=($subject_id)?'a.subject_id="'.$subject_id.'" and ':'';

$queryString=($reportType)?'reportType='.$reportType:'';
$queryString.=($classId)?'&class_id='.$classId:'';
$queryString.=($student_id)?'&student_id='.$student_id:'';
$queryString.=($subject_id)?'&subject_id='.$subject_id:'';

if($reportType=='month'):

  $todate=(isset($_REQUEST['todate']) && $_REQUEST['todate']!='')?str_replace('_','-',$_REQUEST['todate']):date('d-m-Y');
  $fromDate='1-'.date('m-Y',strtotime($todate));
  $days=cal_days_in_month(CAL_GREGORIAN, date('m',strtotime($fromDate)), date('Y',strtotime($fromDate)))-1;
  //$days=((strtotime($todate)-strtotime($fromDate))/(24*60*60));

  $current=$queryString;
  $next=$queryString.'&todate='.str_replace('-','_',date('d-m-Y',strtotime('-1 days',strtotime($fromDate))));
  $previous=$queryString.'&todate='.str_replace('-','_',date('t-m-Y',(strtotime(date("t-m-Y", strtotime('+1 day',strtotime($todate))))<strtotime(date('d-m-Y')))?strtotime('+1 day',strtotime($todate)):strtotime(date('d-m-Y'))));
//$previous=$queryString.'&todate='.str_replace('-','_',date("t-m-Y", strtotime('+1 day',strtotime($todate))));

elseif($reportType=='year'):

  $todate=date('d-m-Y');
  $todateToTime=strtotime($todate);
 
  $fromDate=(date('m',strtotime($todate)) <=3)?'1-4-'.(date('Y',$todateToTime)-1):'1-4-'.date('Y',$todateToTime);
  $fromDateToTime=strtotime($fromDate);
  $months=((date('Y',$todateToTime) - date('Y',$fromDateToTime) ) * 12) + (date('m',$todateToTime) - date('m',$fromDateToTime));


endif;


#subject list
$subjectListArray=get_all_record_by_query('faculty_management as a, faculty as b, subject as c,student_subject as d',$where.' d.faculty_management_id=a.faculty_management_id and  d.student_id="'.$student_id.'" and  b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and b.faculty_is_active=1 and c.subject_is_active=1 group by a.subject_id order by a.faculty_management_is_active desc');



?>