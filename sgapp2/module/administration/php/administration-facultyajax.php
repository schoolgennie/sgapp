<?php 
check_logged_in_for_myaccount('faculty');
$faculty_id=(isset($_POST['faculty_id']) && $_POST['faculty_id']!='')?$_POST['faculty_id']:'';
$faculty_user_id=(isset($_POST['faculty_user_id']) && $_POST['faculty_user_id']!='')?$_POST['faculty_user_id']:'';
#fetch faculty details
if($faculty_id):
$facultyDetail=get_object_by_query('faculty','faculty_user_id="'.$faculty_user_id.'" and faculty_id!="'.$faculty_id.'"');
else: 
$facultyDetail=get_object_by_query('faculty','faculty_user_id="'.$faculty_user_id.'"');
endif;
if(isset($_POST['mode'])):
	switch($_POST['mode']) 
	{
	    case 'checkUserIdExist':
	          if($facultyDetail):
			     echo 'User Id alredy exit';
			  endif; 
			  exit;
	   break;
	}				
endif;		
?>				