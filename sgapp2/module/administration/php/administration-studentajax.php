<?php 
check_logged_in_for_myaccount('school');

$student_id=(isset($_POST['student_id']) && $_POST['student_id']!='')?$_POST['student_id']:'';
$student_user_id=(isset($_POST['student_user_id']) && $_POST['student_user_id']!='')?$_POST['student_user_id']:'';
$class_id=(isset($_POST['class_id']) && $_POST['class_id']!='')?$_POST['class_id']:'';
$student_admission_no=(isset($_POST['student_admission_no']) && $_POST['student_admission_no']!='')?$_POST['student_admission_no']:'';
$student_roll_number=(isset($_POST['student_roll_number']) && $_POST['student_roll_number']!='')?$_POST['student_roll_number']:'';
#fetch student details
if($student_id):
$studentDetail=get_object_by_query('student','student_user_id="'.$student_user_id.'" and student_id!="'.$student_id.'"');
else: 
$studentDetail=get_object_by_query('student','student_user_id="'.$student_user_id.'"');
endif;
if(isset($_POST['mode'])):

	switch($_POST['mode'])
	 {

	    case 'checkUserIdExist':
	          if($studentDetail):
			     echo 'User Id already exit';
			  endif; 
			  exit;
	   break;
	    case 'checkAdmissionNo':
		      if($student_id):
			    $admissionNo=get_object_by_query('student','student_admission_no="'.$student_admission_no.'" and student_id!="'.$student_id.'"');
			  else: 
				$admissionNo=get_object_by_query('student','student_admission_no="'.$student_admission_no.'"');
			  endif;
	          if($admissionNo):
			     echo 'Admission No already exit';
			  endif; 
			  exit;
	   break;
	    case 'checkRollNo':
	           if($student_id):
			    $rollNo=get_object_by_query('student','student_roll_number="'.$student_roll_number.'" and student_id!="'.$student_id.'"');
			  else: 
				$rollNo=get_object_by_query('student','student_roll_number="'.$student_roll_number.'"');
			  endif;
	          if($rollNo):
			     echo 'Roll No already exit';
			  endif;  
			  exit;
	   break;
	   case 'subjectList':
	          if($class_id):
			     $subjectList=get_all_record_by_query('faculty_management as a ,subject as b,class as c,faculty as d','a.class_id="'.$class_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and d.faculty_id=a.faculty_id and b.subject_is_active=1 and c.class_is_active=1 and d.faculty_is_active!=0 and a.faculty_management_is_active=1');
				 $result='';
				 if($subjectList):
				  foreach($subjectList as $k=>$v):
				  $result.='<div class="col-sm-4">'; 
				  $result.=$v->subject_name;
				  $result.='<input type="checkbox"  class="flat-green" id="faculty_management_id" name="faculty_management_id[]" value="'.$v->faculty_management_id.'">';
				  $result.='</div>'; 
				  endforeach;
				 else:
				   $result.='No Subject List'; 
				 endif;
				 echo $result;
			  endif; 
			  exit;
	   break;
	}				
endif;		
?>				