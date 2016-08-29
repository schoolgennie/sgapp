<?
check_logged_in_for_myaccount('faculty');

isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
#faculty management id
$faculty_management_id=isset($_GET['faculty_management_id'])?$_GET['faculty_management_id']:'';
#student_id
$student_id=isset($_GET['student_id'])?$_GET['student_id']:'';
#academic test id
$academic_test_id=isset($_GET['academic_test_id'])?$_GET['academic_test_id']:'';
#faculty unique id
$faculty_id=$login_session->get_user_id();
#fetch school details
$facultyDetail=get_object_by_query('faculty','faculty_id='.$faculty_id);
#school_id
$school_id=$facultyDetail->school_id;

#fetch academic test list
$academicTestList=get_all_record_by_query('academic_test');

#fetch academic test detail
if($academic_test_id):
$academicTestDetail=get_object_by_query('academic_test','academic_test_id='.$academic_test_id);
endif;

#fetch assigned class list
$assignedClassList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1 group by a.class_id order by c.class_position');


#fetch assigned subject list
$assignedSubjectList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1 group by a.subject_id');

#fetch assigned subject list
$allAssignedSubjecClasstList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1');

#fetch incharge class
$inchargeClass=get_all_record_by_query('class','class_incharge="'.$faculty_id.'"  and class_is_active=1');


function studentAcademicTestResult($faculty_id,$academic_test_id,$class_id,$subject_id,$student_id,$field)
{
$result=get_object_by_query('academic_test_obtain_marks ','faculty_id="'.$faculty_id.'"  and academic_test_id="'.$academic_test_id.'" and class_id="'.$class_id.'" and subject_id="'.$subject_id.'"  and student_id="'.$student_id.'"');
return $result->$field;
}

#handle actions here.
switch ($action):
	case'insertStudentTestMarks':
	      #faculty management detail
		  $managementDetail=get_object_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and faculty_management_id="'.$faculty_management_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1 '); 
		  
		  #student list
		 // $studentList=get_all_record_by_query('student','class_id="'.$managementDetail->class_id.'"  and student_is_active!=0');	
		  $studentList=get_all_record_by_query('student as a,faculty_management as b,student_subject as c','b.class_id="'.$managementDetail->class_id.'" and b.faculty_id="'.$faculty_id.'" and b.subject_id="'.$managementDetail->subject_id.'" and c.faculty_management_id=b.faculty_management_id and c.student_id=a.student_id and a.student_is_active!=0');
		  //print_r($studentList);exit;	 
		 if(isset($_POST['submit']) && $_POST['submit']=='Save'):
		    # add validations
			$validation=new user_validation();
			//$validation->add('academic_test_obtain_marks', 'arrayNoElementBlank','student marks');
			//$validation->add('academic_test_obtain_marks', 'arrayAllNumericValue','student marks');	
			$validation->add('academic_test_obtain_marks', 'arrayValueLessThan','student marks',100);	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
		          $academic_test_id=$academic_test_id;
				  $class_id=$managementDetail->class_id;
				  $subject_id=$managementDetail->subject_id;
				 
				  
				  
			      foreach($_POST['student_id'] as $k=>$v):
				  #check Student Mark sExist For This Test
				  if($_POST['academic_test_obtain_marks'][$k]):
				    $checkStudentMarksExistForThisTest=get_object_by_query('academic_test_obtain_marks','faculty_id="'.$faculty_id.'"  and academic_test_id="'.$academic_test_id.'" and class_id="'.$class_id.'" and subject_id="'.$subject_id.'" and student_id="'.$v.'"'); 
					if($checkStudentMarksExistForThisTest):
					$data['academic_test_obtain_marks']=$_POST['academic_test_obtain_marks'][$k];
					$data['academic_test_obtain_marks_comment']=$_POST['academic_test_obtain_marks_comment'][$k];
					$QueryObj =new query('academic_test_obtain_marks');
					$QueryObj->Data=$data;
					$QueryObj->Where="where academic_test_obtain_marks_id='".$checkStudentMarksExistForThisTest->academic_test_obtain_marks_id."'";
					$QueryObj->UpdateCustom();
					
					else:
					$data['school_id']=$school_id;
					$data['faculty_id']=$faculty_id;
					$data['student_id']=$v;
					$data['class_id']=$class_id;
					$data['subject_id']=$subject_id;
					$data['academic_test_id']=$academic_test_id;
					$data['academic_test_obtain_marks']=$_POST['academic_test_obtain_marks'][$k];
					$data['academic_test_obtain_marks_comment']=$_POST['academic_test_obtain_marks_comment'][$k];
					$data['academic_test_obtain_marks_date']=date('d-m-Y');
					$QueryObj =new query('academic_test_obtain_marks');
					$QueryObj->Data=$data;
					$QueryObj->insert();
					endif;
				  endif;	
				  endforeach;	
				    //$login_session->pass_msg[]='test marks has been inserted successfully';
					//$login_session->set_pass_msg();
					//$login_session->set_success();
					Redirect(make_url('exams-createacademictest'));
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('exams-createacademictest')); 
			 endif;			
				
           endif;
		 
		   break;
	case 'scholastic':
	          $studentDetail=get_object_by_query('student','student_id="'.$student_id.'"'); 
	          $scholasticDetail=get_object_by_query('scholastic','student_id="'.$student_id.'"'); 
			  if(isset($_POST['submit']) && $_POST['submit']=='submit'):
			  $checkBoxArray=array('thinking_skills_array','social_skills_array','emotional_skills_array','attitude_towards_teachers_array','attitude_towards_schoolmates_array','attitude_towards_school_programming_environment_array','value_systems_array');
				  if($scholasticDetail):
						$not=array('submit');
						$data=$_POST;
						foreach($checkBoxArray as $k=>$v):
							if($_POST[$v]):
							  $data[$v]=implode(',',$_POST[$v]);
							endif;  
						endforeach;
						$where="student_id='".$student_id."'";																																																																																			
						update_record_in_table('scholastic',$where,$data,$not);
						Redirect(make_long_url('exams-createacademictest', 'scholastic', 'scholastic','student_id='.$student_id)); 
				  else:
						$not=array('submit');
						$data=$_POST;
						foreach($checkBoxArray as $k=>$v):
							if($_POST[$v]):
							  $data[$v]=implode(',',$_POST[$v]);
							endif;  
						endforeach;
						$data['student_id']=$student_id;
						insert_record_in_table('scholastic',$data,$not);
						Redirect(make_long_url('exams-createacademictest', 'scholastic', 'scholastic','student_id='.$student_id)); 
				  endif;
			  endif;
	       break;
	
endswitch;
?>
