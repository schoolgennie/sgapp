<?
check_logged_in_for_myaccount('faculty');

isset($_GET['action'])?$action=$_GET['action']:$action='assignedClassList';
isset($_GET['section'])?$section=$_GET['section']:$section='assignedClassList';
isset($_POST['student_test_id'])?$student_test_id=$_POST['student_test_id']:$student_test_id='';
#faculty unique id
$faculty_id=$login_session->get_user_id();
#fetch school details
$facultyDetail=get_object_by_query('faculty','faculty_id='.$faculty_id);
#school_id
$school_id=$facultyDetail->school_id;

#to prepare where condition for search result
$class_id=isset($_POST['class_id'])?implode(',',$_POST['class_id']):'0';
$subject_id=isset($_POST['subject_id'])?implode(',',$_POST['subject_id']):'0';
$dateRange=(isset($_POST['dateRange']) && $_POST['dateRange']!='')?explode(' - ',$_POST['dateRange']):'0';
$where='';
$where.=($class_id)?' and b.class_id in ('.$class_id.')':'';
$where.=($subject_id)?' and c.subject_id in ('.$subject_id.')':'';
$where.=($dateRange)?' and DATE_FORMAT( STR_TO_DATE( a.student_test_date , "%d-%m-%Y" ) , "%Y/%m/%d" ) >="'.date('Y/m/d',strtotime($dateRange[0])).'" and DATE_FORMAT( STR_TO_DATE( a.student_test_date , "%d-%m-%Y" ) , "%Y/%m/%d" ) <="'.date('Y/m/d',strtotime($dateRange[1])).'"':'';

#fetch assigned class list
$assignedClassList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1 group by a.class_id order by c.class_position');

#fetch assigned subject list
$assignedSubjectList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1 group by a.subject_id');

#fetch created test list
$createdTestList=get_all_record_by_query('student_test as a,class as b,subject as c','a.faculty_id="'.$faculty_id.'" and b.class_id=a.class_id and c.subject_id=a.subject_id and b.class_is_active=1 and c.subject_is_active=1 '.$where.' order by a.student_test_is_active desc,a.student_test_date desc,a.student_test_id desc');


if($student_test_id):
  # get student test details
  $studentTestDetails=get_object_by_query('student_test as a,subject as b,class as c','a.student_test_id="'.$student_test_id.'" and a.faculty_id="'.$faculty_id.'" and b.subject_id=a.subject_id and b.subject_is_active=1 and c.class_id=a.class_id and c.class_is_active=1');
  #authenticate user
  if(!$studentTestDetails): #if no
	        Redirect(make_url('exams-createclasstest'));
  endif;
endif;



