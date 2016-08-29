<?
    if (!file_exists("../../dataBaseDetilas.php" ) ):
     require_once("install.php");
     exit;
    endif; 
    include_once("include/config/config.php");
	# website statistics.
	if(!isset($_SESSION['visitor'])):
		$_SESSION['visitor']=1;
		$qu=new query('web_stat');
		$qu->Data['ip_address']=$_SERVER['REMOTE_ADDR'];
		$qu->Insert();
	endif;
	include_functions(array('url', 'input', 'database', 'date', '', 'email', 'file_handling', 'http', 'image_manipulation', 'login', 'paging', 'url', 'template'));
	
	
	
	# website statistic recorded.	
	$page = isset($_REQUEST['page']) ? $_REQUEST['page']:"login-signin";
    $pagemod=explode('-',$page);
	$pagemod=$pagemod[0];
	
		 if(file_exists(DIR_FS_SITE_MODULE.$pagemod."/class/"."$pagemod.php"))
			require_once(DIR_FS_SITE_MODULE.$pagemod."/class/"."$pagemod.php");
		if(file_exists(DIR_FS_SITE_MODULE.$pagemod."/class/"."$page.php"))
			require_once(DIR_FS_SITE_MODULE.$pagemod."/class/"."$page.php");	
		if(file_exists(DIR_FS_SITE_MODULE.$pagemod."/php/"."$page.php"))
			require_once(DIR_FS_SITE_MODULE.$pagemod."/php/"."$page.php");
		if(file_exists(DIR_FS_SITE_MODULE.$pagemod."/html/"."$page.php"))
			require_once(DIR_FS_SITE_MODULE.$pagemod."/html/"."$page.php");
		else 
			require_once(DIR_FS_SITE_MODULE."404/html/"."404.php");	

?>
