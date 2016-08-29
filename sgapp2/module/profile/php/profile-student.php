<?
check_logged_in_for_myaccount('student');
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';

#unique student id
$student_id=$login_session->get_user_id();
#fetch student details
$studentDetails=get_object_by_query('student','student_id='.$student_id);
#school unique id
$school_id=$studentDetails->school_id;
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);
#fetch class list
$classList=get_all_record_by_query('class','school_id="'.$studentDetails->school_id.'"  order by class_position');

#update faculty profile details	
if(isset($_POST['submit']) && $_POST['submit']=='Update'):
# add validations
			$validation=new user_validation();
			$validation->add('student_state', 'req','state');
			$validation->add('student_city', 'req','city');
			$validation->add('student_zip', 'num','zip');
			$validation->add('student_zip', 'fixlength','zip','6');
			$validation->add('student_father_phone', 'num','father Contact Number');
			$validation->add('student_father_email_id', 'email','father email id');
			$validation->add('student_mother_phone', 'num','mother Contact Number');
			$validation->add('student_mother_email_id', 'email','mother email id');
			$validation->add('student_contact', 'num','Contact No.');	
							
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
					$data['student_state']=$_POST['student_state'];
					$data['student_city']=$_POST['student_city'];
					$data['student_father_phone']=$_POST['student_father_phone'];
					$data['student_mother_phone']=$_POST['student_mother_phone'];
					$data['student_father_email_id']=$_POST['student_father_email_id'];
					$data['student_mother_email_id']=$_POST['student_mother_email_id'];
					$data['student_address']=$_POST['student_address'];
					$data['student_contact']=$_POST['student_contact'];
					$where="student_id='".$student_id."'";																																																																																			
					update_record_in_table('student',$where,$data);
					Redirect(make_url('profile-student'));
			else:
					$login_session->pass_msg=$valid->error;
					$login_session->set_pass_msg();
					Redirect(make_url('profile-student')); 
			endif;	
 endif;

?>