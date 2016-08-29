<?
check_logged_in_for_myaccount('student');

#student unique id
$student_id=$login_session->get_user_id();

#student details
$studentDetail=get_object_by_query('student','student_id='.$student_id);
#school_id
$school_id=$studentDetail->school_id;
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

# class id
$class=$studentDetail->class_id;

# class detals
$classDetails=get_object_by_query('class','class_id='.$class.' and class_is_active=1');


#active time table  
$activeTimeTable=get_object_by_query('time_table','time_table_is_active=1');

# selected time table period list
if($activeTimeTable):
$activeTimetablePeriodList=get_all_record_by_query('time_table_period','time_table_id="'.$activeTimeTable->time_table_id.'"');
endif;

			
?>
