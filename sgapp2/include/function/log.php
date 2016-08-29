<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
define("DIR_FS_SITE_LOG", DIR_FS_SITE.'log/',true);
define("DIR_FS_SITE_CONTROL_LOG", DIR_FS_SITE_CONTROL.'log/',true);
function writeToLogFile() {
global $checkDIR;
global $subDemainName;

$today = date("Y_m_d");  
    #control panel
	if(end($checkDIR)=='control'):
	
	     if($_SESSION['admin_session_secure']['database_name']):
		     $schoolCode=$_SESSION['admin_session_secure']['database_name'];
			 if(!is_dir(DIR_FS_SITE_CONTROL_LOG.$schoolCode)):
			 mkdir(DIR_FS_SITE_CONTROL_LOG.$schoolCode);
			 endif;
			 if(!is_dir(DIR_FS_SITE_CONTROL_LOG.$schoolCode.'/'.$today)):
			 mkdir(DIR_FS_SITE_CONTROL_LOG.$schoolCode.'/'.$today);
			 endif;
			 $logfile = $schoolCode."_log.log"; 
			 $dir =DIR_FS_SITE_CONTROL_LOG.$schoolCode.'/'.$today;
		
		 else:
		     $cPanel='cPanle';
		     if(!is_dir(DIR_FS_SITE_CONTROL_LOG.$cPanel)):
			 mkdir(DIR_FS_SITE_CONTROL_LOG.$cPanel);
			 endif;
			 if(!is_dir(DIR_FS_SITE_CONTROL_LOG.$cPanel.'/'.$today)):
			 mkdir(DIR_FS_SITE_CONTROL_LOG.$cPanel.'/'.$today);
			 endif;
			 $logfile = $cPanel."_log.log"; 
			 $dir =DIR_FS_SITE_CONTROL_LOG.$cPanel.'/'.$today;

		 endif;
	else:
	#app 
	
		 if(!is_dir(DIR_FS_SITE_LOG.$subDemainName)):
		 mkdir(DIR_FS_SITE_LOG.$subDemainName);
		 endif;
		 if(!is_dir(DIR_FS_SITE_LOG.$subDemainName.'/'.$today)):
		 mkdir(DIR_FS_SITE_LOG.$subDemainName.'/'.$today);
		 endif;
		 $logfile = $subDemainName."_log.log"; 
		 $dir =DIR_FS_SITE_LOG.$subDemainName.'/'.$today;
	endif;	 
		 $saveLocation=$dir . '/' . $logfile;

	return 	$saveLocation;	
}

  // create a log channel
$monolog = new Logger('Logs');
$monolog->pushHandler(new StreamHandler(writeToLogFile(), Logger::WARNING));
			 
?>