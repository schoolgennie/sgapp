<?php
function getAssignedPeriodInTimeTable($class_id,$time_table_id,$time_table_period_id,$time_table_management_week_day,$faculty_management_id)
{
$result=get_object_by_query('time_table_management','class_id="'.$class_id.'" and time_table_id="'.$time_table_id.'" and time_table_period_id="'.$time_table_period_id.'" and time_table_management_week_day="'.$time_table_management_week_day.'" and faculty_management_id="'.$faculty_management_id.'"');
return $result;
}
function getDataForActiveTimeTable($class_id,$time_table_id,$time_table_period_id,$time_table_management_week_day)
{
$result=get_object_by_query('time_table_management as a,faculty_management as b, faculty as c, subject as d','a.class_id="'.$class_id.'" and a.time_table_id="'.$time_table_id.'" and a.time_table_period_id="'.$time_table_period_id.'" and a.time_table_management_week_day="'.$time_table_management_week_day.'" and b.faculty_management_id=a.faculty_management_id and c.faculty_id=b.faculty_id and d.subject_id=b.subject_id and b.faculty_management_is_active=1 and c.faculty_is_active!=0 and d.subject_is_active=1');
return $result;
}
function getDataForFacultyOfActiveTimeTable($faculty,$time_table_id,$time_table_period_id,$time_table_management_week_day)
{
$result=get_object_by_query('time_table_management as a,faculty_management as b, faculty as c, subject as d,class as e','a.time_table_id="'.$time_table_id.'" and a.time_table_period_id="'.$time_table_period_id.'" and a.time_table_management_week_day="'.$time_table_management_week_day.'" and b.faculty_management_id=a.faculty_management_id and b.faculty_id="'.$faculty.'" and c.faculty_id=b.faculty_id and d.subject_id=b.subject_id and e.class_id=a.class_id and b.faculty_management_is_active=1 and c.faculty_is_active!=0 and d.subject_is_active=1 and e.class_is_active=1');
return $result;
}
?>