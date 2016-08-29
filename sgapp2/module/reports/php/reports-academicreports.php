<?
$userType=($login_session->get_usertype())?$login_session->get_usertype():'';
check_logged_in_for_myaccount($userType);


if($login_session->get_usertype()==$userTypeArray[0]):# school
   #school unique id
   $school_id=$login_session->get_user_id();
	#get class list
	$classList=get_all_record_by_query('class','school_id="'.$school_id.'" and class_is_active=1');
	
   

elseif($login_session->get_usertype()==$userTypeArray[1]):# faculty

   #faculty unique id
   $faculty_id=$login_session->get_user_id();
   #fetch faculty details
   $facultyDetail=get_object_by_query('faculty','faculty_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$facultyDetail->school_id;
   
	#get class list
	$classList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1 group by a.class_id order by c.class_position');
	
  
elseif($login_session->get_usertype()==$userTypeArray[2]):# student
   #fetch student details
   $studentDetail=get_object_by_query('student','student_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$studentDetail->school_id;
   

endif;

if((isset($_POST['submit']) && $_POST['submit']=='Generate') || $login_session->get_usertype()==$userTypeArray[2]):



if($login_session->get_usertype()==$userTypeArray[0]):# school
      
	# add validations start
	$validation=new user_validation();
	$validation->add('class_id', 'req','class name');	
	$validation->add('student_id', 'req','student name');	
	$validation->add('fromDate', 'req','Year');	
	# check validations.
	$valid= new valid();
	if(!$valid->validate($_POST, $validation->get())):
					$login_session->pass_msg=$valid->error;
					$login_session->set_pass_msg();
					Redirect(make_url('reports-academicreports')); 
					exit;
	endif;
	# add validationsend
	
	
	$classId=(isset($_REQUEST['class_id']) && $_REQUEST['class_id']!='')?$_REQUEST['class_id']:'';
    $student_id=(isset($_REQUEST['student_id']) && $_REQUEST['student_id']!='')?$_REQUEST['student_id']:'';
    $fromDate=(isset($_REQUEST['fromDate']) && $_REQUEST['fromDate']!='')?$_REQUEST['fromDate']:'';
	
	
   

elseif($login_session->get_usertype()==$userTypeArray[1]):# faculty

  
   # add validations start
	$validation=new user_validation();
	$validation->add('class_id', 'req','class name');	
	$validation->add('student_id', 'req','student name');
	$validation->add('fromDate', 'req','Year');		
	# check validations.
	$valid= new valid();
	if(!$valid->validate($_POST, $validation->get())):
					$login_session->pass_msg=$valid->error;
					$login_session->set_pass_msg();
					Redirect(make_url('reports-academicreports')); 
					exit;
	endif;
	# add validationsend
	$classId=(isset($_REQUEST['class_id']) && $_REQUEST['class_id']!='')?$_REQUEST['class_id']:'';
    $student_id=(isset($_REQUEST['student_id']) && $_REQUEST['student_id']!='')?$_REQUEST['student_id']:'';
    $fromDate=(isset($_REQUEST['fromDate']) && $_REQUEST['fromDate']!='')?$_REQUEST['fromDate']:'';
	
  
elseif($login_session->get_usertype()==$userTypeArray[2]):# student
     
    # add validations start
	$validation=new user_validation();	
	$validation->add('fromDate', 'req','Year');	
	# check validations.
	$valid= new valid();
	if(!$valid->validate($_POST, $validation->get())):
					$login_session->pass_msg=$valid->error;
					$login_session->set_pass_msg();
					Redirect(make_url('reports-academicreports')); 
					exit;
	endif;
	# add validationsend
	$classId=$studentDetail->class_id;
	$student_id=$login_session->get_user_id();
	$fromDate=(isset($_REQUEST['fromDate']) && $_REQUEST['fromDate']!='')?$_REQUEST['fromDate']:'';

endif;


$schoolDetail=get_object_by_query('school','school_id='.$school_id);





#fetch academic test list
$acdamicTestList=get_all_record_by_query('academic_test');

#create array of test list from 'academic_test' table for reports
$academicTestArray=array();
$academicTestArray[$acdamicTestList[0]->academic_test_name]=$acdamicTestList[0]->academic_test_id;

$academicTestArray[$acdamicTestList[1]->academic_test_name]=$acdamicTestList[1]->academic_test_id;

$academicTestArray[$acdamicTestList[4]->academic_test_name]=$acdamicTestList[4]->academic_test_id;

$academicTestArray[$acdamicTestList[0]->academic_test_name.'+'.$acdamicTestList[1]->academic_test_name.' +'.$acdamicTestList[4]->academic_test_name]=$acdamicTestList[0]->academic_test_id.','.$acdamicTestList[1]->academic_test_id.','.$acdamicTestList[4]->academic_test_id;
$academicTestArray[$acdamicTestList[2]->academic_test_name]=$acdamicTestList[2]->academic_test_id;

$academicTestArray[$acdamicTestList[3]->academic_test_name]=$acdamicTestList[3]->academic_test_id;

$academicTestArray[$acdamicTestList[5]->academic_test_name]=$acdamicTestList[5]->academic_test_id;

$academicTestArray[$acdamicTestList[2]->academic_test_name.'+'.$acdamicTestList[3]->academic_test_name.' +'.$acdamicTestList[5]->academic_test_name]=$acdamicTestList[2]->academic_test_id.','.$acdamicTestList[3]->academic_test_id.','.$acdamicTestList[5]->academic_test_id;

$academicTestArray[$acdamicTestList[0]->academic_test_name.'+'.$acdamicTestList[1]->academic_test_name.'+ '.$acdamicTestList[2]->academic_test_name.'+'.$acdamicTestList[3]->academic_test_name]=$acdamicTestList[0]->academic_test_id.','.$acdamicTestList[1]->academic_test_id.','.$acdamicTestList[2]->academic_test_id.','.$acdamicTestList[3]->academic_test_id;

$academicTestArray[$acdamicTestList[4]->academic_test_name.'+'.$acdamicTestList[5]->academic_test_name]=$acdamicTestList[4]->academic_test_id.','.$acdamicTestList[5]->academic_test_id;

$academicTestArray['Overall']=$acdamicTestList[0]->academic_test_id.','.$acdamicTestList[1]->academic_test_id.','.$acdamicTestList[2]->academic_test_id.','.$acdamicTestList[3]->academic_test_id.','.$acdamicTestList[4]->academic_test_id.','.$acdamicTestList[5]->academic_test_id;

$academicTestArray['Grade Point']=$acdamicTestList[0]->academic_test_id.','.$acdamicTestList[1]->academic_test_id.','.$acdamicTestList[2]->academic_test_id.','.$acdamicTestList[3]->academic_test_id.','.$acdamicTestList[4]->academic_test_id.','.$acdamicTestList[5]->academic_test_id;

#student detail
if($student_id):
$studentDetail=get_object_by_query('student','student_id='.$student_id);
$scholasticDetail=get_object_by_query('scholastic','student_id="'.$student_id.'"'); 
endif;


$where='';
$where.=($classId)?'a.class_id="'.$classId.'" and ':'';
$where.=($school_id)?'a.school_id="'.$school_id.'" and ':'';





#subject list
$subjectListArray=get_all_record_by_query('faculty_management as a, faculty as b, subject as c,student_subject as d',$where.' d.faculty_management_id=a.faculty_management_id and  d.student_id="'.$student_id.'" and  b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and b.faculty_is_active=1 and c.subject_is_active=1 group by a.subject_id order by a.faculty_management_is_active desc');


endif;
function getAcademicTestMarks1($school_id,$student_id,$class_id,$subject_id,$academic_test_id,$ondate)
{

$result=get_object_by_query('academic_test_obtain_marks','school_id="'.$school_id.'" and student_id="'.$student_id.'" and class_id="'.$class_id.'" and subject_id="'.$subject_id.'" and academic_test_id in ('.$academic_test_id.') and DATE_FORMAT(STR_TO_DATE(academic_test_obtain_marks_date, "%d-%m-%Y" ) , "%Y") ="'.$ondate.'"','*,SUM(academic_test_obtain_marks) as TotalMarks,COUNT(academic_test_obtain_marks) as TotalCount');

return $result->TotalMarks/$result->TotalCount;

}
function getAcademicTestMarks($school_id,$student_id,$class_id,$subject_id,$academic_test_id,$ondate)
{
$academicTestIdArray=explode(',',$academic_test_id);
if(count($academicTestIdArray)>1):
	$obtainSum='';
	$percentage='';
	foreach($academicTestIdArray as $k=>$v):
	//$result=get_object_by_query('academic_test_obtain_marks','school_id="'.$school_id.'" and student_id="'.$student_id.'" and class_id="'.$class_id.'" and subject_id="'.$subject_id.'" and academic_test_id="'.$v.'" and DATE_FORMAT(STR_TO_DATE(academic_test_obtain_marks_date, "%d-%m-%Y" ) , "%Y") ="'.$ondate.'"');
	$result=get_object_by_query('academic_test_obtain_marks','school_id="'.$school_id.'" and student_id="'.$student_id.'" and class_id="'.$class_id.'" and subject_id="'.$subject_id.'" and academic_test_id="'.$v.'"');
		if($result):
		  if($v<=4):
		    $obtainSum=$obtainSum+(($result->academic_test_obtain_marks/100)*10);
			$percentage=$percentage+10;
		  else: 
		    $obtainSum=$obtainSum+(($result->academic_test_obtain_marks/100)*30);
			$percentage=$percentage+30;
		  endif;
		endif;
	endforeach;
	return ($obtainSum/$percentage)*100;
else:

  $result=get_object_by_query('academic_test_obtain_marks','school_id="'.$school_id.'" and student_id="'.$student_id.'" and class_id="'.$class_id.'" and subject_id="'.$subject_id.'" and academic_test_id="'.$academic_test_id.'"');
  //$result=get_object_by_query('academic_test_obtain_marks','school_id="'.$school_id.'" and student_id="'.$student_id.'" and class_id="'.$class_id.'" and subject_id="'.$subject_id.'" and academic_test_id="'.$academic_test_id.'" and DATE_FORMAT(STR_TO_DATE(academic_test_obtain_marks_date, "%d-%m-%Y" ) , "%Y") ="'.$ondate.'"');
  return $result->academic_test_obtain_marks;

endif;	
}

function convertMarksToGrade($marks,$element)
{
$marksRangeArray=array('91-100'=>array('A1','10.0'),'81-90'=>array('A2','9.0'),'71-80'=>array('B1','8.0'),'61-70'=>array('B2','7.0'),'51-60'=>array('C1','6.0'),'41-50'=>array('C2','5.0'),'35-40'=>array('D','4.0'),'00-34'=>array('E','3.0'));
foreach($marksRangeArray as $k=>$v):
  $va=explode('-',$k);
  if($marks>=$va[0] && $marks<=$va[1]):
   return $v[$element];
  endif;
endforeach;

}

?>