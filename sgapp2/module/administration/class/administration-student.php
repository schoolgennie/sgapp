<?
# check validation
function checkValidationImportStudentList($val)
{
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
				if($valid->validate($val, $validation->get())):
				  return true;
				else:
				  return $valid->error;  
				endif;
}
# check  user id for dulicate record
function checkUserIdExistImportStudentList($student_user_id)
{
    $login_session =new user_session();
	$school_id=$login_session->get_school_unique_id();
    $checkEmailId=get_object_by_query('student','student_user_id="'.$student_user_id.'" and school_id="'.$school_id.'"');
	if(!$checkEmailId):
			return true;
	else:
			 return 'User Id already Exist';  		
	endif;
}
# check  class id exist
function checkClassExistImportStudentList($class_id)
{
  $login_session =new user_session();
  $school_id=$login_session->get_school_unique_id();
  $checkClass=get_object_by_query('class','school_id="'.$school_id.'" and class_id="'.$class_id.'" and class_is_active=1');
  if($checkClass):
			return true;
  else:
			return 'Class does not exist';  			
  endif;
}
# check  student_admission_no for dulicate record
function checkAdmissionNoExistImportStudentList($student_admission_no)
{
  $login_session =new user_session();
  $school_id=$login_session->get_school_unique_id();
  $checkList=get_object_by_query('student','student_admission_no="'.$student_admission_no.'" and school_id="'.$school_id.'"');
  if(!$student_admission_no || !$checkList):
			return true;
  else:
		    return 'Admission no. already Exist';  			
  endif;
}
#download student list  not uploaded successfully due to some error
function download_student_list_nouSuccess($val)
{
	$users=get_all_record_by_query('student_error_records','session_id="'.$val.'"','student_user_id,class_id,student_first_name,student_last_name,student_dob,student_gender,student_contact,student_email_id,student_admission_no,student_roll_number,student_transport_type,student_nationality,student_with_school_since,student_country,student_state,student_city,student_zip,student_address,student_father_first_name,student_father_last_name,student_father_organization,student_father_phone,student_mother_first_name,student_mother_last_name,student_mother_organization,student_mother_phone,student_emergency_contact_person_name,student_emergency_contact_person_relation,student_emergency_contact_person_mobile,errorList');
	$users_arr= array();
	
	if($users):
		foreach($users as $k=>$v):
			array_push($users_arr,$v);
		endforeach;
	endif;
	
	//$file='User ID*,First Name*,Last Name*,Gender*,Date of Birth*,Prefered Contact No.*,Country*,State*,City*,Class*,Prefered Email Id,Father First Name,Father Last Name,Father Organization,Mother First Name,Mother Last Name,Mother Organization,Father Contact No.,Father Email Id,Mother Contact No.,Mother Email Id,zip,From,To,Transport Type,Nationality,Address,Admission No.,Roll No.,With School Since,Emergency Contact Person Name,Emergency Contact Person Relation,Emergency Contact Person Mobile,Error';
	
	$file='User ID*,Class*,First Name*,Last Name,Date of Birth,Gender,Primary Mobile Number,Primary Email ID,Admission No.,Roll No.,Transport,Nationality,Admission Date,Country,State,City,Zip Code,Address,Father First Name,Father Last Name,Father Occupation,Father Contact Number,Mother First Name,Mother Last Name,Mother Occupation,Mother Contact Number,Emergency Contact Person Name,Emergency Contact Person Relation,Emergency Contact Person Mobile,Error';
	$file.=make_csv_from_array($users_arr);
	$filename="studentListNotSuccess.csv";
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}
#blank exel sheet
function download_student()
{
	//$file='User ID*,First Name*,Last Name,Gender,Date of Birth,Prefered Contact No.*,Country*,State*,City*,Class*,Prefered Email Id,Father First Name,Father Last Name,Father Organization,Mother First Name,Mother Last Name,Mother Organization,Father Contact No.,Father Email Id,Mother Contact No.,Mother Email Id,zip,From,To,Transport Type,Nationality,Address,Admission No.,Roll No.,With School Since,Emergency Contact Person Name,Emergency Contact Person Relation,Emergency Contact Person Mobile';
	
	$file='User ID*,Class*,First Name*,Last Name,Date of Birth,Gender,Primary Mobile Number,Primary Email ID,Admission No.,Roll No.,Transport,Nationality,Admission Date,Country,State,City,Zip Code,Address,Father First Name,Father Last Name,Father Occupation,Father Contact Number,Mother First Name,Mother Last Name,Mother Occupation,Mother Contact Number,Emergency Contact Person Name,Emergency Contact Person Relation,Emergency Contact Person Mobile';
	
	$filename="studentList.csv";
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}
function unset_student_unsuccessfull_list()
{
   unset($_SESSION['user_session']['set_student_unsuccessfull_list']);
}
function set_student_unsuccessfull_list($val)
{
   $_SESSION['user_session']['set_student_unsuccessfull_list']=$val;
   return true;
}
function feeCollectionManagementtList($fee_structure_id)
{
$feeCollectionManagementtListArray=array();
$feeCollectionManagementtList=get_all_record_by_query('fee_collection_management','fee_structure_id="'.$fee_structure_id.'" order by student_id');
foreach($feeCollectionManagementtList as $k=>$v):
  $feeCollectionManagementtListArray[]=$v->student_id;
endforeach;
return $feeCollectionManagementtListArray;
}
?>