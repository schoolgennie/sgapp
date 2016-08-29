<?
check_logged_in_for_myaccount('student');

#unique student id
$student_id=$login_session->get_user_id();
#fetch student details
$studentDetails=get_object_by_query('student','student_id='.$student_id);

#faculty list
//$facultyList=get_all_record_by_query('faculty_management as a ,subject as b,faculty as c','a.class_id="'.$studentDetails->class_id.'"  and b.subject_id=a.subject_id and c.faculty_id=a.faculty_id and b.subject_is_active=1 and c.faculty_is_active=1 group by a.faculty_id');

$facultyList=get_all_record_by_query('faculty_management as a, faculty as b, subject as c,student_subject as d','a.class_id="'.$studentDetails->class_id.'" and  d.faculty_management_id=a.faculty_management_id and  d.student_id="'.$student_id.'" and  b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and a.faculty_management_is_active=1 and b.faculty_is_active!=0 and c.subject_is_active=1 group by a.faculty_id');


?>