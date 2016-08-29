<?
check_logged_in_for_myaccount('student');
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';



#unique student id
$student_id=$login_session->get_user_id();
#fetch student details
$studentDetails=get_object_by_query('student','student_id='.$student_id);
#school unique id
$school_id=$studentDetails->school_id;
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);
#fetch class list
$classList=get_all_record_by_query('class','school_id="'.$studentDetails->school_id.'" and class_is_active=1 order by class_position');
#faculty list
$facultyList=get_all_record_by_query('faculty_management as a ,subject as b,faculty as c','a.class_id="'.$studentDetails->class_id.'" and a.school_id="'.$school_id.'" and b.subject_id=a.subject_id and c.faculty_id=a.faculty_id and b.subject_is_active=1 and c.faculty_is_active=1 group by a.faculty_id');



?>