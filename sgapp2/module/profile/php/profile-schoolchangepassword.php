<?
check_logged_in_for_myaccount('school');
#school unique id
$school_id=$login_session->get_user_id();
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

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
		   if($_POST['password'] == $schoolDetail->password):
				$data['password']=$_POST['npassword'];
				$data['change_password_status']=1;
				$where="school_id='".$school_id."'";																																																																																			
				update_record_in_table('school',$where,$data);
				#mail content
				$UserId=$schoolDetail->school_id;
				$Password=$_POST['npassword'];
				$Name=$schoolDetail->school_name;
				include_once(DIR_FS_SITE_INCLUDE_EMAIL.'ChangePassword.php');
				send_email(SUBJECT_CHANGE_PASSWORD_EMAIL, $schoolDetail->school_email_id, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
				Redirect(make_url('profile-school'));
		   else:	
				$login_session->pass_msg[]="your old password does not exist";
				$login_session->set_pass_msg();
				$login_session->set_success();
				Redirect(make_url('profile-school'));
		   endif;	
	else:		   
		$login_session->pass_msg=$valid->error;
		$login_session->set_pass_msg();
		Redirect(make_url('profile-school')); 
	endif;	   
endif;
?>
