<?
ob_start();
error_reporting(1);
#session reassigning using cookie here.
session_start();

###############################################################################################
############################     Website developed by: Navdeep
############################     Website name: myschool
###############################################################################################
$DirPath=explode('index.php',$_SERVER[SCRIPT_NAME]);
$DirPath=explode('control',$DirPath[0]);
$DirPath=$DirPath[0];
#get sub domain name
$subDemainName = explode('.',$_SERVER[HTTP_HOST]);
$subDemainName=$subDemainName[0];
#get directory path
define("HTTP_SERVER","http://".$_SERVER[HTTP_HOST] ,true);
# Set website
define("DIR_WS_SITE", HTTP_SERVER.$DirPath,true);
#Document root.
define("DIR_FS", $_SERVER['DOCUMENT_ROOT'],true);
 #Set  Website Filesystem
define("DIR_FS_SITE", DIR_FS.$DirPath,true);

//$checkDIR=explode('/',$_SERVER[SCRIPT_NAME]);
$checkDIR=str_replace('/','\\',getcwd());
$checkDIR=explode('\\',$checkDIR);
# Database 
require_once(DIR_FS_SITE."../../dataBaseDetilas.php");
$DBHostName = DB_HOST_NAME;
$DBUserName = DB_USER_NAME;
$DBPassword = DB_PASSWORD;
if(end($checkDIR)!='control' &&  $_SESSION['user_session']['database_name']):
  $DBDataBase = $_SESSION['user_session']['database_name'];
elseif(end($checkDIR)=='control' &&  $_SESSION['admin_session_secure']['database_name']):
  $DBDataBase = $_SESSION['admin_session_secure']['database_name'];
else:
  $DBDataBase = DB_DATABASE;
endif;

# include sub-configuration files here.
require_once(DIR_FS_SITE."../framework/url.php");

# include the utitlity files here
require_once(DIR_FS_SITE."../../vendor/autoload.php");
require_once(DIR_FS_SITE."../../vendor/psr/log/Psr/Log/LoggerInterface.php");
require_once(DIR_FS_SITE."../../vendor/monolog/monolog/src/Monolog/Logger.php");

require_once(DIR_FS_SITE."../../vendor/monolog/monolog/src/Monolog/Handler/HandlerInterface.php");
require_once(DIR_FS_SITE."../../vendor/monolog/monolog/src/Monolog/Handler/AbstractHandler.php");
require_once(DIR_FS_SITE."../../vendor/monolog/monolog/src/Monolog/Handler/AbstractProcessingHandler.php");
require_once(DIR_FS_SITE."../../vendor/monolog/monolog/src/Monolog/Handler/StreamHandler.php");

require_once(DIR_FS_SITE."../../vendor/monolog/monolog/src/Monolog/Formatter/FormatterInterface.php");
require_once(DIR_FS_SITE."../../vendor/monolog/monolog/src/Monolog/Formatter/NormalizerFormatter.php");
require_once(DIR_FS_SITE."../../vendor/monolog/monolog/src/Monolog/Formatter/LineFormatter.php");

include_once(DIR_FS_SITE_INCLUDE_APP_FUNCTION.'log.php');
# include the database class files.
include_once(DIR_FS_SITE_INCLUDE_FUNCTION.'email.php');
require_once(DIR_FS_SITE_INCLUDE_CLASS."mysql.php");
require_once(DIR_FS_SITE_INCLUDE_CLASS."query.php");
require_once(DIR_FS_SITE_INCLUDE_CLASS."validation_u.php");
require_once(DIR_FS_SITE_INCLUDE_CLASS."validation_p.php");





require_once(DIR_FS_SITE_INCLUDE_CONFIG."message.php");

# custom files
include_once(DIR_FS_SITE_INCLUDE_CLASS.'login_session.php');
include_once(DIR_FS_SITE_INCLUDE_CLASS.'admin_session.php');

# include functions from framework here.
include_once(DIR_FS_SITE_INCLUDE_FUNCTION.'date.php');

include_once(DIR_FS_SITE_INCLUDE_FUNCTION.'database.php');
include_once(DIR_FS_SITE_INCLUDE_FUNCTION.'forum.php');
include_once(DIR_FS_SITE_INCLUDE_FUNCTION.'basic.php');
# include functions from application here.
include_once(DIR_FS_SITE_INCLUDE_APP_FUNCTION.'common.php');


if (file_exists("../dataBaseCheck.php" ) ):
  runSqlFile('commondatabase.sql');
  unlink("../dataBaseCheck.php");
endif;
require_once(DIR_FS_SITE_INCLUDE_CONFIG."constant.php");
require_once(DIR_FS_SITE_INCLUDE_CONFIG."arrays.php");

#date_default_timezone_set('Asia/Calcutta');

# fix for stripslashes issues in php
if(get_magic_quotes_gpc()):
	$_POST=array_map_recursive('stripslashes', $_POST);
	$_GET=array_map_recursive('stripslashes', $_GET);
	$_REQUEST=array_map_recursive('stripslashes', $_REQUEST);
endif;
?>
