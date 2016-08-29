<?php 
$userType=($login_session->get_usertype())?$login_session->get_usertype():'';
check_logged_in_for_myaccount($userType);

if($login_session->get_usertype()==$userTypeArray[0]):# school
   #school unique id
   $school_id=$login_session->get_user_id();

elseif($login_session->get_usertype()==$userTypeArray[1]):# faculty
   #fetch faculty details
   $facultyDetail=get_object_by_query('faculty','faculty_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$facultyDetail->school_id;

elseif($login_session->get_usertype()==$userTypeArray[2]):# student
   #fetch student details
   $studentDetail=get_object_by_query('student','student_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$studentDetail->school_id;
endif;


$class_id=isset($_POST['class_id'])?$_POST['class_id']:'0';
$subjectId=(isset($_POST['subjectId']) && $_POST['subjectId']!='')?$_POST['subjectId']:'';
$studendId=(isset($_POST['studendId']) && $_POST['studendId']!='')?$_POST['studendId']:'';
if(isset($_POST['mode'])):

	switch($_POST['mode'])
	 {

	
	   case 'getStudentAndSubjectList':
	          $subjectListQuery=get_all_record_by_query('faculty_management as a, faculty as b, subject as c','a.class_id="'.$class_id.'" and a.school_id="'.$school_id.'" and b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and b.faculty_is_active!=0 and c.subject_is_active=1 group by a.subject_id order by a.faculty_management_is_active desc');
			 
	          $subjectList='';
              $subjectList.='<select name="subject_id" class="form-control" >';
			  $subjectList.='<option value="">All Subjects</option>';
			  foreach($subjectListQuery as $k=>$v):
			    $IsSelectedSubject=($subjectId && $subjectId==$v->subject_id)?"selected":"";
                $subjectList.='<option value="'.$v->subject_id.'" '.$IsSelectedSubject.'>'.$v->subject_name.'</option>';
			  endforeach;	
              $subjectList.='</select>';
			  
			  $studentListQuery=get_all_record_by_query('student','class_id="'.$class_id.'" and student_is_active!=0');
			  
			  $studentList='';
              $studentList.='<select name="student_id" class="form-control" required onChange="getSubjectList('.$class_id.',this.value)">>';
			  $studentList.='<option value="">--- student ---</option>';
			  foreach($studentListQuery as $key=>$value):
			    $IsSelectedStudent=($studendId && $studendId==$value->student_id)?"selected":"";
                $studentList.='<option value="'.$value->student_id.'" '.$IsSelectedStudent.'>'.$value->student_first_name.' '.$value->student_last_name.'</option>';
			  endforeach;	
              $studentList.='</select>';
	     
		      echo $subjectList.'~!'.$studentList;
			  exit;
		break;
		case 'getSubjectList':
		       $subjectListQuery=get_all_record_by_query('faculty_management as a, faculty as b, subject as c,student_subject as d','a.class_id="'.$class_id.'" and d.faculty_management_id=a.faculty_management_id and  d.student_id="'.$studendId.'" and b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and b.faculty_is_active!=0 and c.subject_is_active=1 group by a.subject_id order by a.faculty_management_is_active desc');
			 
	          $subjectList='';
              $subjectList.='<select name="subject_id" class="form-control" >';
			  $subjectList.='<option value="">All Subjects</option>';
			  foreach($subjectListQuery as $k=>$v):
			    $IsSelectedSubject=($subjectId && $subjectId==$v->subject_id)?"selected":"";
                $subjectList.='<option value="'.$v->subject_id.'" '.$IsSelectedSubject.'>'.$v->subject_name.'</option>';
			  endforeach;	
              $subjectList.='</select>';
			  echo $subjectList;
			  exit;
		
		break;

	}				

endif;		


?>				