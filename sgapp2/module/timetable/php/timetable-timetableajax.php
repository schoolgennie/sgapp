<?php 
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');
$faculty_id=isset($_POST['faculty_id'])?$_POST['faculty_id']:'';
$time_table_id=isset($_POST['time_table_id'])?$_POST['time_table_id']:'0';
$time_table_period_id=isset($_POST['time_table_period_id'])?$_POST['time_table_period_id']:'0';
$time_table_management_week_day=isset($_POST['time_table_management_week_day'])?$_POST['time_table_management_week_day']:'0';


if(isset($_POST['mode'])):

	switch($_POST['mode'])
	 {
       case 'isThisFacultyOccupied':
			   $result=get_object_by_query('time_table_management as a,faculty_management as b, faculty as c, subject as d','a.time_table_id="'.$time_table_id.'" and a.time_table_period_id="'.$time_table_period_id.'" and a.time_table_management_week_day="'.$time_table_management_week_day.'" and b.faculty_management_id=a.faculty_management_id and b.faculty_id="'.$faculty_id.'" and b.faculty_management_is_active=1 and c.faculty_id=b.faculty_id and d.subject_id=b.subject_id and c.faculty_is_active!=0 and d.subject_is_active=1');  
			   if($result):
		       echo 'faculty already occupied';
			   endif;
		     exit;
      break;
	
	  

	}				

endif;		


?>				