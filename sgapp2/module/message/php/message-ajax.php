<?php 
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');
$userId=$login_session->get_user_id();
$user_type=($_REQUEST['user_type'])?$_REQUEST['user_type']:$userTypeArray['0'];
$message_subject_id=($_REQUEST['message_subject_id'])?$_REQUEST['message_subject_id']:'';
$p=isset($_POST['p'])?$_POST['p']:'1';



if(isset($_POST['mode'])):

	switch($_POST['mode'])
	 {
	  case 'getUserList':
	       if($_REQUEST['designation']==''):
		       $result='<label for="" >Name</label>';
		       $result.='<select class="form-control">';
			   $result.='<option value="">--select value--</option>';
			   $result.='</select>';
		   
	       elseif($login_session->get_usertype()==$userTypeArray[2] && isset($_REQUEST['designation']) && $_REQUEST['designation']=='teacher'):
		       $facultyList=get_all_record_by_query('faculty_management as a ,subject as b,faculty as c','a.class_id="'.$studentDetail->class_id.'" and a.school_id="'.$school_id.'" and b.subject_id=a.subject_id and c.faculty_id=a.faculty_id and b.subject_is_active=1 and c.faculty_is_active!=0 group by a.faculty_id');
			   $result='<label for="" >Name<span class="symbol required"></span></label>';
			   $result.='<select id="message_subject_receiver_id" name="message_subject_receiver_id" class="form-control" required>';
					 foreach($facultyList as $k=>$v):
						$result.='<option value="'.$v->faculty_id.'">'.$v->faculty_first_name.' '.$v->faculty_last_name.'</option>';
					  endforeach;
			   $result.='</select>';
		   else:
			   $user_id_field=$user_type.'_id';
			   $where='';
			   $where.=(isset($_REQUEST['designation']) && $_REQUEST['designation']!='')?'and faculty_designation="'.array_search($_REQUEST['designation'],$fcultyDesignationArray).'"':'';
				$where.=(isset($_REQUEST['class']) && $_REQUEST['class']!='')?'and class_id="'.$_REQUEST['class'].'"':'';
			   $userList=get_all_record_by_query($user_type,'school_id="'.$school_id.'" and '.$user_type.'_is_active!=0 '.$where);
			   $result='<label for="" >Name<span class="symbol required"></span></label>';
			   $result.='<select id="message_subject_receiver_id" name="message_subject_receiver_id" class="form-control" required>';
					 foreach($userList as $k=>$v):
						$userInfo=getUserInfo($user_type,$v->$user_id_field);
						$result.='<option value="'.$v->$user_id_field.'">'.$userInfo['name'].'</option>';
					  endforeach;
			   $result.='</select>';
			endif;   
		   echo $result;
		   exit;
		    
      break;
	  case 'getStudentList':
			   $user_id_field=$user_type.'_id';
			   $where='';
			   $where.=(isset($_REQUEST['class']) && $_REQUEST['class']!='')?'and class_id="'.$_REQUEST['class'].'"':'';
			   if($where):
				   $userList=get_all_record_by_query($user_type,'school_id="'.$school_id.'" and '.$user_type.'_is_active!=0 '.$where);
				   $result='<label for="" >Name<span class="symbol required"></span></label>';
				   $result.='<select id="message_subject_receiver_id" name="message_subject_receiver_id" class="form-control" required>';
						 foreach($userList as $k=>$v):
							$userInfo=getUserInfo($user_type,$v->$user_id_field);
							$result.='<option value="'.$v->$user_id_field.'">'.$userInfo['name'].'</option>';
						  endforeach;
				   $result.='</select>';
			   else:
			      $result='<label for="" >Name<span class="symbol required"></span></label>';
			      $result.='<select class="form-control" required>';
				  $result.='<option></option>';
				  $result.='</select>';
			   endif;
		       echo $result;
		       exit; 
      break;
	  case 'sendMessage':
	       # add validations
			$validation=new user_validation();	
			$validation->add('message', 'req','message');			
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
						# enter message  details
						$not=array('page','mode');
						$data=$_POST;
						$data['school_id']=$school_id;
						$data['message_sender_type']=$userType;
						$data['message_sender_id']=$login_session->get_user_id();
						insert_record_in_table('message',$data,$not);
						$result.='<div class="my-message">';
                        $result.='<p>'.$_POST['message'].'</p>';
                        $result.='</div>';
						echo $result;
						exit;
			 endif;			
	  break;
	  case 'deleteMessagesubject':
	       #fecth message detail
	       $messageSubjectDetail=get_object_by_query('message_subject','school_id="'.$school_id.'" and message_subject_id="'.$message_subject_id.'" and ((message_subject_sender_type="'.$userType.'" and message_subject_sender_id="'.$userId.'") or (message_subject_receiver_type="'.$userType.'" and message_subject_receiver_id="'.$userId.'"))');
		    if($messageSubjectDetail->message_subject_receiver_type==$userType && $messageSubjectDetail->message_subject_receiver_id==$userId && $messageSubjectDetail->message_subject_sender_type==$userType && $messageSubjectDetail->message_subject_sender_id==$userId):
		     
			      if(delete_record_from_table('message_subject',"message_subject_id='".$message_subject_id."' and school_id='".$school_id."'")):
		            echo '11';
		          endif;
			 
		   elseif($messageSubjectDetail->message_subject_receiver_type==$userType && $messageSubjectDetail->message_subject_receiver_id==$userId):
		      if($messageSubjectDetail->message_subject_sender_status==0):
			      if(delete_record_from_table('message_subject',"message_subject_id='".$message_subject_id."' and school_id='".$school_id."'")):
		            echo '11';
		          endif;
			  else:
			      if(update_record_in_table('message_subject',"message_subject_id='".$message_subject_id."'",array('message_subject_receiver_status'=>0))):
				    echo '2';
				  endif;	  
			  endif;
		   else:
		      if($messageSubjectDetail->message_subject_receiver_status==0):
			      if(delete_record_from_table('message_subject',"message_subject_id='".$message_subject_id."' and school_id='".$school_id."'")):
		            echo '1';
		          endif;
			  else:
			      if(update_record_in_table('message_subject',"message_subject_id='".$message_subject_id."'",array('message_subject_sender_status'=>0))):
				    echo '2';
				  endif;	  
			  endif;
		   
		   endif;
		  exit;
	  break;	  
	}				

endif;		


?>	
		