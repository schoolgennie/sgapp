<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');

isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['student_id'])?$student_id=$_GET['student_id']:$student_id='0';
isset($_GET['p'])?$p=$_GET['p']:$p='1';
isset($_GET['preRegisterId'])?$preRegisterId=$_GET['preRegisterId']:$preRegisterId='';


#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

#count no of student account
$totalStudent=get_object_by_query_count('student','school_id="'.$school_id.'"');

#fetch class list
$classList=get_all_record_by_query('class','school_id="'.$school_id.'" and class_is_active=1 order by class_position');

if($student_id):
  # get student details
  $studentDetails =get_object_by_query('student','student_id="'.$student_id.'" and school_id="'.$school_id.'"');
  if($studentDetails):
     $studentSiblingDetails=get_all_record_by_query('student_sibling','student_id="'.$student_id.'"');
	  $subjectList=get_all_record_by_query('faculty_management as a ,subject as b,class as c,faculty as d','a.class_id="'.$studentDetails->class_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and d.faculty_id=a.faculty_id and b.subject_is_active=1 and c.class_is_active=1 and d.faculty_is_active=1 and a.faculty_management_is_active=1');
	  $studentSubjectList=get_all_record_by_query('student_subject','student_id='.$student_id,'faculty_management_id');
	  $studentSubjectListArray=array();
	  foreach($studentSubjectList as $k=>$v):
	    $studentSubjectListArray[]=$v->faculty_management_id;
	  endforeach;
  endif;
  #authenticate user
  if(!$studentDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('administration-student'));
  endif;
endif;



if($preRegisterId):
  # get pre registered student details
  $preRegisterStudentDetails=get_object_by_query('student_pre_registration','student_pre_registration_id="'.$preRegisterId.'"');
  #authenticate user
  if(!$preRegisterStudentDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('administration-preRegisteredStudent'));
  endif;
endif;

#handle actions here.
switch ($action):
	case'list':
		#search parameter
		$keyword=(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')?$_REQUEST['keyword']:'';
		$class=(isset($_REQUEST['class']) && $_REQUEST['class']!='')?$_REQUEST['class']:'';
		$where=($class)?" and class_id='".$class."'":'';
		$where.=($keyword)?" and (student_first_name LIKE '%".$_REQUEST['keyword']."%' or student_last_name LIKE '%".$_REQUEST['keyword']."%' or student_email_id LIKE '%".$_REQUEST['keyword']."%')":'';
		$qstring=($keyword)?'keyword='.$keyword:'';
		 #fetch class list
         $studentList=get_all_object_by_query('student','school_id="'.$school_id.'"'.$where.'  order by student_is_active desc');
		 #fetch class list
         $studentErrorList=get_all_record_by_query('student_error_records','school_id="'.$school_id.'"');
		break;
	case'insert':
	
	     if($totalStudent>=$schoolDetail->school_student_create_limit):
		 Redirect(make_url('administration-student'));
		 endif;
		 
		 
	     # add class
		if(isset($_POST['validate']) && $_POST['validate']=='Register'):
		
		        # add validations
				$validation=new user_validation();
				$validation->add('student_user_id', 'req','user id');
				$validation->add('student_first_name', 'req','first name');
				$validation->add('student_email_id', 'email','prefered email id');
				$validation->add('class_id', 'req','class');
				$validation->add('student_contact', 'num','Prefered Contact No.');	
				$validation->add('student_contact', 'fixlength','Prefered Contact No.','10');
				$validation->add('student_zip', 'num','zip');
				$validation->add('student_zip', 'fixlength','zip','6');	
				$validation->add('student_father_phone', 'num','Father Contact No.');
				$validation->add('student_mother_phone', 'num','Mother Contact No.');
					
									
				# check validations.
				$valid= new valid();
				if($valid->validate($_POST, $validation->get())):
			
						#check entered user id aleady exist or not
						$checkUserId=get_object_by_query('student','student_user_id="'.$_POST['student_user_id'].'"');
						#if exist
						if($checkUserId):
							$login_session->pass_msg[]='Entered user id already exist';
							$login_session->set_pass_msg();
							$login_session->set_success();
							Redirect(make_long_url('administration-student','insert','insert',($preRegisterId)?'preRegisterId='.$preRegisterId:''));
							exit;
						endif;
						#check entered admission_no aleady exist or not
						if($_POST['student_admission_no']):
							$checkAdmissionNo=get_object_by_query('student','student_admission_no="'.$_POST['student_admission_no'].'"');
							#if exist
							if($checkAdmissionNo):
								$login_session->pass_msg[]='Entered student admission no already exist';
								$login_session->set_pass_msg();
								$login_session->set_success();
								Redirect(make_long_url('administration-student','insert','insert',($preRegisterId)?'preRegisterId='.$preRegisterId:''));
								exit;
							endif;
						endif;	
						#check entered student roll number aleady exist or not
						if($_POST['student_roll_number']):
							$checkRollNo=get_object_by_query('student','student_roll_number="'.$_POST['student_roll_number'].'"');
							#if exist
							if($checkRollNo):
								$login_session->pass_msg[]='Entered roll number already exist';
								$login_session->set_pass_msg();
								$login_session->set_success();
								Redirect(make_long_url('administration-student','insert','insert',($preRegisterId)?'preRegisterId='.$preRegisterId:''));
								exit;
							endif;
						endif;	
						
						
						
						    $password=generateCode(9);
						    $not=array('validate','student_sibling_name','student_sibling_age','student_sibling_gender','faculty_management_id');
						    $data=$_POST;
						    $data['school_id']=$school_id;
							$data['password']=$password;
						    if(insert_record_in_table('student',$data,$not)):
							  $maxid=get_object_by_query('student','','Max(student_id) as id')->id;
							

							  #update pre register student status
							  if($preRegisterId):																																																																																		
								update_record_in_table('student_pre_registration',"student_pre_registration_id='".$preRegisterId."'",array('student_pre_registration_status'=>1));
							  endif;

							  # create subject list
							  foreach($_POST['faculty_management_id'] as $k=>$v):
							    $data2['student_id']=$maxid;
							    $data2['faculty_management_id']=$v;
							    insert_record_in_table('student_subject',$data2);
						      endforeach;
                              
							  #create fee structure
							  $feeStructuretList=get_all_record_by_query('fee_structure as a,fee_category as b,fee_collection_type as c','a.class_id="'.$_POST['class_id'].'" and b.fee_category_id=a.fee_category_id and c.fee_collection_type_id=a.fee_collection_type_id');
							  if($feeStructuretList):
								foreach($feeStructuretList as $kFeeStructure=>$vFeeStructure):
								  $data3['fee_structure_id']=$vFeeStructure->fee_structure_id;
								  $data3['student_id']=$maxid;
								  insert_record_in_table('fee_collection_management',$data3);
								endforeach;
							  endif;
							  
							  	
							endif;
							Redirect(make_url('administration-student','feeCollection','feeCollection','student_id='.$maxid));
						
				else:
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('administration-student', 'insert', 'insert',($preRegisterId)?'preRegisterId='.$preRegisterId:'')); 
				endif;			
			
		endif;	
		break;
	case'update':
		#update class	
		if(isset($_POST['validate']) && $_POST['validate']=='Update'):
		   # add validations
				$validation=new user_validation();
				$validation->add('student_user_id', 'req','user id');	
				$validation->add('student_first_name', 'req','first name');
				$validation->add('student_email_id', 'email','prefered email id');
				$validation->add('class_id', 'req','class');	
				$validation->add('student_contact', 'num','Prefered Contact No.');	
				$validation->add('student_contact', 'fixlength','Prefered Contact No.','10');
				$validation->add('student_zip', 'num','zip');
				$validation->add('student_zip', 'fixlength','zip','6');
				$validation->add('student_father_phone', 'num','Father Contact No.');
				$validation->add('student_mother_phone', 'num','Mother Contact No.');
				
									
				# check validations.
				$valid= new valid();
				if($valid->validate($_POST, $validation->get())):
						#check entered user id aleady exist or not
						$checkUserId=get_object_by_query('student','student_user_id="'.$_POST['student_user_id'].'"  and student_id!="'.$student_id.'"');
						#if exist
						if($checkUserId):
							$login_session->pass_msg[]='You can\'t update student user id.Entered user id already exist';
							$login_session->set_pass_msg();
							$login_session->set_success();
							Redirect(make_long_url('administration-student','update','update','student_id='.$student_id));
							exit;
						endif;
						#check entered admission_no aleady exist or not
						if($_POST['student_admission_no']):
							$checkAdmissionNo=get_object_by_query('student','student_admission_no="'.$_POST['student_admission_no'].'"  and student_id!="'.$student_id.'"');
							#if exist
							if($checkAdmissionNo):
								$login_session->pass_msg[]='Entered student admission no already exist';
								$login_session->set_pass_msg();
								$login_session->set_success();
								Redirect(make_long_url('administration-student','update','update','student_id='.$student_id));
								exit;
							endif;
						endif;	
						#check entered student roll number aleady exist or not
						if($_POST['student_roll_number']):
							$checkRollNo=get_object_by_query('student','student_roll_number="'.$_POST['student_roll_number'].'"  and student_id!="'.$student_id.'"');
							#if exist
							if($checkRollNo):
								$login_session->pass_msg[]='Entered roll number already exist';
								$login_session->set_pass_msg();
								$login_session->set_success();
								Redirect(make_long_url('administration-student','update','update','student_id='.$student_id));
								exit;
							endif;
						 endif;	
						
						
						
						    $not=array('validate','student_sibling_name','student_sibling_age','student_sibling_gender','student_sibling_id','faculty_management_id');
							$data=$_POST;
						    $where="student_id='".$student_id."'";																																																																																			
					        if(update_record_in_table('student',$where,$data,$not)):
							   
								
								#update student subject
								delete_record_from_table('student_subject','student_id="'.$student_id.'"');	
								foreach($_POST['faculty_management_id'] as $k=>$v):
										$data2['student_id']=$student_id;
										$data2['faculty_management_id']=$v;
										insert_record_in_table('student_subject',$data2);
						        endforeach;
							endif;
							
							Redirect(make_url('administration-student'));
			            
				else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('administration-student','update','update','student_id='.$student_id)); 
				endif;			
		endif;
		break;
	case 'feeCollection':
	     #fetch fee collection type list
		 $class=$studentDetails->class_id;
         $feeCollectionTypetList=get_all_record_by_query('fee_collection_type as a,fee_structure as b','b.fee_collection_type_id=a.fee_collection_type_id and b.class_id='.$class.' group by a.fee_collection_type_id'); 
		 if(isset($_POST['submit']) && $_POST['submit']=='Save'):
		    delete_record_from_table('fee_collection_management','student_id="'.$student_id.'"');	
		 	foreach($_POST['fee_structure_id'] as $k=>$v):
							$data1['fee_structure_id']=$v;
							$data1['student_id']=$_POST['student_id'];
							insert_record_in_table('fee_collection_management',$data1);
			endforeach;
			Redirect(make_url('administration-student')); 
		endif;
	    break;	
	case'sendEmail':	
	      if(isset($_POST['submit']) && $_POST['submit']=='Activate New Account'):
	         if(isset($_POST['sendmail']) && count($_POST['sendmail'])>0):
			    foreach($_POST['sendmail'] as $k=>$v):
				            $data['student_is_active']=1;
				            $where="student_id='".$v."'";																																																																																			
					        update_record_in_table('student',$where,$data);
				            $userDetails=get_object_by_query('student','student_id="'.$v.'"');
				            $Name=$userDetails->student_first_name.' '.$userDetails->student_last_name;
				            $UserId=$userDetails->student_user_id;
							$email=$userDetails->student_email_id;
							$Password=$userDetails->password;
							# if email id exist send login details
							if($email):
				            include(DIR_FS_SITE_INCLUDE_EMAIL.'newRegistrationLogindetails.php');
                            SendEmail(SITE_NAME.' Login Details ', $email , ADMIN_EMAIL, SITE_NAME, $contents,'','html');
							endif;
				endforeach;
			 endif;
			 Redirect(make_url('administration-student'));
			 exit;
		  endif;	 
	    break;
	case'reset':	
	        $password=generateCode(9);
			$data['password']=$password;
			$data['change_password_status']=0;
			update_record_in_table('student',"student_id='".$student_id."'",$data);
			 
				$Name=$studentDetails->student_first_name.' '.$studentDetails->student_last_name;
				$UserId=$studentDetails->student_user_id;
				$email=$studentDetails->student_email_id;
				$Password=$password;
				# if email id exist send login details
				if($email):
				include(DIR_FS_SITE_INCLUDE_EMAIL.'newRegistrationLogindetails.php');
				SendEmail(SITE_NAME.' Login Details ', $email , ADMIN_EMAIL, SITE_NAME, $contents,'','html');
				endif;
			Redirect(make_url('administration-student'));
	    break;	
	
	case'delete':
		#deactivate student
		$data['student_account_delete']=1;
		update_record_in_table('student',"student_id='".$student_id."' and school_id='".$school_id."'",$data);
		$login_session->pass_msg[]='This student has been deleted successfully.';
	    $login_session->set_pass_msg();
	    $login_session->set_success();
	    Redirect(make_url('administration-student'));
		break;
		
		
	case'deactivate':
		#deactivate student
		$data['student_is_active']=0;
		update_record_in_table('student',"student_id='".$student_id."' and school_id='".$school_id."'",$data);
	    Redirect(make_url('administration-student'));
		break;
		
		
	case'activate':
		#activate student
		$data['student_is_active']=1;
		update_record_in_table('student',"student_id='".$student_id."' and school_id='".$school_id."'",$data);
		Redirect(make_url('administration-student'));
		break;	
   case'download':
   try
{   
    // create an API client instance
    $client = new Pdfcrowd("username", "apikey");

    // convert a web page and store the generated PDF into a $pdf variable
    //$pdf = $client->convertURI('http://www.google.com/');
    // $pdf = $client->convertHtml("<head></head><body>My HTML Layout</body>");
	  //$pdf = $client->convertFile("/path/to/MyLayout.html");
	  $out_file = fopen("document.pdf", "wb");
    $client->convertHtml("<head></head><body>My HTML Layout</body>", $out_file);
    fclose($out_file);
    // set HTTP response headers
    header("Content-Type: application/pdf");
    header("Cache-Control: max-age=0");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"google_com.pdf\"");

    // send the generated PDF 
    echo $pdf;
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}

