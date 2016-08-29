<?
check_logged_in_for_myaccount('student');

#student unique id
$student_id=$login_session->get_user_id();

#student details
$studentDetail=get_object_by_query('student','student_id='.$student_id);
#school_id
$school_id=$studentDetail->school_id;


//$createdTestList=get_all_record_by_query('student_test as a,student_subject as b,subject as c, faculty as d','a.class_id="'.$studentDetail->class_id.'" and  c.subject_id=a.subject_id and c.subject_id=b.subject_id and b.student_id="'.$student_id.'"  and d.faculty_id=a.faculty_id and a.student_test_is_active=1 and b.class_is_active=1 and c.subject_is_active=1  order by a.student_test_date desc,a.student_test_id desc');
//$facultyList=get_all_record_by_query('faculty_management as a, faculty as b, subject as c,student_subject as d','a.class_id="'.$studentDetails->class_id.'" and  d.faculty_management_id=a.faculty_management_id and  d.student_id="'.$student_id.'" and  b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and a.faculty_management_is_active=1 and b.faculty_is_active!=0 and c.subject_is_active=1 group by a.faculty_id');


$createdTestList=get_all_record_by_query('student_test as a,faculty_management as b,student_subject as c,subject as d, faculty as e','a.class_id="'.$studentDetail->class_id.'" and c.faculty_management_id=b.faculty_management_id and c.student_id="'.$student_id.'" and   b.subject_id=d.subject_id and a.subject_id=d.subject_id  and e.faculty_id=a.faculty_id and a.student_test_is_active=1 and  d.subject_is_active=1 and b.faculty_management_is_active=1  order by a.student_test_date desc,a.student_test_id desc');


?>
