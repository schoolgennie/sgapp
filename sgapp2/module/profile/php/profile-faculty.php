<?
check_logged_in_for_myaccount('faculty');
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
#unique faculty id
$faculty_id=$login_session->get_user_id();
#fetch faculty details
$facultyDetails=get_object_by_query('faculty','faculty_id='.$faculty_id);
#school unique id
$school_id=$facultyDetails->school_id;
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

#fetch incharge class
$inchargeClass=get_object_by_query('class','class_incharge="'.$faculty_id.'"  and class_is_active=1');


	#update faculty profile details	
	if(isset($_POST['submit']) && $_POST['submit']=='Update'):
		# add validations
		$validation=new user_validation();
		$validation->add('faculty_email_official', 'req','Email Official');	
		$validation->add('faculty_email_official', 'email','Email Official');	
		$validation->add('faculty_email_personal', 'email','Email personal');	
		$validation->add('faculty_contact', 'num','phone');
		$validation->add('faculty_mobile', 'req','Mobile');
		$validation->add('faculty_mobile', 'num','Mobile');
			
		# check validations.
		$valid= new valid();
		if($valid->validate($_POST, $validation->get())):
					$data['faculty_email_official']=$_POST['faculty_email_official'];
					$data['faculty_email_personal']=$_POST['faculty_email_personal'];
					$data['faculty_contact']=$_POST['faculty_contact'];
					$data['faculty_mobile']=$_POST['faculty_mobile'];
					$where="faculty_id='".$faculty_id."'";																																																																																			
					update_record_in_table('faculty',$where,$data);
					Redirect(make_url('profile-faculty'));
		else:	   
					$login_session->pass_msg=$valid->error;
					$login_session->set_pass_msg();
					Redirect(make_url('profile-faculty')); 
		endif;	
	endif;
?>