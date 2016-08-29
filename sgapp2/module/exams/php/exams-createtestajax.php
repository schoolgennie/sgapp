<?php 
check_logged_in_for_myaccount('faculty');
$faculty_id=$login_session->get_user_id();

$class_id=isset($_GET['class_id'])?$_GET['class_id']:'0';
$subject_id=isset($_GET['subject_id'])?$_GET['subject_id']:'0';
$academic_test_id=isset($_GET['academic_test_id'])?$_GET['academic_test_id']:'';
$student_test_id=isset($_GET['student_test_id'])?$_GET['student_test_id']:'';


if(isset($_GET['mode'])):

	switch($_GET['mode']) {

	    case 'getStudentTestSubject':
			   $assignedClassSubjectList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and a.class_id="'.$class_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1');
			   #subject drop down
				$result='<select name="subject_id" class="form-control" required>';
				   foreach($assignedClassSubjectList as $k=>$v):
				      $result.='<option value="'.$v->subject_id.'">'.$v->subject_name.'</option>';
				   endforeach;
				$result.='</select>';
				echo $result;
				exit;
	   break;
	   
	   case 'deleteStudentTest':
	        delete_record_from_table('student_test','student_test_id="'.$student_test_id.'"');
			exit;
	  break;
	}				

endif;		
?>				
