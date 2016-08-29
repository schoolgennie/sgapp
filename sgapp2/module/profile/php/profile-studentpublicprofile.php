<?
$userType=($login_session->get_usertype())?$login_session->get_usertype():'';
check_logged_in_for_myaccount($userType);

$student_id=$_GET['id'];
#fetch faculty details
$studentDetails=get_object_by_query('student',"student_id='".$student_id."' and student_is_active=1 and school_id='".get_school_detail()->school_id."'");

?>