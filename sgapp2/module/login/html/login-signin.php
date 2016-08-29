<!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: JAVASCRIPTS REQUIRED FOR Validations -->
<script src="design/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="design/js/form-validation.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR Validations -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/js/login.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
			jQuery(document).ready(function() {
			FormValidator.init();
				Login.init();
			});
		</script>
<!-- start: TO MAKE DATABASE CONNECTION FOR STUDENT LOGIN-->
<script>
function databaseConnectIndividualParent()
{
  <?=$login_session->unset_database_session();?>
  var useremail=$('form#frm-login #userId').val();
  var password=$('form#frm-login #password').val();
    if(!useremail || !password)
   {
   $('#frm-login').submit();
   }
	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=login-ajax",
		data:"mode=databaseConnectIndividual&userId="+userId+"&password="+password,
		
		success: function(output)
		 {
		  if(output==1)
		  {
		   $('#frm-login').submit();
		  }	
		}   
	});
}
</script>
<!-- end: TO MAKE DATABASE CONNECTION FOR STUDENT LOGIN-->
<!-- start: TO MAKE DATABASE CONNECTION FOR FACULTY LOGIN-->
<script>
function databaseConnectIndividualFaculty()
{
  <?=$login_session->unset_database_session();?>
  var useremail=$('form#frm-login1 #userId').val();
  var password=$('form#frm-login1 #password').val();
     if(!useremail || !password)
   {
   $('#frm-login1').submit();
   }
	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=login-ajax",
		data:"mode=databaseConnectIndividual&userId="+userId+"&password="+password,
		
		success: function(output)
		 {
		 
		  if(output==1)
		  {
		  $('#frm-login1').submit();
		  }	
		}   
	});
}
</script>
<!-- start: TO MAKE DATABASE CONNECTION FOR FACULTY LOGIN-->
</head>
<body class="login">
<!-- start: MAIN CONTAINER -->
<div class="main-login col-sm-4 col-sm-offset-4">

  <!-- start: LOGIN BOX -->
  <div class="box-login">
  <div align="center"><img height="50px" src="upload/photo/school/logoImage/<?=$subDemainName?>.jpg" /></div>
    <h3>Sign in to your account</h3>
    <?php display_form_error();?>
    <p> Please enter your name and password to log in. </p>
    <div class="tabbable">
      <ul id="myTab" class="nav nav-tabs tab-bricky">
        <li class="active"> <a href="#parents" data-toggle="tab"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parents <i class="clip-users-2"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
        <li> <a href="#faculty" data-toggle="tab"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Faculty <i class="clip-user-5 "></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane in active" id="parents">
          <form class="form-login" action="<?=make_url($page)?>" method="post" name="frm-login" id="frm-login" >
            <div class="col-md-12">
              <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
              <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
            </div>
            <fieldset>
            <div class="form-group"> <span class="input-icon">
              <input id="userId" name="userId" type="text" class="form-control"  placeholder="Parent-ID" />
              <i class="fa fa-user"></i> </span> </div>
            <div class="form-group form-actions"> <span class="input-icon">
              <input id="password" name="password" type="password" class="form-control password"  placeholder="Password" />
              <i class="fa fa-lock"></i> <a class="forgot" href="<?=make_url('login-forgotpassword','userType=student')?>" rel='day_view'>Forgot Password?</a> </span> </div>
            <input type="hidden" name="userType" value="student" />
            <div class="form-actions">
              <label for="remember" class="checkbox-inline">
              <input type="checkbox" name="remember_me" id="remember_me" class="grey remember" value="1"/>
              Keep me signed in </label>
              <input type="button" name="login" class="btn btn-bricky pull-right" value="Login" onClick="databaseConnectIndividualParent();"/>
            </div>
            </fieldset>
          </form>
        </div>
        <div class="tab-pane" id="faculty">
          <form class="form-login" action="<?=make_url($page)?>" method="post" name="frm-login1" id="frm-login1" >
            <div class="col-md-12">
              <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
              <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
            </div>
            <fieldset>
            <div class="form-group"> <span class="input-icon">
              <input id="userId" name="userId" type="text" class="form-control"  placeholder="Faculty-ID" />
              <i class="fa fa-user"></i> </span> </div>
            <div class="form-group form-actions"> <span class="input-icon">
              <input id="password" name="password" type="password" class="form-control password"  placeholder="Password" />
              <i class="fa fa-lock"></i> <a class="forgot" href="<?=make_url('login-forgotpassword','userType=faculty')?>" >Forgot Password?</a> </span> </div>
            <input type="hidden" name="userType" value="faculty" />
            <div class="form-actions">
              <label for="remember" class="checkbox-inline">
              <input type="checkbox" name="remember_me" id="remember_me" class="grey remember" value="1"/>
              Keep me signed in </label>
              <input type="button" name="login" class="btn btn-bricky pull-right" value="Login" onClick="databaseConnectIndividualFaculty();"/>
            </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
    <div class="new-account"> <a href="<?=make_url('login-admin')?>" > School Admin </a> </div>
  </div>
  <!-- end: LOGIN BOX -->
  <div class="copyright"> <a href="">Terms of Use</a> | <a href="">Privacy Policy</a> |  Copyright © 2013 - SchoolGennie </div>
</div>
<!-- Main End -->
</body>
</html>
