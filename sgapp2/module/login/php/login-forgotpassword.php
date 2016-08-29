<?
check_logged_in_for_login();
if(isset($_POST['userId'])  && $_POST['userId']!=''):
    #set validations;
	$validation= new user_validation();
	$validation->add('userId', 'req','user Id');
	#check set validations.
	$valid= new valid();
	if($valid->validate($_POST, $validation->get())):
		if($_POST['userType']=='school'):
	      $user=get_object_by_query('school','school_id="'.$_POST['userId'].'" and school_code="'.$subDemainName.'" and school_is_active=1');
		  #set session variables
	      $sessionVariables=array($user->school_id,$user->school_email_id,$user->school_name,$user->password,'login-admin');
	   elseif($_POST['userType']=='faculty'):
	       $user=get_object_by_query('faculty as a,school as b','a.faculty_user_id="'.$_POST['userId'].'"  and b.school_id=a.school_id and b.school_code="'.$subDemainName.'" and a.faculty_is_active=1 and b.school_is_active=1');
		   #set session variables
		   $sessionVariables=array($user->faculty_id,$user->faculty_email_id,$user->faculty_first_name.' '.$user->faculty_last_name,$user->password,'login-signin');
	   elseif($_POST['userType']=='student'):
	       $user=get_object_by_query('student as a,school as b','a.student_user_id="'.$_POST['userId'].'"  and b.school_id=a.school_id and b.school_code="'.$subDemainName.'" and a.student_is_active=1 and b.school_is_active=1');
		    #set session variables
		   $sessionVariables=array($user->student_id,$user->student_email_id,$user->student_first_name.' '.$user->student_last_name,$user->password,'login-signin');
	   endif;
	   
		if($user):
			#send email.
			$email=$sessionVariables[1];
			$Userid=$_POST['userId'];
			$Password=$sessionVariables[3];
			$Name=$sessionVariables[2];
			include_once(DIR_FS_SITE_INCLUDE_EMAIL.'ForgotPassword.php');
			send_email(SUBJECT_FORGOT_PASSWORD_EMAIL, $email, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
			$login_session->pass_msg[]='Your login details have been sent to your email address.';
			$login_session->set_pass_msg();
			Redirect(make_url($sessionVariables[4]));
		else:
		    #data base session unset
			$login_session->unset_database_session();
			# not such user exists.
			$login_session->pass_msg[]="Your user id does not exist in our database";
			$login_session->set_pass_msg();
			Redirect(make_url('login-forgotpassword','userType='.$_POST['userType']));
		endif;
	 
	else:
	    #data base session unset
		$login_session->unset_database_session();
	    #some fields are not validate	
		$login_session->pass_msg=$valid->error;
		$login_session->set_pass_msg();
		$login_session->set_error();
		Redirect(make_url('login-forgotpassword','userType='.$_POST['userType']));
		
	endif;
endif;
?>
