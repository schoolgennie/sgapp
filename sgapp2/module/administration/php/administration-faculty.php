<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['faculty_id'])?$faculty_id=$_GET['faculty_id']:$faculty_id='0';


#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

if($faculty_id):
  # get faculty details
  $facultyDetails =get_object_by_query('faculty','faculty_id="'.$faculty_id.'" and school_id="'.$school_id.'"');
  #authenticate user
  if(!$facultyDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('administration-faculty'));
  endif;
endif;

#handle actions here.
switch ($action):
	case'list':
		#fetch class list
         $facultyList=get_all_record_by_query('faculty','school_id="'.$school_id.'" order by faculty_is_active desc');
		break;
	case'insert':
	     # add class
		if(isset($_POST['validate']) && $_POST['validate']=='Register'):
		        # add validations
				$validation=new user_validation();
				$validation->add('faculty_user_id', 'req','user id');	
				$validation->add('faculty_first_name', 'req','first name');
				$validation->add('faculty_last_name', 'req','last name');	
				$validation->add('faculty_email_id', 'email','Email Official');
				$validation->add('faculty_email_personal', 'email','Email Personal');
				$validation->add('faculty_mobile', 'req','Mobile No');	
				$validation->add('faculty_mobile', 'num','Mobile No');
				$validation->add('faculty_contact', 'num','Phone No');
				$validation->add('faculty_gender', 'req','gender');	
				$validation->add('faculty_dob', 'req','date of birth');
				$validation->add('faculty_designation', 'req','designation');
						
				# check validations.
				$valid= new valid();
				if($valid->validate($_POST, $validation->get())):
					#check entered email id aleady exist or not
					$checkEmailId=get_object_by_query('faculty','faculty_user_id="'.$_POST['faculty_user_id'].'" and school_id="'.$school_id.'"');
					#if exist
					if($checkEmailId):
							$login_session->pass_msg[]='Entered user id already exist';
							$login_session->set_pass_msg();
							$login_session->set_success();
							Redirect(make_long_url('administration-faculty','insert','insert'));
					else:
						    $password=generateCode(9);
							$not=array('validate');
						    $data=$_POST;
						    $data['school_id']=$school_id;
							$data['password']=$password;
						    insert_record_in_table('faculty',$data,$not);
							Redirect(make_url('administration-faculty'));
					endif;
				else:
					      	$login_session->pass_msg=$valid->error;
						    $login_session->set_pass_msg();
						    Redirect(make_long_url('administration-faculty', 'insert', 'insert')); 
				endif;		
			
		endif;	
		break;
	case'update':
		#update class	
		if(isset($_POST['validate']) && $_POST['validate']=='Update'):
		        # add validations
				$validation=new user_validation();
				$validation->add('faculty_user_id', 'req','user id');	
				$validation->add('faculty_first_name', 'req','first name');
				$validation->add('faculty_last_name', 'req','last name');
				$validation->add('faculty_email_id', 'email','Email Official');
				$validation->add('faculty_email_personal', 'email','Email Personal');
				$validation->add('faculty_mobile', 'req','Mobile No');	
				$validation->add('faculty_mobile', 'num','Mobile No');
				$validation->add('faculty_contact', 'num','Phone No');
				$validation->add('faculty_gender', 'req','gender');	
				$validation->add('faculty_dob', 'req','date of birth');
				$validation->add('faculty_designation', 'req','designation');
						
				# check validations.
				$valid= new valid();
				if($valid->validate($_POST, $validation->get())):
						#check entered email id aleady exist or not
						$checkEmailId=get_object_by_query('faculty','faculty_user_id="'.$_POST['faculty_user_id'].'" and school_id="'.$school_id.'" and faculty_id!="'.$faculty_id.'"');
						#if exist
						if($checkEmailId):
							$login_session->pass_msg[]='You can\'t update faculty user id.Entered user id already exist';
							$login_session->set_pass_msg();
							$login_session->set_success();
							Redirect(make_long_url('administration-faculty','update','update','faculty_id='.$faculty_id));
						else:
			  				$not=array('validate');
							$data=$_POST;
						    $where="faculty_id='".$faculty_id."' and school_id='".$school_id."'";																																																																																			
					        update_record_in_table('faculty',$where,$data,$not);
							Redirect(make_url('administration-faculty'));
						endif;
			    else:
					$login_session->pass_msg=$valid->error;
		            $login_session->set_pass_msg();
		            Redirect(make_long_url('administration-faculty','update','update','faculty_id='.$faculty_id));
	            endif;	
		endif;
		break;
	case'sendEmail':	
	      if(isset($_POST['submit']) && $_POST['submit']=='Activate New Account'):
	         if(isset($_POST['sendmail']) && count($_POST['sendmail'])>0):
			    foreach($_POST['sendmail'] as $k=>$v):
				            $data['faculty_is_active']=1;
				            $where="faculty_id='".$v."'";																																																																																			
					        update_record_in_table('faculty',$where,$data);
				            $userDetails=get_object_by_query('faculty','faculty_id="'.$v.'" and faculty_is_active=1');
				            $Name=$userDetails->faculty_first_name.' '.$userDetails->faculty_last_name;
				            $UserId=$userDetails->faculty_user_id;
							$email=$userDetails->faculty_email_id;
							$Password=$userDetails->password;
							#if email id exist send login details
							if($email):
							  include(DIR_FS_SITE_INCLUDE_EMAIL.'newRegistrationLogindetails.php');
                              SendEmail(SITE_NAME.' Login Details ', $email , ADMIN_EMAIL, SITE_NAME, $contents,'','html');
							endif;   
				endforeach;
			 endif;
			 Redirect(make_url('administration-faculty'));
			 exit;
		  endif;	 
	    break;	
	case'reset':	
	        $password=generateCode(9);
			$data['password']=$password;
			$data['change_password_status']=0;
			update_record_in_table('faculty',"faculty_id='".$faculty_id."'",$data);
			 
				$Name=$facultyDetails->faculty_first_name.' '.$facultyDetails->faculty_last_name;
				$UserId=$facultyDetails->faculty_user_id;
				$email=$facultyDetails->faculty_email_id;
				$Password=$password;
				#if email id exist send login details
				if($email):
				include(DIR_FS_SITE_INCLUDE_EMAIL.'newRegistrationLogindetails.php');
				SendEmail(SITE_NAME.' Login Details ', $email , ADMIN_EMAIL, SITE_NAME, $contents,'','html');
				endif;
			Redirect(make_url('administration-faculty'));
	    break;		
	case'manage':
		#manage teacher classes and subject	
		    #fetch data from faculty management
		    $facultyManagementList=get_all_record_by_query('faculty_management as a, class as b, subject as c','a.faculty_id="'.$faculty_id.'" and a.school_id="'.$school_id.'" and b.class_id=a.class_id and c.subject_id=a.subject_id and b.class_is_active=1 and c.subject_is_active=1 order by faculty_management_is_active desc');
			#fetch class list
		    $classList=get_all_record_by_query('class','school_id="'.$school_id.'" and class_is_active=1');
			#fetch subject list
		    $subjectList=get_all_record_by_query('subject','school_id="'.$school_id.'" and subject_is_active=1');
			#fetch incharge call
			$inchargeClass=get_object_by_query('class_incharge as a, class as b','a.faculty_id="'.$faculty_id.'"  and a.school_id="'.$school_id.'" and b.class_id=a.class_id and b.class_is_active=1');
		
		break;	
	
	case'delete':
		#deactivate faculty
		$data['faculty_account_delete']=1;
		update_record_in_table('faculty',"faculty_id='".$faculty_id."' and school_id='".$school_id."'",$data);
		$login_session->pass_msg[]='This faculty has been deleted successfully.';
	    $login_session->set_pass_msg();
	    $login_session->set_success();
	    Redirect(make_url('administration-faculty'));
		break;
		
	case'deactivate':
		#deactivate faculty
		$data['faculty_is_active']=0;
		update_record_in_table('faculty',"faculty_id='".$faculty_id."' and school_id='".$school_id."'",$data);
	    Redirect(make_url('administration-faculty'));
		break;

	case'activate':
		#activate faculty
		$data['faculty_is_active']=1;
		update_record_in_table('faculty',"faculty_id='".$faculty_id."' and school_id='".$school_id."'",$data);
		Redirect(make_url('administration-faculty'));
		break;	
	case'download':
		#download faculty list
		download_faculty();
	    Redirect(make_url('administration-faculty'));
		exit;
		break;
    case'downloadNotSuccess':
		#download faculty list
		download_faculty_list_nouSuccess($_SESSION['user_session']['set_faculty_unsuccessfull_list_session_id']);
		Redirect(make_url('administration-faculty'));
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
			   set_faculty_unsuccessfull_list($session_id);
		       $sr=0;
		       while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		       {
		         $sr++;
		         if($sr=='1'):
		           
				   $fields=array('faculty_user_id','faculty_first_name','faculty_last_name','faculty_mobile','faculty_dob','faculty_gender','faculty_designation','faculty_email_id','faculty_email_personal','faculty_contact','faculty_employee_id','faculty_bachelors','faculty_highest_qualification','faculty_years_of_experience','faculty_with_school_since','faculty_previous_school','faculty_address');

		         else:
				    if(count($data)==18):
					array_pop($data);
					endif;
				    $combineArray=array_combine($fields,$data);
					
				    if(checkValidationImportFacultyList(array_combine($fields,$data))=='1' && checkUserIdExistImportFacultyList($combineArray['faculty_user_id'])==1 &&  checkDesignationExistImportFacultyList($combineArray['faculty_designation'])==1 && checkEmployeeIDExistImportFacultytList($combineArray['faculty_employee_id'])==1):
					
						$data1=array();
						foreach($fields as $k=>$v):
						 if($data[$k]):
						  $data1[$v]=$data[$k];
						 endif;  
						endforeach;
						$data1['school_id']=$school_id;
						$data1['password']=generateCode(9);
					     insert_record_in_table('faculty',$data1);
					 else:
					 
					    $error_status=1;
						$errorList=array();
						(checkValidationImportFacultyList(array_combine($fields,$data))!=1)?$errorList[]=str_replace(array('<b>','</b>'),array('',''),implode(',',checkValidationImportFacultyList(array_combine($fields,$data)))):'';
						(checkUserIdExistImportFacultyList($combineArray['faculty_user_id'])!=1)?$errorList[]=checkUserIdExistImportFacultyList($combineArray['faculty_user_id']):'';
						(checkDesignationExistImportFacultyList($combineArray['faculty_designation'])!=1)?$errorList[]=checkDesignationExistImportFacultyList($combineArray['faculty_designation']):'';
						(checkEmployeeIDExistImportFacultytList($combineArray['faculty_employee_id'])!=1)?$errorList[]=checkEmployeeIDExistImportFacultytList($combineArray['faculty_employee_id']):'';
						
					    $data1=array();
						foreach($fields as $k=>$v):
						 if(trim($data[$k])):
						  $data1[$v]=$data[$k];
						 endif;  
						endforeach;
						
						$data1['session_id']=$session_id;
						$data1['errorList']=implode(',',$errorList);
						
					   insert_record_in_table('faculty_error_records',$data1);
					   
					 endif;  
					 
		         endif;
	           }
		    fclose($handle);
	        }
		  if($error_status==1):
		    Redirect(make_url('administration-faculty'));
		  else:
		    unset_faculty_unsuccessfull_list();
		    Redirect(make_url('administration-faculty'));
		  endif;
		endif;
		break;							
 
	default:break;
endswitch;
?>
