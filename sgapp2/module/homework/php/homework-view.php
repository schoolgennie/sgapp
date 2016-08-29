<?
check_logged_in_for_myaccount('student');


$ondate=isset($_REQUEST['ondate'])?date('Y-m-d',strtotime(str_replace('_','-',$_REQUEST['ondate']))):date('Y-m-d');
$previous=date('Y_m_d',strtotime('-1 day',strtotime($ondate)));
$next=date('Y_m_d',strtotime('+1 day',strtotime($ondate)));
#student unique id
$student_id=$login_session->get_user_id();

#fetch school details
$studentDetail=get_object_by_query('student','student_id='.$student_id);

#school id
$school_id=$studentDetail->school_id;

#fetch assigned classes list
//$studentSubjectList=get_all_record_by_query('faculty_management as a ,subject as b,class as c,faculty as d','a.class_id="'.$studentDetail->class_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and d.faculty_id=a.faculty_id and b.subject_is_active=1 and c.class_is_active=1 and d.faculty_is_active=1 and a.faculty_management_is_active=1');
//$studentSubjectList=get_all_record_by_query('faculty_management as a, faculty as b, subject as c,student_subject as d,class as e','a.class_id="'.$studentDetail->class_id.'" and e.class_id=a.class_id and  d.faculty_management_id=a.faculty_management_id and  d.student_id="'.$student_id.'" and  b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and b.faculty_is_active=1 and c.subject_is_active=1 and e.class_is_active=1 order by a.faculty_management_is_active desc');
$studentSubjectList=get_all_record_by_query('faculty_management as a, faculty as b, subject as c,student_subject as d','a.class_id="'.$studentDetail->class_id.'" and  d.faculty_management_id=a.faculty_management_id and  d.student_id="'.$student_id.'" and  b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and b.faculty_is_active!=0 and c.subject_is_active=1 and a.faculty_management_is_active=1');
# download file
if(isset($_GET['download']) && $_GET['download']!=''):
  download_file('upload/photo/home_work/'.$_GET['download']);
endif;
		
?>
