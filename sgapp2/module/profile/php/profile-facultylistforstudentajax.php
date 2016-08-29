<?php 
check_logged_in_for_myaccount('student');
#unique student id
$student_id=$login_session->get_user_id();
#fetch student details
$studentDetails=get_object_by_query('student','student_id='.$student_id);
#school unique id
$school_id=$studentDetails->school_id;
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);
 

$faculty_feedback_anonymous=isset($_POST['faculty_feedback_anonymous'])?$_POST['faculty_feedback_anonymous']:'';
$faculty_feedback_comment=isset($_POST['faculty_feedback_comment'])?$_POST['faculty_feedback_comment']:'0';
$faculty_feedback_id=isset($_POST['faculty_feedback_id'])?$_POST['faculty_feedback_id']:'0';
$faculty_id=isset($_POST['faculty_id'])?$_POST['faculty_id']:'0';
$faculty_feedback_rating=isset($_POST['faculty_feedback_rating'])?$_POST['faculty_feedback_rating']:'0';

if(isset($_POST['mode'])):

	switch($_POST['mode'])
	 {

	
	   case 'addFeedback':
	      
		  # add validations
			$validation=new user_validation();
			$validation->add('faculty_feedback_comment', 'req','feed back');		
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			    $not=array('mode','faculty_feedback_rating');
				$data=$_POST;
				$data['school_id']=$school_id;
				$data['student_id']=$student_id;
				$data['faculty_feedback_ondate']=date('Y-m-d');
				//$data['faculty_feedback_rating']=$faculty_feedback_rating;
				insert_record_in_table('faculty_feedback',$data,$not);
				
				if($faculty_feedback_rating!=0):
				#check this student alrady rate faculty or not
				$checkRating=get_object_by_query('faculty_feedback_rating','school_id="'.$school_id.'" and student_id="'.$student_id.'" and faculty_id="'.$faculty_id.'"');
				if($checkRating):
					$data1['faculty_feedback_rating']=$faculty_feedback_rating;
					$where="faculty_feedback_rating_id='".$checkRating->faculty_feedback_rating_id."'";																																																																																			
					update_record_in_table('faculty_feedback_rating',$where,$data1);
				else:
				    $data1['school_id']=$school_id;
				    $data1['faculty_id']=$faculty_id;
					$data1['student_id']=$student_id;
				    $data1['faculty_feedback_rating_ondate']=date('Y-m-d');
				    $data1['faculty_feedback_rating']=$faculty_feedback_rating;
				    insert_record_in_table('faculty_feedback_rating',$data1);
				
				endif;
				endif;
				
				
				
				
				
				$feedBackList=get_all_record_by_query('faculty_feedback','faculty_id="'.$faculty_id.'" and student_id="'.$student_id.'" order by faculty_feedback_ondate desc,faculty_feedback_id desc');
				foreach($feedBackList as $k=>$v):
					$result.='<div class="slidivbox">';
					$result.='<span style="font-weight:bold;">On Date : '.date('d-m-Y',strtotime($v->faculty_feedback_ondate)).'</span>';
					$result.='<span style="float:right;"><img src="images/cross.png" title="Delete" onclick="deleteFacultyFeedBack('.$v->faculty_id.','.$v->faculty_feedback_id.')"/></span> <br />';
					$result.='<p>'.$v->faculty_feedback_comment.'</p>';
					$result.='</div>';
					
				endforeach;
                   $result.='~!'.facultyRating($faculty_id);
			 else:
				   $result='0~!';
				   foreach($valid->error as $k=>$v):
				   $result.=$v.'<br/>';
				   endforeach;
						
						
			 endif;	
			 echo $result;
	   break;
	   
	    case 'deleteFacultyFeedBack':
	      
		  
		     delete_record_from_table('faculty_feedback','faculty_feedback_id="'.$faculty_feedback_id.'" and student_id="'.$student_id.'"');
		
				$feedBackList=get_all_record_by_query('faculty_feedback','faculty_id="'.$faculty_id.'" and student_id="'.$student_id.'" order by faculty_feedback_ondate desc,faculty_feedback_id desc');
				foreach($feedBackList as $k=>$v):
					$result.='<div class="slidivbox">';
					$result.='<span style="font-weight:bold;">On Date : '.date('d-m-Y',strtotime($v->faculty_feedback_ondate)).'</span>';
					$result.='<span style="float:right;"><img src="images/cross.png" title="Delete" onclick="deleteFacultyFeedBack('.$v->faculty_id.','.$v->faculty_feedback_id.')"/></span> <br />';
					$result.='<p>'.$v->faculty_feedback_comment.'</p>';
					$result.='</div>';
				endforeach;
           
			 echo $result;
	   break;
	   
	   
	   
	  
		
		
		
		

	}				

endif;		


?>				