#handle actions here.
switch ($action):

	case'insertTest':
	     #fetch assigned classes list
         $assignedClassList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1 group by a.class_id order by c.class_position');
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Create'):
		    # add validations
			$validation=new user_validation();
			$validation->add('student_test_name', 'req','Test Name');
			$validation->add('class_id', 'req','class name');	
			$validation->add('class_id', 'num','class name');
			$validation->add('subject_id', 'req','subject name');	
			$validation->add('subject_id', 'num','subject name');
			$validation->add('student_test_max_marks', 'req','Maximum Marks');
			$validation->add('student_test_max_marks', 'num','Maximum Marks');
			$validation->add('student_test_date', 'req','Test Date');
			$validation->add('student_test_date', 'checkDate','Test Date');#mm-dd-yyyy
			
			
					
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			
			$checkTestExist=get_object_by_query('student_test','faculty_id="'.$faculty_id.'"  and class_id="'.$_POST['class_id'].'" and subject_id="'.$_POST['subject_id'].'" and student_test_date="'.$_POST['student_test_date'].'"');   
			   if($checkTestExist):
			        $login_session->pass_msg[]=($checkTestExist->student_test_is_active==0)?'Entered record already exist and deactivated .Please activate that':'Entered record already exist';
					$login_session->set_pass_msg();
					$login_session->set_success();
					Redirect(make_url('exams-createclasstest'));
			   
			   else: 
					$not=array('submit');
					$QueryObj =new query('student_test');
					$QueryObj->Data=MakeDataArray($_POST, $not);
					$QueryObj->Data['faculty_id']=$faculty_id;
					$QueryObj->Data['school_id']=$school_id;
					$QueryObj->Insert();
					Redirect(make_long_url('exams-createclasstest'));
				endif;	
			 else:
					    $login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('exams-createclasstest')); 
			 endif;			
			
		endif;	
		break;
		
		
	case'insertStudentTestMarks':
	      #fetch student list
        // $studentList=get_all_object_by_query('student','class_id="'.$studentTestDetails->class_id.'" and school_id="'.$facultyDetail->school_id.'" and student_is_active!=0');
		 
		 if(isset($_POST['submit']) && $_POST['submit']=='Save'):
		    # add validations
			$validation=new user_validation();
			//$validation->add('student_test_obtain_marks', 'arrayNoElementBlank','student marks');
			//$validation->add('student_test_obtain_marks', 'arrayAllNumericValue','student marks');	
			$validation->add('student_test_obtain_marks', 'arrayValueLessThan','student marks',$studentTestDetails->student_test_max_marks);	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			      foreach($_POST['student_id'] as $k=>$v):
				  if($_POST['student_test_obtain_marks'][$k]):
				  #check Student Mark sExist For This Test
				    $checkStudentMarksExistForThisTest=get_object_by_query('student_test_obtain_marks','faculty_id="'.$faculty_id.'"  and student_test_id="'.$student_test_id.'" and student_id="'.$v.'"'); 
					#fetch student details
					$studentDetails=get_object_by_query('student','student_id="'.$v.'"');
					
				    #values for email and sms start
					$studentEmail=$studentDetails->student_email_id;
					$name=$studentDetails->student_first_name.' '.$studentDetails->student_last_name;
					$obtainMarks=$_POST['student_test_obtain_marks'][$k];
					$testMaxMarks=$studentTestDetails->student_test_max_marks;
					$testdate=$studentTestDetails->student_test_date;
					$subjectName=get_object_by_query('subject','subject_id='.$studentTestDetails->subject_id)->subject_name;
					$Feedback=($_POST['student_test_obtain_marks_comment'][$k])?$_POST['student_test_obtain_marks_comment'][$k]:'No Remarks';
					$teacherName=$facultyDetail->faculty_first_name.' '.$facultyDetail->faculty_last_name;
					include(DIR_FS_SITE_INCLUDE_EMAIL.'studentTestMarks.php');
					#values for email and sms end
					
					
					if($checkStudentMarksExistForThisTest):
					$data['student_test_obtain_marks']=$_POST['student_test_obtain_marks'][$k];
					$data['student_test_obtain_marks_comment']=$_POST['student_test_obtain_marks_comment'][$k];
					$QueryObj =new query('student_test_obtain_marks');
					$QueryObj->Data=$data;
					$QueryObj->Where="where student_test_obtain_marks_id='".$checkStudentMarksExistForThisTest->student_test_obtain_marks_id."'";
					$QueryObj->UpdateCustom();
					
					#send mail
					if(isset($_POST['sendMail']) && $studentEmail):
						send_email(SITE_NAME.': student test marks', $studentEmail, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
					endif;
					#send sms
				    if(isset($_POST['sendSms']) && $studentDetails->student_contact):
				      //sendSms($studentDetails->student_contact,'TEST SMS',$contents);
					endif;
					
					else:
					$data['student_test_obtain_marks']=$_POST['student_test_obtain_marks'][$k];
					$data['faculty_id']=$faculty_id;
					$data['student_id']=$v;
					$data['student_test_id']=$student_test_id;
					$data['student_test_obtain_marks_comment']=$_POST['student_test_obtain_marks_comment'][$k];
					$QueryObj =new query('student_test_obtain_marks');
					$QueryObj->Data=$data;
					$QueryObj->insert();
					#send mail
					if(isset($_POST['sendMail'])):
						send_email(SITE_NAME.': student test marks', $studentEmail, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
					endif;
					#send sms
				    if(isset($_POST['sendSms']) && $studentDetails->student_contact):
				     // sendSms($studentDetails->student_contact,'TEST SMS',$contents);
					endif;
					endif;
				  endif;	
				  endforeach;	
				    
					
					Redirect(make_url('exams-createclasstest'));
			 else:
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('exams-createclasstest')); 
			 endif;			
				
           endif;
		   break;
endswitch;
?>
