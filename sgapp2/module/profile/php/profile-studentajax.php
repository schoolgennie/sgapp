<?php 
check_logged_in_for_myaccount('student');
$student_id=$login_session->get_user_id();
#fetch student details
$studentDetail=get_object_by_query('student','student_id='.$student_id);
if(isset($_POST['mode'])):
	switch($_POST['mode'])
	 {
	    case 'checkOldPassword':
	          if($_POST['password']==$studentDetail->password):
			     echo 1;
			endif; 
			exit;
	   break;   
	}				
endif;		
?>	