<?
check_logged_in_for_myaccount('student');
$student_id=$login_session->get_user_id();
#fetch student details
$studentDetails=get_object_by_query('student','student_id='.$student_id);
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
		   if($_POST['password'] == $studentDetails->password):
				$data['password']=$_POST['npassword'];
				$data['change_password_status']=1;
				$where="student_id='".$student_id."'";																																																																																			
				update_record_in_table('student',$where,$data);
					
				# if email id exist send login details
				if($studentDetails->student_email_id):
				    $UserId=$studentDetails->student_user_id;
					$email=$studentDetails->student_email_id;
					$Password=$_POST['npassword'];
					$Name=$studentDetails->student_first_name.' '.$studentDetails->student_last_name;
				    include_once(DIR_FS_SITE_INCLUDE_EMAIL.'ChangePassword.php');
				   send_email(SUBJECT_CHANGE_PASSWORD_EMAIL, $email, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
				endif;
				Redirect(make_url('profile-student'));
		   else:	
				$login_session->pass_msg[]="your old password does not exist";
				$login_session->set_pass_msg();
				$login_session->set_success();
				Redirect(make_url('profile-student'));
		   endif;	
	else:		   
		$login_session->pass_msg=$valid->error;
		$login_session->set_pass_msg();
		Redirect(make_url('profile-student')); 
	endif;	   
endif;

?>
