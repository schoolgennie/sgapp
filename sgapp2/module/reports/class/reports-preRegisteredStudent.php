<?

#blank exel sheet
function download_student()
{
    $users=get_all_record_by_query('student_pre_registration','','student_pre_registration_first_name,student_pre_registration_last_name,student_pre_registration_date,student_pre_registration_dob,student_pre_registration_email,student_pre_registration_father_first_name,student_pre_registration_father_last_name,student_pre_registration_mother_first_name,student_pre_registration_mother_last_name,student_pre_registration_status');
	$users_arr= array();
	
	if($users):
		foreach($users as $k=>$v):
		    $v->student_pre_registration_status=($v->student_pre_registration_status==0)?'Pending':'Complete';
			array_push($users_arr,$v);
		endforeach;
	endif;
	$file='First Name,Last Name,Registration date,Date of birth,Prefered Email,Father first name,Father last name,Mother first name,Mother last name,Status';
	$file.=make_csv_from_array($users_arr);
	$filename="preRegistertedStudentReport.csv";
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}


?>