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
	   $user=get_object_by_query('school','school_id="'.$_POST['userId'].'" and school_code="'.$subDemainName.'" and password="'.$_POST['password'].'" and school_is_active=1 ');
		# such user exists.
		if($user)
		{
				#set userid
				$login_session->user_id=$user->school_id;
			    $login_session->set_user_id();	
				#set school unique
				$login_session->school_id=$user->school_id;
				$login_session->set_school_unique_id();
				#set username
				$login_session->username=$user->school_name;
				$login_session->set_username();
				#set useremail
				$login_session->useremail=$user->school_email_id;
				$login_session->set_useremail();
				#set usertype
				$login_session->usertype='school';
				$login_session->set_usertype();
				
				
				
				if(isset($_POST['remember_me']) && $_POST['remember_me']==1):
				  #set remmember_me
				  $login_session->remember_me=1;
				  $login_session->set_remember_me();
				  $expireTime=time()+60*60*24*5;
				  setcookie("school_gennie_user_id", $user->school_id, $expireTime);
				  setcookie("school_gennie_schoolId", $user->school_code,$expireTime);
				  setcookie("school_gennie_username", $user->school_name, $expireTime);
				  setcookie("school_gennie_useremail", $user->school_email_id, $expireTime);
				  setcookie("school_gennie_usertype", 'school', $expireTime);
				  setcookie("school_gennie_redirectUrl", 'dashboard-school', $expireTime);
				else:
				  #set logoff time
				  $login_session->logOff_Time=strtotime("+30 minutes");
				  $login_session->set_logOff_Time(); 
				endif;
		
			   
				#Update total visits
				$data['school_total_visit']=$user->school_total_visit +1;
				$data['school_last_visit']=date("Y-m-d h:i:s");
				$where="school_id='".$user->school_id."'";																																																																																			
				update_record_in_table('school',$where,$data);
				
				
			    #redirect	
			    Redirect(make_url('dashboard-school'));
		
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