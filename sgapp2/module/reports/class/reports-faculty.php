<?

#blank exel sheet
function download_faculty()
{	
    global $fcultyDesignationArray;
    $users=get_all_record_by_query('faculty','','faculty_first_name,faculty_last_name,faculty_designation,faculty_employee_id,faculty_email_id,faculty_mobile,faculty_gender,faculty_dob');
	$users_arr= array();
	
	if($users):
		foreach($users as $k=>$v):
		$users[$k]->faculty_designation=$fcultyDesignationArray[$users[$k]->faculty_designation];
			array_push($users_arr,$v);
		endforeach;
	endif;				
	$file='First Name,Last Name,Designation,Employee ID,Email,Phone,Gender,Date of birth';
	$file.=make_csv_from_array($users_arr);
	$filename="facultyReport.csv";
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}


?>