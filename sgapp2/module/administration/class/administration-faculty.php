<?
# check validation
function checkValidationImportFacultyList($val)
{    
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
				if($valid->validate($val, $validation->get())):
				  return true;
				else:
				  return $valid->error;  
				endif;
}
# check  user id for dulicate record
function checkUserIdExistImportFacultyList($faculty_user_id)
{
    $checkEmailId=get_object_by_query('faculty','faculty_user_id="'.$faculty_user_id.'"');
	if(!$checkEmailId):
			return true;
	else:
			return 'User Id already Exist';  		
	endif;
}
# check  Designation exist
function checkDesignationExistImportFacultyList($faculty_designation)
{
  global $fcultyDesignationArray;
  if($faculty_designation && in_array($fcultyDesignationArray[$faculty_designation],$fcultyDesignationArray)):
			return true;
  else:
			return 'Designation does not exist';  			
  endif;
}
# check  Employee ID for dulicate record
function checkEmployeeIDExistImportFacultytList($faculty_employee_id)
{
  $checkList=get_object_by_query('faculty','faculty_employee_id="'.$faculty_employee_id.'"');
  if(!$faculty_employee_id || !$checkList):
			return true;
  else:
		    return 'Employee ID already Exist';  			
  endif;
}
#download faculty list  not uploaded successfully due to some error
function download_faculty_list_nouSuccess($val)
{						
	$users=get_all_record_by_query('faculty_error_records','session_id="'.$val.'"','faculty_user_id,faculty_first_name,faculty_last_name,faculty_mobile,faculty_dob,faculty_gender,faculty_designation,faculty_email_id,faculty_email_personal,faculty_contact,faculty_employee_id,faculty_bachelors,faculty_highest_qualification,faculty_years_of_experience,faculty_with_school_since,faculty_previous_school,faculty_address,errorList');
	$users_arr= array();
	
	if($users):
		foreach($users as $k=>$v):
			array_push($users_arr,$v);
		endforeach;
	endif;
	
	$file='User ID*,First Name*,Last Name*,Mobile No*,Date of Birth*,Gender*,Designation*,Email Official,Email Personal,Phone No,Employee ID,Bachelors,Post Graduation,Total Experience,With School Since,Previous Schoool,Address,Error';
	$file.=make_csv_from_array($users_arr);
	$filename="facultyListNotSuccess.csv";
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}
#blank exel sheet
function download_faculty()
{					
	$file='User ID*,First Name*,Last Name*,Mobile No*,Date of Birth*,Gender*,Designation*,Email Official,Email Personal,Phone No,Employee ID,Bachelors,Post Graduation,Total Experience,With School Since,Previous Schoool,Address';
	//$file.=make_csv_from_array($users_arr);
	$filename="facultyList.csv";
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}
function unset_faculty_unsuccessfull_list()
{
unset($_SESSION['user_session']['set_faculty_unsuccessfull_list_session_id']);
}
function set_faculty_unsuccessfull_list($val)
{
$_SESSION['user_session']['set_faculty_unsuccessfull_list_session_id']=$val;
return true;
}

?>