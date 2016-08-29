<?
check_logged_in_for_myaccount('faculty');

$ondate=(isset($_REQUEST['ondate']) && strtotime(str_replace('_','-',$_REQUEST['ondate']))<=strtotime(date('Y-m-d')))?date('Y-m-d',strtotime(str_replace('_','-',$_REQUEST['ondate']))):date('Y-m-d');
$previous=date('Y_m_d',strtotime('-1 day',strtotime($ondate)));
$next=date('Y_m_d',strtotime('+1 day',strtotime($ondate)));

#faculty unique id
$faculty_id=$login_session->get_user_id();
#fetch school details
$facultyDetail=get_object_by_query('faculty','faculty_id='.$faculty_id);
#school id
$school_id=$facultyDetail->school_id;
#fetch incharge class
$inchargeClass=get_object_by_query('class','class_incharge="'.$faculty_id.'"  and school_id="'.$school_id.'" and class_is_active=1');
#fetch studentList
$studentList=get_all_record_by_query('student','class_id="'.$inchargeClass->class_id.'" and student_is_active!=0');
#handle actions here.

 # add home work
if(isset($_POST['submit']) && ($_POST['submit']=='Submit' || $_POST['submit']=='Update')):
		foreach($_POST['student_attendance'] as $k=>$v):
		   #validate student
		   $validateStudent=get_object_by_query('student','student_id="'.$k.'" and class_id="'.$inchargeClass->class_id.'" and student_is_active!=0');
		   if($validateStudent):
		   #check value already exist or not
		   $checkValue=get_object_by_query('student_attendance','student_id="'.$k.'" and school_id="'.$school_id.'" and student_attendance_date="'.$_POST['student_attendance_date'].'"');
			if($checkValue):
				$dataUpdate['student_attendance']=$v;
				$where="student_attendance_id='".$checkValue->student_attendance_id."'";																																																																																			
				update_record_in_table('student_attendance',$where,$dataUpdate);
			else:
				$data['student_id']=$k;
				$data['class_id']=$inchargeClass->class_id;
				$data['school_id']=$school_id;
				$data['faculty_id']=$faculty_id;
				$data['student_attendance']=$v;
				$data['student_attendance_date']=$_POST['student_attendance_date'];
				insert_record_in_table('student_attendance',$data);
			endif;	
			#send sms
			if(isset($_POST['sendSms'])):
				$studentDetail=get_object_by_query('student','student_id="'.$k.'"');
				$content='attendance';
				if($studentDetail->student_contact):
				  //sendSms($v->student_contact,SITE_NAME.' attendance',$contents);
				endif; 	
			endif;  
							 
		   endif;		
		endforeach;	
		Redirect(make_url('attendance-student','ondate='.str_replace('-','_',$_POST['student_attendance_date'])));
endif;		
?>
