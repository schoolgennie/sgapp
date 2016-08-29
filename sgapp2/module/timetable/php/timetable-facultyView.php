<?
check_logged_in_for_myaccount('faculty');

#faculty unique id
$faculty_id=$login_session->get_user_id();
#fetch school details
$facultyDetail=get_object_by_query('faculty','faculty_id='.$faculty_id);
#school_id
$school_id=$facultyDetail->school_id;

#active time table  
$activeTimeTable=get_object_by_query('time_table','time_table_is_active=1');

# selected time table period list
if($activeTimeTable):
$activeTimetablePeriodList=get_all_record_by_query('time_table_period','time_table_id="'.$activeTimeTable->time_table_id.'"');
endif;


			
?>
