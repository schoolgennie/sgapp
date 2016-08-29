<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');

$waiverStudentList=get_all_record_by_query('student_fee_history as a,student as b','a.student_id=b.student_id and student_fee_history_waver>0 order by student_fee_history_waver_status desc');
if(isset($_GET['status']) && $_GET['status']!=''):
    $data['student_fee_history_waver_status']=$_GET['status'];
	$where="student_fee_history_id='".$_GET['id']."'";																																																																																			
	update_record_in_table('student_fee_history',$where,$data);
	Redirect(make_url('waiver-approval'));
endif;
?>
