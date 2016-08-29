<?php
$admissionEnquiryStatusArray=array(1=>'Enrolled',2=>'New Enquiry',3=>'Followup',4=>'Hot Lead',5=>'Cold Lead',6=>'Not Interested');
$admissionEnquiryStatusLabelArray=array(1=>'label-success',2=>'label-default',3=>'label-warning',4=>'label-danger',5=>'label-info',6=>'label-inverse');
#download student list  not uploaded successfully due to some error
function download_lead_student_list_nouSuccess($val)
{
	$users=get_all_record_by_query('student_pre_registration_error_records','student_pre_registration_session_id="'.$val.'"','student_pre_registration_date','student_pre_registration_first_name','student_pre_registration_last_name','student_pre_registration_dob','student_pre_registration_email','student_pre_registration_previous_school','student_pre_registration_location','student_pre_registration_how_to_know','student_pre_registration_suggestion','student_pre_registration_attendent','student_pre_registration_father_first_name','student_pre_registration_father_last_name','student_pre_registration_father_occupation','student_pre_registration_father_office_phone','student_pre_registration_father_resi_phone','student_pre_registration_father_mobile','student_pre_registration_mother_first_name','student_pre_registration_mother_last_name','student_pre_registration_mother_occupation','student_pre_registration_mother_office_phone','student_pre_registration_mother_resi_phone','student_pre_registration_mother_mobile,student_pre_registration_errorList');
	$users_arr= array();
	
	if($users):
		foreach($users as $k=>$v):
		    $v->student_pre_registration_date=ToIndianDate($v->student_pre_registration_date);
			array_push($users_arr,$v);
		endforeach;
	endif;
	
	$file='Enquiry Date*,First Name*,Last Name,Date of Birth*,Preferred Email ID,Previous School,Location,How did you get to know about us,We value your suggestion,Attended By,Father First Name,Father Last Name,Father Occupation,Father Office Phone,Father Residence Phone,Father Mobile,Mother First Name,Mother Last Name,Mother Occupation,Mother Office Phone,Mother Residence Phone,Mother Mobile,Error';
	$file.=make_csv_from_array($users_arr);
	$filename="studentLeadListNotSuccess.csv";
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}
#blank exel sheet
function download_lead_student()
{
	$file='Enquiry Date*,First Name*,Last Name,Date of Birth*,Preferred Email ID,Previous School,Location,How did you get to know about us,We value your suggestion,Attended By,Father First Name,Father Last Name,Father Occupation,Father Office Phone,Father Residence Phone,Father Mobile,Mother First Name,Mother Last Name,Mother Occupation,Mother Office Phone,Mother Residence Phone,Mother Mobile';
	
	$filename="studentLeadList.csv";
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}

function unset_lead_student_unsuccessfull_list()
{
   unset($_SESSION['user_session']['set_lead_student_unsuccessfull_list']);
}
function set_lead_student_unsuccessfull_list($val)
{
   $_SESSION['user_session']['set_lead_student_unsuccessfull_list']=$val;
   return true;
}
# check validation
function checkValidationImportStudentLeadList($val)
{
			    $validation=new user_validation();
				$validation->add('student_pre_registration_date', 'req','Enquiry Date');	
				$validation->add('student_pre_registration_first_name', 'req','first name');	
				$validation->add('student_pre_registration_dob', 'req','Date of Birth');	
				$validation->add('student_pre_registration_email', 'email','prefered email id');
				$validation->add('student_pre_registration_father_office_phone', 'num','Father Office Phone');	
				$validation->add('student_pre_registration_father_resi_phone', 'num','Father Residence Phone');	
				$validation->add('student_pre_registration_father_mobile', 'num','Father Mobile');
				$validation->add('student_pre_registration_mother_office_phone', 'num','Mother Office Phone');	
				$validation->add('student_pre_registration_mother_resi_phone', 'num','Mother Residence Phone');	
				$validation->add('student_pre_registration_mother_mobile', 'num','Mother Mobile');
				
									
				# check validations.
				$valid= new valid();
				if($valid->validate($val, $validation->get())):
				  return true;
				else:
				  return $valid->error;  
				endif;
}
?>