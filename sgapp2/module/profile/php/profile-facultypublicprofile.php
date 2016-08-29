<?
$userType=($login_session->get_usertype())?$login_session->get_usertype():'';
check_logged_in_for_myaccount($userType);

$faculty_id=$_GET['id'];
#fetch faculty details
$facultyDetails=get_object_by_query('faculty',"faculty_id='".$faculty_id."' and faculty_is_active=1 and school_id='".get_school_detail()->school_id."'");

?>