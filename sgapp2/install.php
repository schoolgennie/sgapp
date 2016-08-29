<!DOCTYPE html >
<html >
<head>
<? 

if(isset($_POST['submit']) && $_POST['submit']=='Create'):
$data='<? ';
$data.='define("DB_HOST_NAME", "'.$_POST['host'].'",true);';	
$data.='define("DB_DATABASE", "'.$_POST['database_name'].'",true);';	
$data.='define("DB_USER_NAME", "'.$_POST['user_name'].'",true);';	
$data.='define("DB_PASSWORD", "'.$_POST['password'].'",true);';	
$data.='?>';
//print_r($data);exit;	
$dataBaseDetilas='../../dataBaseDetilas.php';
$dataBaseDetilas= fopen($dataBaseDetilas, 'w+');
fwrite($dataBaseDetilas, $data);
fclose($dataBaseDetilas);
$dataBaseCheck= fopen('../dataBaseCheck.php', 'w+');
fwrite($dataBaseCheck, $data);
fclose($dataBaseCheck);
header('Location: '.$_SERVER['REQUEST_URI']);
endif;
?>
<? include_once('include/meta.php'); ?>
<title>School Gennie</title>
        <!-- start: MAIN CSS -->
		<link href="design/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="design/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="design/fonts/style.css">
		<link rel="stylesheet" href="design/css/main.css">
		<link rel="stylesheet" href="design/css/main-responsive.css">
		<link rel="stylesheet" href="design/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="design/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="design/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="design/css/theme_light.css" id="skin_color">
		<!--[if IE 7]>
		<link rel="stylesheet" href="DIR_WS_SITE_PLUGINS/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
	<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="DIR_WS_SITE_PLUGINS/respond.min.js"></script>
		<script src="DIR_WS_SITE_PLUGINS/excanvas.min.js"></script>
		<![endif]-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="design/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="design/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="design/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="design/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="design/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="design/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="design/plugins/less/less-1.5.0.min.js"></script>
		<script src="design/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="design/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="design/plugins/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
			});
		</script>

<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/js/login.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
	jQuery(document).ready(function() {
	FormValidator.init();
		Login.init();
		
	});
</script>
<!-- start: TO MAKE DATABASE CONNECTION FOR LOGIN-->

</head>
<body class="login example2">
<!-- start: MAIN CONTAINER -->
<div class="main-login col-sm-4 col-sm-offset-4">
  <!-- start: Admin LOGIN BOX -->
  <div class="box-login">
    <h3>Fiil Database Information</h3>
    
    
    <form class="form-login"  method="post" name="frm-database" id="frm-database">
      
      <fieldset>
      <div class="form-group"> <span class="input-icon">
        <input id="host" type="text" class="form-control" name="host" placeholder="Host name" required>
        <i class="fa fa-user"></i> </span> </div>
      <div class="form-group form-actions"> <span class="input-icon">
        <input id="database_name" type="text" class="form-control password" name="database_name" placeholder="Database name" required>
        <i class="fa fa-lock"></i> </span> </div>
        <div class="form-group"> <span class="input-icon">
        <input id="user_name" type="text" class="form-control" name="user_name" placeholder="User name" required>
        <i class="fa fa-user"></i> </span> </div>
        <div class="form-group"> <span class="input-icon">
        <input id="password" type="text" class="form-control" name="password" placeholder="password" >
        <i class="fa fa-user"></i> </span> </div>
      <div class="form-actions">
        <input type="submit" name="submit" class="btn btn-bricky pull-right" value="Create" />
      </div>
      
      </fieldset>
    </form>
  </div>
  <!-- end: LOGIN BOX -->
  <!-- start: FORGOT BOX -->
  
  <!-- end: FORGOT BOX -->
  <div class="copyright"> <a href="">Terms of Use</a> | <a href="">Privacy Policy</a> |  Copyright © 2013 - SchoolGennie </div>
</div>
<!-- Main End -->
</body>
</html>
