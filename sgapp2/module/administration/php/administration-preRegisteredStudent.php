<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');

isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['commentId'])?$commentId=$_GET['commentId']:$commentId='';

#logged in user unique id
$userId=$login_session->get_user_id();
#logged in user Type
$userType=$login_session->get_usertype();


if($id):
  # get student details
  $studentDetails =get_object_by_query('student_pre_registration','student_pre_registration_id="'.$id.'"');
  #authenticate user
  if(!$studentDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('administration-preRegisteredStudent'));
  endif;
endif;

if($commentId):
  # get comment details
  $commentDetails =get_object_by_query('student_pre_registration_comment_history','student_pre_registration_comment_history_id="'.$commentId.'"');
  #authenticate comment
  if(!$commentDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('administration-preRegisteredStudent'));
			Redirect(make_long_url('administration-preRegisteredStudent','comment','comment','id='.$id));
  endif;
endif;

#handle actions here.
switch ($action):
	case'list':
	    #search parameter
		$previousSchoolArray=get_all_record_by_query('student_pre_registration','student_pre_registration_previous_school!="" group by student_pre_registration_previous_school','student_pre_registration_previous_school');
		$locationArray=get_all_record_by_query('student_pre_registration','student_pre_registration_location!=""  group by student_pre_registration_location','student_pre_registration_location');
		$previousSchool=(isset($_REQUEST['previousSchool']) && $_REQUEST['previousSchool']!='')?$_REQUEST['previousSchool']:'';
		$location=(isset($_REQUEST['location']) && $_REQUEST['location']!='')?$_REQUEST['location']:'';
		$where=($previousSchool)?" student_pre_registration_previous_school='".$previousSchool."'":'';
		$where.=($location)?(($where)?" and student_pre_registration_location='".$location."'":" student_pre_registration_location='".$location."'"):'';
		 #fetch class list
         $studentList=get_all_record_by_query('student_pre_registration',$where);
		
		break;
	case'insert':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Register'):
		        # add validations
				$validation=new user_validation();
				$validation->add('student_pre_registration_date', 'req','Date');
				$validation->add('student_pre_registration_dob', 'req','Date of Birth ');
				$validation->add('student_pre_registration_first_name', 'req','student first name');
				$validation->add('student_pre_registration_email', 'email','email id');
				//$validation->add('student_father_phone', 'num','Father Contact No.');		
				# check validations.
				$valid= new valid();
				if($valid->validate($_POST, $validation->get())):
						    $not=array('submit','student_pre_registration_date','student_pre_registration_dob');
							$data=MakeDataArray($_POST, $not);
							$data['student_pre_registration_date']=defaultDatabaseDateFormat($_POST['student_pre_registration_date']);
							$data['student_pre_registration_dob']=defaultDatabaseDateFormat($_POST['student_pre_registration_dob']);
							//print_r($data);exit;
						    insert_record_in_table('student_pre_registration',$data);
							Redirect(make_url('administration-preRegisteredStudent'));
				else:
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('administration-preRegisteredStudent', 'insert', 'insert')); 
				endif;			
		endif;	
		break;
	case'update':
		#update class	
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
		   # add validations
				$validation=new user_validation();
				$validation->add('student_pre_registration_date', 'req','Date');
				$validation->add('student_pre_registration_dob', 'req','Date of Birth ');
				$validation->add('student_pre_registration_first_name', 'req','student first name');
				$validation->add('student_pre_registration_email', 'email','email id');
				# check validations.
				$valid= new valid();
				if($valid->validate($_POST, $validation->get())):
							$not=array('submit','student_pre_registration_date','student_pre_registration_dob');
							$data=MakeDataArray($_POST, $not);
							$data['student_pre_registration_date']=defaultDatabaseDateFormat($_POST['student_pre_registration_date']);
							$data['student_pre_registration_dob']=defaultDatabaseDateFormat($_POST['student_pre_registration_dob']);					
						    $where="student_pre_registration_id='".$id."'";																																																																																			
					        update_record_in_table('student_pre_registration',$where,$data);
							Redirect(make_url('administration-preRegisteredStudent'));
			           
				else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('administration-preRegisteredStudent','update','update','student_id='.$id)); 
				endif;			
		endif;
		break;
	case'comment':
		 #fetch comment history
         $commentHistory=get_all_record_by_query('student_pre_registration_comment_history','student_pre_registration_id='.$id);
		
		break;
	case'insertcomment':
		 if(isset($_POST['submit'])):
		        # add validations
				$validation=new user_validation();
				//$validation->add('student_pre_registration_comment_history_status', 'req','status');
				//$validation->add('student_pre_registration_comment_history_status', 'num','status');
				$validation->add('student_pre_registration_comment', 'req','comment ');		
				# check validations.
				$valid= new valid();
				if($valid->validate($_POST, $validation->get())):
						    $not=array('submit');
							$data=MakeDataArray($_POST, $not);
							$data['user_type']=$userType;
							$data['user_id']=$userId;
							$data['student_pre_registration_id']=$id;
						    insert_record_in_table('student_pre_registration_comment_history',$data);
							Redirect(make_long_url('administration-preRegisteredStudent','comment','comment','id='.$id));
				else:
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('administration-preRegisteredStudent','comment','comment','id='.$id));
				endif;			
		endif;	
		
		break;	
	case'updatecomment':
		 if(isset($_POST['submit'])):
		        # add validations
				$validation=new user_validation();
				//$validation->add('student_pre_registration_comment_history_status', 'req','status');
				//$validation->add('student_pre_registration_comment_history_status', 'num','status');
				$validation->add('student_pre_registration_comment', 'req','comment ');		
				# check validations.
				$valid= new valid();
				if($valid->validate($_POST, $validation->get())):
						    $not=array('submit');
							$data=MakeDataArray($_POST, $not);
							$where="student_pre_registration_comment_history_id='".$commentId."'";																																																																																			
					        update_record_in_table('student_pre_registration_comment_history',$where,$data);
							Redirect(make_long_url('administration-preRegisteredStudent','comment','comment','id='.$id));
				else:
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('administration-preRegisteredStudent','comment','comment','id='.$id));
				endif;			
		endif;	
		
		break;
	case'updateEnquiry':
		#update class	
		if(isset($_POST['submit'])):
		   # add validations
				$validation=new user_validation();
				$validation->add('student_pre_registration_status', 'req','status');
				# check validations.
				$valid= new valid();
				if($valid->validate($_POST, $validation->get())):
							$not=array('submit','student_pre_registration_reminder_date');
							$data=MakeDataArray($_POST, $not);
							$data['student_pre_registration_reminder_date']=defaultDatabaseDateFormat($_POST['student_pre_registration_reminder_date']);				
						    $where="student_pre_registration_id='".$id."'";																																																																																			
					        update_record_in_table('student_pre_registration',$where,$data);
							Redirect(make_long_url('administration-preRegisteredStudent','comment','comment','id='.$id));
			           
				else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('administration-preRegisteredStudent','update','update','student_id='.$id)); 
				endif;			
		endif;
		break;	
	 case'download':
		#download student list
		download_lead_student();
		$filename="studentLeadList".$login_session->get_schoolId().'.csv';
		unlink('download/'.$filename);
	    Redirect(make_url('administration-student'));
		break;
    case'downloadNotSuccess':
		#download student list
		download_lead_student_list_nouSuccess($_SESSION['user_session']['set_lead_student_unsuccessfull_list']);
		$filename="studentLeadListNotSuccess.csv";
		unlink('download/'.$filename);
	    Redirect(make_url('administration-student'));
		break;	
	case'import':
	    if(isset($_POST['submit']) && $_POST['submit']=='Upload'):
		 $fname = $_FILES['download']['name'];
         $chk_ext = explode(".",$fname);
		 $error_status=0;
		 
		   if(strtolower($chk_ext[1]) == "csv")
		     {
		       $filename = $_FILES['download']['tmp_name'];
		       $handle = fopen($filename, "r");
			   $session_id=generateCode(17);
			   set_lead_student_unsuccessfull_list($session_id);
		       $sr=0;
		       while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		       {
		         $sr++;
		         if($sr=='1'):
		           
				   $fields=array('student_pre_registration_date','student_pre_registration_first_name','student_pre_registration_last_name','student_pre_registration_dob','student_pre_registration_email','student_pre_registration_previous_school','student_pre_registration_location','student_pre_registration_how_to_know','student_pre_registration_suggestion','student_pre_registration_attendent','student_pre_registration_father_first_name','student_pre_registration_father_last_name','student_pre_registration_father_occupation','student_pre_registration_father_office_phone','student_pre_registration_father_resi_phone','student_pre_registration_father_mobile','student_pre_registration_mother_first_name','student_pre_registration_mother_last_name','student_pre_registration_mother_occupation','student_pre_registration_mother_office_phone','student_pre_registration_mother_resi_phone','student_pre_registration_mother_mobile');
				   
		         else:
				    if(count($data)==23):
					array_pop($data);
					endif;
				    $combineArray=array_combine($fields,$data);
				    if(checkValidationImportStudentLeadList(array_combine($fields,$data))=='1'):
					
						$data1=array();
						foreach($fields as $k=>$v):
						 if($data[$k]):
						  if($v=='student_pre_registration_date'):
						  $data1[$v]=defaultDatabaseDateFormat($data[$k]);
						  elseif($v=='student_pre_registration_dob'):
						  $data1[$v]=defaultDatabaseDateFormat($data[$k]);
						  else:
						  $data1[$v]=$data[$k];
						  endif;
						 endif;  
						endforeach;
					   insert_record_in_table('student_pre_registration',$data1);
					 else:
					 
					    $error_status=1;
						$errorList=array();
						(checkValidationImportStudentLeadList(array_combine($fields,$data))!=1)?$errorList[]=str_replace(array('<b>','</b>'),array('',''),implode(',',checkValidationImportStudentLeadList(array_combine($fields,$data)))):'';
						
						
					    $data1=array();
						foreach($fields as $k=>$v):
						 if(trim($data[$k])):
						  if($v=='student_pre_registration_date'):
						  $data1[$v]=defaultDatabaseDateFormat($data[$k]);
						  elseif($v=='student_pre_registration_dob'):
						  $data1[$v]=defaultDatabaseDateFormat($data[$k]);
						  else:
						  $data1[$v]=$data[$k];
						  endif;
						 endif;  
						endforeach;
						$data1['student_pre_registration_session_id']=$session_id;
						$data1['student_pre_registration_errorList']=implode(',',$errorList);
					   insert_record_in_table('student_pre_registration_error_records',$data1);
					   
					 endif;  
					 
		         endif;
	           }
		    fclose($handle);
	        }
		  if($error_status==1):
		    Redirect(make_url('administration-preRegisteredStudent'));
		  else:
		    unset_lead_student_unsuccessfull_list();
		    Redirect(make_url('administration-preRegisteredStudent'));
		  endif;
		endif;
		break;							
	case'delete':
		#delete
			delete_record_from_table('student_pre_registration','student_pre_registration_id="'.$id.'"');	
			Redirect(make_url('administration-preRegisteredStudent'));
        break;
	default:break;
endswitch;
?>
