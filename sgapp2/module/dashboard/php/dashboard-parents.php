<?
check_logged_in_for_myaccount('student');
#logged in user id
$userId=$login_session->get_user_id();
#logged in user type
$userType=$login_session->get_usertype();
$studentDetail=get_object_by_query('student','student_id='.$userId);


#message subject list
$dashboardMessageSubjectList=get_all_record_by_query('message_subject','((message_subject_sender_type="'.$userType.'" and message_subject_sender_id="'.$userId.'" and message_subject_sender_status=1) or (message_subject_receiver_type="'.$userType.'" and message_subject_receiver_id="'.$userId.'" and message_subject_receiver_status=1)) order by message_subject_id desc limit 4');

#fetch notice list
$dashboardNoticeList=get_all_record_by_query('noticeboard order by noticeboard_id desc limit 4');

#faculty list
$dashboardFacultyList=get_all_record_by_query('faculty_management as a ,subject as b,faculty as c','a.class_id="'.$studentDetail->class_id.'"  and b.subject_id=a.subject_id and c.faculty_id=a.faculty_id and b.subject_is_active=1 and c.faculty_is_active=1');
?>
