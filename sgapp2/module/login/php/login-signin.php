<?php
check_logged_in_for_login();
if(isset($_POST['userId']) && $_POST['userId']!='')
{
	#set validations;
	$validation= new user_validation();
	$validation->add('userId', 'req','user id');
	$validation->add('password','req','password');
	$validation->add('userType','req','user type');
	#check set validations.
	$valid= new valid();
	if($valid->validate($_POST, $validation->get())) # if true then all is ok..proceed.
	{ 
	  if($_POST['userType']=='faculty'):
	       $user=get_object_by_query('faculty as a,school as b','a.faculty_user_id="'.$_POST['userId'].'" and a.password="'.$_POST['password'].'" and b.school_id=a.school_id and b.school_code="'.$subDemainName.'" and a.faculty_is_active=1 and b.school_is_active=1');
		   #set session variables for faculty
		   $sessionVariables=array($user->faculty_id,$user->school_code,$user->faculty_first_name.' '.$user->faculty_last_name,$user->faculty_email_id,'dashboard-faculty');
	   elseif($_POST['userType']=='student'):
	       $user=get_object_by_query('student as a,school as b','a.student_user_id="'.$_POST['userId'].'" and a.password="'.$_POST['password'].'" and b.school_id=a.school_id and b.school_code="'.$subDemainName.'" and a.student_is_active=1 and b.school_is_active=1');
		    #set session variables for student
		   $sessionVariables=array($user->student_id,$user->school_code,$user->student_first_name.' '.$user->student_last_name,$user->student_email_id,'dashboard-parents');
	   else:
		   $login_session->pass_msg[]='you are not authorized to login.';
		   $login_session->set_pass_msg();
		   Redirect(make_url($page));
	   endif;
		
		# such user exists.
		if($user)
		{
		
				#set userid
				$login_session->user_id=$sessionVariables[0];
			    $login_session->set_user_id();	
				#set school unique
				$login_session->school_id=$user->school_id;
				$login_session->set_school_unique_id();
				#set username
				$login_session->username=$sessionVariables[2];
				$login_session->set_username();
				#set useremail
				$login_session->useremail=$sessionVariables[3];
				$login_session->set_useremail();
				#set usertype
				$login_session->usertype=$_POST['userType'];
				$login_session->set_usertype();
				
				
				
				if(isset($_POST['remember_me']) && $_POST['remember_me']==1):
				  #set remmember_me
				  $login_session->remember_me=1;
				  $login_session->set_remember_me();
				  $expireTime=time()+60*60*24*5;
				  setcookie("school_gennie_user_id", $sessionVariables[0], $expireTime);
				  setcookie("school_gennie_schoolId", $sessionVariables[1],$expireTime);
				  setcookie("school_gennie_username", $sessionVariables[2], $expireTime);
				  setcookie("school_gennie_useremail", $sessionVariables[3], $expireTime);
				  setcookie("school_gennie_usertype", $_POST['userType'], $expireTime);
				  setcookie("school_gennie_redirectUrl", $sessionVariables[4], $expireTime);
				else:
				  #set logoff time
				  $login_session->logOff_Time=strtotime("+30 minutes");
				  $login_session->set_logOff_Time(); 
				endif;
		
			    #redirect	
			    Redirect(make_url($sessionVariables[4]));
		
		}		
		else
		{
				#data base session unset
				$login_session->unset_database_session();
				# not such user exists.
				$login_session->pass_msg[]=MSG_LOGIN_INVALID_USERNAME_PASSWORD;
				$login_session->set_pass_msg();
				$login_session->set_error();
				Redirect(make_url($page));
		}
	}	
	else
	{
	    #data base session unset
		$login_session->unset_database_session();
	    #some fields are not validate	
		$login_session->pass_msg=$valid->error;
		$login_session->set_pass_msg();
		$login_session->set_error();
		Redirect(make_url($page));
	}
};
?>