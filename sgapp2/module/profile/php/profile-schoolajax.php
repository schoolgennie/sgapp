<?php 
check_logged_in_for_myaccount('school');
$school_id=$login_session->get_user_id();
#fetch faculty details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);
if(isset($_POST['mode'])):
	switch($_POST['mode']) 
	{
	    case 'checkOldPassword':
	          if($_POST['password']==$schoolDetail->password):
			     echo 1;
			  endif; 
			  exit;
	   break;
	}				
endif;		
?>				