<?

#blank exel sheet
function download_student()
{
    $users=get_all_record_by_query('student as a ,class as b','a.class_id=b.class_id order by a.student_is_active desc','a.student_first_name,a.student_last_name,a.student_roll_number,a.student_admission_no,a.student_email_id,a.student_contact,a.student_gender,a.student_dob,b.class_name');
	$users_arr= array();
	
	if($users):
		foreach($users as $k=>$v):
			array_push($users_arr,$v);
		endforeach;
	endif;
	$file='First Name,Last Name,Roll Number,Admission No.,Prefered Email,Phone,Gender,Date of birth,Class';
	$file.=make_csv_from_array($users_arr);
	$filename="studentReport.csv";
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}


?>