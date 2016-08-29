<?php 
check_logged_in_for_myaccount('school');
$school_id=$login_session->get_user_id();
$class_name=isset($_POST['class_name'])?$_POST['class_name']:'';
$class_id=isset($_POST['class_id'])?$_POST['class_id']:'0';
$subject_id=isset($_POST['subject_id'])?$_POST['subject_id']:'0';
$faculty_id=isset($_POST['faculty_id'])?$_POST['faculty_id']:'0';
$student_id=isset($_POST['student_id'])?substr($_POST['student_id'], 0,-1):'';
$class_is_active=isset($_POST['class_is_active'])?$_POST['class_is_active']:'0';
$faculty_management_id=isset($_POST['faculty_management_id'])?$_POST['faculty_management_id']:'0';
$faculty_management_is_active=isset($_POST['faculty_management_is_active'])?$_POST['faculty_management_is_active']:'0';
#fetch faculty list
$facultyList=get_all_record_by_query('faculty','school_id="'.$school_id.'" and (faculty_is_active=1 or faculty_is_active=2)');
#fetch subject list
$subjectList=get_all_record_by_query('subject','school_id="'.$school_id.'" and subject_is_active=1');

if(isset($_POST['mode'])):

	switch($_POST['mode'])
	 {
       case 'getFacultyList':
			   $where='';
			   $where.=(isset($_REQUEST['designation']) && $_REQUEST['designation']!='')?'and faculty_designation="'.array_search($_REQUEST['designation'],$fcultyDesignationArray).'"':'';
			   $userList=get_all_record_by_query('faculty','school_id="'.$school_id.'" and (faculty_is_active=1 or faculty_is_active=2)'.$where);
			   $result='<label for="" >Name </label>';
			   $result.='<select id="faculty_id" name="faculty_id" class="form-control">';
					 foreach($userList as $k=>$v):
						$result.='<option value="'.$v->faculty_id.'">'.$v->faculty_first_name.' '.$v->faculty_last_name.'</option>';
					  endforeach;
			   $result.='</select>';   
		       echo $result;
		     exit;
      break;
	
	   case 'editClassDetails':
		  # add validations
			$validation=new user_validation();
			$validation->add('class_name', 'req','class name');		
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered class aleady exist or not
					$checkClass=get_object_by_query('class','class_name="'.$_POST['class_name'].'" and school_id="'.$school_id.'" and class_id!="'.$class_id.'"');
					#if exist
					if($checkClass):
						$result=($checkClass->class_is_active==0)?'0~!Activate Class !! Class already exists ':'0~!Class already exists !! ';
						
					else:
						$not=array('submit','class_id','mode');
						$data=$_POST;
						$where="class_id='".$class_id."' and school_id='".$school_id."'";																																																																																			
						update_record_in_table('class',$where,$data,$not);
						$classDetails=get_object_by_query('class','class_id='.$class_id);
						$result='~!1~!Class details has been updated successfully~!';
					endif;	
			 else:
			           $result='0-';
					   foreach($valid->error as $k=>$v):
					   $result.=$v.'<br/>';
					   endforeach;
						
						
			 endif;	
			 echo $result;
			  exit;
	   break;
	   
	   
	   case 'activeDeativeClass':
	   
	    $data['class_is_active']=$class_is_active;
		update_record_in_table('class',"class_id='".$class_id."' and school_id='".$school_id."'",$data);
		$classDetails=get_object_by_query('class','class_id='.$class_id);
		$result='';
		  if($class_is_active==0):
				       echo $result.='activate';
						
		  else:
		                echo $result.='deactivate';
						
                       
		  endif;
		 exit;
		break;
		
		
		
		
		
		
		 case 'addNewsubjectFacultyInClass':
	   
	         $checkRecordExist=get_object_by_query('faculty_management as a, faculty as b, subject as c','a.faculty_id="'.$faculty_id.'" and a.school_id="'.$school_id.'" and a.class_id="'.$class_id.'" and a.subject_id="'.$subject_id.'" and b.faculty_id=a.faculty_id and c.subject_id=a.subject_id and (b.faculty_is_active=1 or b.faculty_is_active=2) and c.subject_is_active=1');
			if($checkRecordExist):
			    echo ($checkRecordExist->faculty_management_is_active==1)?'This record all ready exist':'This record all ready exist and deactivated.Please activate this';
				exit;
			else:
			
			  # add validations
			$validation=new user_validation();
				
			$validation->add('faculty_id', 'req','faculty');	
			$validation->add('faculty_id', 'num','faculty');	
			$validation->add('subject_id', 'req','subject');	
			$validation->add('subject_id', 'num','subject');		
					
			# check validations.
			$valid= new valid();
			if(!$valid->validate($_POST, $validation->get())):
			           $result='';
					   foreach($valid->error as $k=>$v):
					   $result.=$v.'<br/>';
					   endforeach;
					   echo $result;
			           exit;
			endif;
			 
				$not=array('mode','student_id');
				$data=$_POST;
				$data['school_id']=$school_id;
				if(insert_record_in_table('faculty_management',$data,$not)):
				$maxid=get_object_by_query('faculty_management','','Max(faculty_management_id) as id')->id;
				      if($student_id):
					    $student_id=explode(',',$student_id);
						foreach($student_id as $studentk=>$studentv):
							$data1['faculty_management_id']=$maxid;
							$data1['student_id']=$studentv;
							insert_record_in_table('student_subject',$data1);
						endforeach;
					  endif;	
				endif;
			endif;
			
		 exit;
		break;
		
		
		 case 'activeDeativeFacultyManagement':
	   
	    $data['faculty_management_is_active']=$faculty_management_is_active;
		update_record_in_table('faculty_management',"faculty_management_id='".$faculty_management_id."' and school_id='".$school_id."'",$data);
		
		 exit;
		break;

	}				

endif;		


?>				