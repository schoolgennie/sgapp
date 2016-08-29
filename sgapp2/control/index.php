<?  require_once("../include/config/config.php");
	$function=array('url', 'database','input');
	include_functions($function);
	if(is_var_set_in_post('login')):
		if($user=validate_user('admin_user', $_POST)):
			$admin_user->set_admin_user_from_object($user);
			re_direct(DIR_WS_SITE_CONTROL."control.php");
		else:
			//$admin_session->set_pass_msg(MSG_LOGIN_INVALID_USERNAME_PASSWORD);
			$admin_user->set_pass_msg(MSG_LOGIN_INVALID_USERNAME_PASSWORD);
			re_direct(DIR_WS_SITE_CONTROL.'index.php');
		endif;
	endif;
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title><?=SITE_NAME?> :: Website Control Panel</title>
		<link href="<?=DIR_WS_SITE_CONTROL_CSS?>style.css" rel="stylesheet" type="text/css">
		<link href="<?=DIR_WS_SITE_CONTROL_CSS?>style1.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	
			
			<form method="POST">
			
			<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle"><br />
    <table width="372" height="248" border="0" cellpadding="0" cellspacing="0" class="bg">
        <tr>
          <td align="center" valign="middle">
        
          <table border="0" cellspacing="3" cellpadding="2">
          <tr><td colspan="2">  <?
			display_messageindex(1);
			?></td></tr>
            <tr>
              <td>Username</td>
              <td><input type="text" name="username"></td>
            </tr>
            <tr>
              <td>Password</td>
              <td><input type="password" name="password"></td>
            </tr>
			
            <tr>
              <td height="65">&nbsp;</td>
              <td align="right"><input type="hidden" name="login" value="Submit"  />
			  <input type="image" src="image/bn_submit.png"  style="width:110px; height:38px; border:none;" width="110" height="38" border="0" />
			  </td>
            </tr>
          </table></td>
        </tr>
    </table>
    <br>
    <div align="center" class="bottomlink"><br>
</div></td>
  </tr>
</table>
			
			
			
			
			
			
			
		</form>
	</body>
</html>
