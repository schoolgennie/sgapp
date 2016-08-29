<?
check_logged_in_for_myaccount('faculty');
$faculty_id=$login_session->get_user_id();
$facultyDetails=get_object_by_query('faculty','faculty_id='.$faculty_id);
if(isset($_POST['submit']) && $_POST['submit']=='Change'):
     # add validations
	$validation=new user_validation();
	$validation->add('password', 'req','old password');	
	$validation->add('npassword', 'req','new password');	
	$validation->add('cpassword', 'req','confirm new password');	
	$validation->add('cpassword', 'compare','New password and confirm new password',$_POST['npassword']);	
	# check validations.
	$valid= new valid();
	if($valid->validate($_POST, $validation->get())):
		   if($_POST['password'] == $facultyDetails->password):
				$data['password']=$_POST['npassword'];
				$data['change_password_status']=1;
				$where="faculty_id='".$faculty_id."'";																																																																																			
				update_record_in_table('faculty',$where,$data);
				    
				#if email id exist send login details
				$UserId=$facultyDetails->faculty_user_id;
				$email=$facultyDetails->faculty_email_id;
				$Password=$_POST['npassword'];
				$Name=$facultyDetails->faculty_first_name.' '.$facultyDetails->faculty_last_name;
				if($email):
				  include_once(DIR_FS_SITE_INCLUDE_EMAIL.'ChangePassword.php');
				  send_email(SUBJECT_CHANGE_PASSWORD_EMAIL, $email, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
				endif;
				Redirect(make_url('profile-faculty'));
		   else:	
				$login_session->pass_msg[]="your old password does not exist";
				$login_session->set_pass_msg();
				$login_session->set_success();
				Redirect(make_url('profile-faculty'));
		   endif;	
	else:		   
		$login_session->pass_msg=$valid->error;
		$login_session->set_pass_msg();
		Redirect(make_url('profile-faculty')); 
	endif;	   
endif;
?>
