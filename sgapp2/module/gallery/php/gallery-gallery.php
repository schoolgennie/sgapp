<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);
#fetch album 
$albumList=get_all_record_by_query('album','school_id="'.$school_id.'"');		
?>
