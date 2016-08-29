<?
check_logged_in_for_myaccount('school');
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';

#school unique id
$school_id=$login_session->get_user_id();
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

$code=generateCode(6);


#update school profile details	
if(isset($_POST['submit']) && $_POST['submit']=='Update'):
	# add validations
	$validation=new user_validation();
	$validation->add('school_admin_name', 'req','admin name');
	$validation->add('school_email_id', 'req','School Official Email Id');
	$validation->add('school_email_id', 'email','School Official Email Id');$validation->add('school_state', 'alpha','State');
	$validation->add('school_city', 'alpha','city');
	$validation->add('school_phone1', 'num','Primary Contact Number');
	$validation->add('school_phone2', 'num','Secondary Contact Number');	
	# check validations.
	$valid= new valid();
	if($valid->validate($_POST, $validation->get())):
				$not=array('submit','school_id','school_code','school_affiliation_no','school_name','school_email_official','school_image','school_logo_image','school_title_image','school_admin_image','school_user_id','password','school_country','school_zip_code','school_admin_phone','school_description','school_student_create_limit','school_message_limit','school_last_visit','school_total_visit','school_activation_code','school_activation_code_status','school_is_active','school_create_date','school_ip_address','change_password_status');
				$data=$_POST;
				$where="school_id='".$school_id."'";																																																																																			
				update_record_in_table('school',$where,$data,$not);
				Redirect(make_url('profile-school'));	
	else:		   
			   $login_session->pass_msg=$valid->error;
			   $login_session->set_pass_msg();
			   Redirect(make_url('profile-school')); 
	endif;	
endif;
?>