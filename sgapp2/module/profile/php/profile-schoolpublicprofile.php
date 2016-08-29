<?
$userType=($login_session->get_usertype())?$login_session->get_usertype():'';
check_logged_in_for_myaccount($userType);


#fetch school details
$schoolDetail=get_object_by_query('school',"school_is_active=1 and school_id='".get_school_detail()->school_id."'");

?>