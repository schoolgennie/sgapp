<!DOCTYPE html >
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'cssJavascript.php'); ?>
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="design/js/form-validation.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
			jQuery(document).ready(function() {
				FormValidator.init();
			});
		</script>
<script>
<!--check old password already exist or not-->
function ckeckPassword(val)
{
var password=$('#password').val();

$.ajax({
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=profile-facultyajax",
		data:"mode=checkOldPassword&password="+password,
		
		success: function(output)
		 {
		
		  if(output==1)
		  {
		   $('#ckeckPassword').html('');
		   $('#validatePassword').addClass('has-success').removeClass('has-error');
		  } 
		  
		  else
		  {
		  $('#password').val('');
		  $('#validatePassword').addClass('has-error').removeClass('has-success');
		  $('#ckeckPassword').html('Old password does not exist');
		  
		  }	
		  
		}   
	});
}
</script>
<body>
 <!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<!-- start: MAIN CONTAINER -->
<div class="main-container">
  <? include_once(DIR_FS_SITE_INCLUDE.'facultyNav.php'); ?>
  <div class="main-content">
    <?php display_form_error();?>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="changePassword" class="tab-pane">
                <form id="frmChangePassword" name="frmChangePassword" action="<?=make_url('profile-facultychangepassword')?>" method="post" >
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Change Password</h3>
                      <hr>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group" id="validatePassword">
                        <label class="control-label"> Old Password<span class="symbol required"></span> </label>
                        <input type="password" placeholder="password" class="form-control" name="password" id="password" onBlur="ckeckPassword(this.value)">
                        <span  id="ckeckPassword" style="color:#b94a48"></span> </div>
                      <div class="form-group">
                        <label class="control-label"> New Password<span class="symbol required"></span> </label>
                        <input type="password" placeholder="password" class="form-control" name="npassword" id="npassword">
                      </div>
                      <div class="form-group">
                        <label class="control-label"> Confirm Password<span class="symbol required"></span> </label>
                        <input type="password"  placeholder="password" class="form-control" id="cpassword" name="cpassword">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                      <input class="btn btn-teal btn-block" type="submit" name="submit" value="Change">
                    </div>
                  </div>
                </form>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Main End -->

<!-- Footer Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
<!-- Footer End-->

</div>
</body>
</html>
