<?
check_logged_in_for_myaccount('faculty');
#logged in user id
$userId=$login_session->get_user_id();
$userType=$login_session->get_usertype();
$facultytDetail=get_object_by_query('faculty','faculty_id='.$userId);
$school_id=$facultytDetail->school_id;

#message subject list
$dashboardMessageSubjectList=get_all_record_by_query('message_subject','((message_subject_sender_type="'.$userType.'" and message_subject_sender_id="'.$userId.'" and message_subject_sender_status=1) or (message_subject_receiver_type="'.$userType.'" and message_subject_receiver_id="'.$userId.'" and message_subject_receiver_status=1)) order by message_subject_id desc limit 4');
#fetch notice list
$dashboardNoticeList=get_all_record_by_query('noticeboard','school_id="'.$school_id.'"  order by noticeboard_id desc limit 4');
#fetch incharge class
$dashboardInchargeClass=get_object_by_query('class','class_incharge="'.$faculty_id.'"  and class_is_active=1');



?>
