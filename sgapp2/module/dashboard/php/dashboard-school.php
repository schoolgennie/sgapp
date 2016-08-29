<?
check_logged_in_for_myaccount('school');
$school_id=$login_session->get_user_id();
$userType=$login_session->get_usertype();
#logged in user id
$userId=$login_session->get_user_id();
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

#message subject list
$dashboardMessageSubjectList=get_all_record_by_query('message_subject','school_id="'.$school_id.'" and ((message_subject_sender_type="'.$userType.'" and message_subject_sender_id="'.$userId.'" and message_subject_sender_status=1) or (message_subject_receiver_type="'.$userType.'" and message_subject_receiver_id="'.$userId.'" and message_subject_receiver_status=1)) order by message_subject_id desc limit 4');

#fetch notice list
$dashboardNoticeList=get_all_record_by_query('noticeboard','school_id="'.$school_id.'"  order by noticeboard_id desc limit 4');

#fetch faculty list
$dashboardFacultyList=get_all_record_by_query('faculty','(faculty_is_active=1 or faculty_is_active=2 )');


$bdayList=get_all_record_by_query('student','school_id="'.$school_id.'" and student_is_active=1  union select faculty_id as id,faculty_first_name as firstName,faculty_last_name as lastName,faculty_dob as dob,"faculty" as userType from faculty where school_id="'.$school_id.'" and faculty_is_active=1  order by dob desc limit 10','student_id as id,student_first_name as firstName,student_last_name as lastName,student_dob as dob,"student" as userType');

?>