exit;
		#download student list
		//download_student();
		//$filename="studentList".$login_session->get_schoolId().'.csv';
		//unlink('download/'.$filename);
	    Redirect(make_url('administration-student'));
		break;
    case'downloadNotSuccess':
		#download student list
		download_student_list_nouSuccess($_SESSION['user_session']['set_student_unsuccessfull_list']);
		$filename="studentListNotSuccess.csv";
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
			   set_student_unsuccessfull_list($session_id);
		       $sr=0;
		       while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		       {
		         $sr++;
		         if($sr=='1'):
		           
				  // $fields=array('student_user_id','student_first_name','student_last_name','student_gender','student_dob','student_contact','student_country','student_state','student_city','class_id','student_email_id','student_father_first_name','student_father_last_name','student_father_organization','student_mother_first_name','student_mother_last_name','student_mother_organization','student_father_phone','student_father_email_id','student_mother_phone','student_mother_email_id','student_zip','student_from','student_to','student_transport_type','student_nationality','student_address','student_admission_no','student_roll_number','student_with_school_since','student_emergency_contact_person_name','student_emergency_contact_person_relation','student_emergency_contact_person_mobile');
				   
				   $fields=array('student_user_id','class_id','student_first_name','student_last_name','student_dob','student_gender','student_contact','student_email_id','student_admission_no','student_roll_number','student_transport_type','student_nationality','student_with_school_since','student_country','student_state','student_city','student_zip','student_address','student_father_first_name','student_father_last_name','student_father_organization','student_father_phone','student_mother_first_name','student_mother_last_name','student_mother_organization','student_mother_phone','student_emergency_contact_person_name','student_emergency_contact_person_relation','student_emergency_contact_person_mobile');
				   
		         else:
				    if(count($data)==30):
					array_pop($data);
					endif;
				    $combineArray=array_combine($fields,$data);
				    if(checkValidationImportStudentList(array_combine($fields,$data))=='1' && checkUserIdExistImportStudentList($combineArray['student_user_id'])==1 &&  checkClassExistImportStudentList($combineArray['class_id'])==1 && checkAdmissionNoExistImportStudentList($combineArray['student_admission_no'])==1):
					
						$data1=array();
						foreach($fields as $k=>$v):
						 if($data[$k]):
						  $data1[$v]=$data[$k];
						 endif;  
						endforeach;
						$data1['school_id']=$school_id;
						$data1['password']=generateCode(9);
					   insert_record_in_table('student',$data1);
					 else:
					 
					    $error_status=1;
						$errorList=array();
						(checkValidationImportStudentList(array_combine($fields,$data))!=1)?$errorList[]=str_replace(array('<b>','</b>'),array('',''),implode(',',checkValidationImportStudentList(array_combine($fields,$data)))):'';
						(checkUserIdExistImportStudentList($combineArray['student_user_id'])!=1)?$errorList[]=checkUserIdExistImportStudentList($combineArray['student_user_id']):'';
						(checkClassExistImportStudentList($combineArray['class_id'])!=1)?$errorList[]=checkClassExistImportStudentList($combineArray['class_id']):'';
						(checkAdmissionNoExistImportStudentList($combineArray['student_admission_no'])!=1)?$errorList[]=checkAdmissionNoExistImportStudentList($combineArray['student_admission_no']):'';
						
					    $data1=array();
						foreach($fields as $k=>$v):
						 if(trim($data[$k])):
						  $data1[$v]=$data[$k];
						 endif;  
						endforeach;
						$data1['school_id']=$school_id;
						$data1['session_id']=$session_id;
						$data1['errorList']=implode(',',$errorList);
						
					   insert_record_in_table('student_error_records',$data1);
					   
					 endif;  
					 
		         endif;
	           }
		    fclose($handle);
	        }
		  if($error_status==1):
		    Redirect(make_url('administration-student'));
		  else:
		    unset_student_unsuccessfull_list();
		    Redirect(make_url('administration-student'));
		  endif;
		endif;
		break;				
 
	default:break;
endswitch;
?>
