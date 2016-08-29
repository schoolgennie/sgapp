<!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="design/js/form-validation.js"></script>
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
<script>
function databaseConnectForgetpassword()
{
<?=$login_session->unset_database_session();?>
  var userId=$('form#frmForget #userId').val();
  
   if(!userId)
   {
   $('#frmForget').submit();
   }
	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=login-ajax",
		data:"mode=databaseConnectIndividual&userId="+userId,
		
		success: function(output)
		 {
		
		  if(output==1)
		 {
	
		  $('#frmForget').submit();
		  return true;
		  }	
		}   
	});
}
</script>
</head>
<body class="login example2">
<!-- start: MAIN CONTAINER -->
<div class="main-login col-sm-4 col-sm-offset-4">
  <!-- start: FORGOT BOX -->
  <div class="box-login">
    <h3>Forget Password?</h3>
    <?php display_form_error();?>
    <p> Enter your User Id below to reset your password. </p>
    <form action="<?=make_url('login-forgotpassword')?>" method="post" name="frmForget" id="frmForget" class="form-forgot">
      <div class="col-md-12">
        <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
        <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
      </div>
      <fieldset>
      <div class="form-group"> <span class="input-icon">
        <input type="text" class="form-control" id="userId" name="userId" placeholder="User Id" >
        <i class="fa fa-envelope"></i> </span> </div>
      <div class="form-actions">
        <button type="button" class="btn btn-light-grey go-back" onClick="window.location.href='<?=make_url('login-signin')?>'"> <i class="fa fa-circle-arrow-left"></i> Login </button>
        <input type="hidden" name="userType" value="<?=$_GET['userType']?>" />
        <button type="button" class="btn btn-bricky pull-right" onClick="databaseConnectForgetpassword();"> Submit <i class="fa fa-arrow-circle-right"></i> </button>
      </div>
      </fieldset>
    </form>
  </div>
  <!-- end: FORGOT BOX -->
  <div class="copyright"> <a href="">Terms of Use</a> | <a href="">Privacy Policy</a> |  Copyright © 2013 - SchoolGennie </div>
</div>
<!-- Main End -->
</body>
</html>
