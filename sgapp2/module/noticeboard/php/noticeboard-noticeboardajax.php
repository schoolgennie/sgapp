<?php 
check_logged_in_for_myaccount('school');
isset($_POST['noticeboard_id'])?$noticeboard_id=$_POST['noticeboard_id']:$noticeboard_id='';
#school unique id
$school_id=$login_session->get_user_id();
if(isset($_REQUEST['mode'])):
	switch($_REQUEST['mode'])
	{
	  case 'deleteNotice':
	     if($login_session->get_usertype()==$userTypeArray[0]):
           delete_record_from_table('noticeboard',"noticeboard_id='".$noticeboard_id."' and school_id='".$school_id."'");
		 endif;    
		 exit; 
	  break;	  
	}				

endif;		
?>
