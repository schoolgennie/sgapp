<?php 
check_logged_in_for_myaccount('faculty');
$faculty_id=$login_session->get_user_id();
#fetch faculty details
$facultyDetail=get_object_by_query('faculty','faculty_id='.$faculty_id);
if(isset($_POST['mode'])):
	switch($_POST['mode']) 
	{
	    case 'checkOldPassword':
	          if($_POST['password']==$facultyDetail->password):
			     echo 1;
			endif; 
			exit;
	   break;
	}				
endif;		
?>				