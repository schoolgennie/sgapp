<?

function countStudentPendingFee($studentId,$startDate)
{
$totalFee=get_object_by_query('fee_collection_management as a,fee_structure as b,fee_category as c,fee_collection_type as d','a.student_id="'.$studentId.'" and b.fee_structure_id=a.fee_structure_id and c.fee_category_id=b.fee_category_id and b.fee_collection_type_id=d.fee_collection_type_id   and d.fee_collection_type_due_date<="'.$startDate.'"','SUM(b.fee_structure_amount) as totalAmount')->totalAmount;
$totalPaid=get_object_by_query('student_fee_history','student_id="'.$studentId.'"','SUM(student_fee_history_paid_amount) as totalAmount')->totalAmount;
return $totalFee-$totalPaid;
}
function download_student()
{
    $users=get_all_record_by_query('student as a ,class as b','a.class_id=b.class_id order by a.student_is_active desc','a.student_id,a.student_first_name,a.student_last_name,a.student_roll_number,a.student_email_id,a.student_contact,a.student_gender,b.class_name');
	$users_arr= array();
	
	if($users):
		foreach($users as $k=>$v):
		    $pendingAmount=countStudentPendingFee($v->student_id,date('Y-m-d'));
            $v->fee_status = ($pendingAmount)?(($pendingAmount>0)?'Due':'advance paid'):'No Due';
			$v->amount = $pendingAmount;
			unset($v->student_id);
			array_push($users_arr,$v);
		endforeach;
	endif;
	$file='First Name,Last Name,Roll Number,Prefered Email,Phone,Gender,Class,Fees Status,Amount';
	$file.=make_csv_from_array($users_arr);
	$filename="studentFeeReport.csv";
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
	unlink('download/'.$filename);
}


?>