<?php
 
//ASSIGN VARIABLES TO USER INFO
$logTime = date("M j G:i:s Y"); 
$logIp = getenv('REMOTE_ADDR');
$logUserAgent = getenv('HTTP_USER_AGENT');
$logReferrer = getenv('HTTP_REFERER');
$logQuery = getenv('QUERY_STRING');
 
//COMBINE VARS INTO OUR LOG ENTRY
$logMsg = "IP: " . $logIp . " TIME: " . $logTime . " REFERRER: " . $logReferrer . " SEARCHSTRING: " . $logQuery . " USERAGENT: " . $logUserAgent . "LOGINID:" . $login_session->get_usertype().$login_session->get_user_id();
 
//CALL OUR LOG FUNCTION
writeToLogFile($logMsg);
 
function writeToLogFile($msg) {
     
     $today = date("Y_m_d"); 
	 if(!is_dir(DIR_FS_SITE_INCLUDE_FUNCTION.$today)):
	 mkdir(DIR_FS_SITE_INCLUDE_FUNCTION.$today);
	 endif;
	 $login_session =new user_session();
     $logfile = $login_session->get_schoolId()."_log.txt"; 
     $dir =DIR_FS_SITE_INCLUDE_FUNCTION.$today;
     $saveLocation=$dir . '/' . $logfile;
     if  (!$handle = @fopen($saveLocation, "a")) {
          exit;
     }
     else {
          if (@fwrite($handle,"$msg\r\n") === FALSE) {
               exit;
          }
   
          @fclose($handle);
     }
}
 
?>