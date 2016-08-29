<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link rel="stylesheet" href="design/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
<link rel="stylesheet" href="design/plugins/bootstrap-social-buttons/social-buttons-3.css">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
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
<script>
function uoloadImage(id)
{
$('#'+id).submit();
return true;
}

</script>
</head>
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
          <div class="tabbable">
            <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
              <li class="active"> <a data-toggle="tab" href="#showProfile" > Overview </a> </li>
              <li> <a data-toggle="tab" href="#editProfile" > Edit Account </a> </li>
              <li> <a data-toggle="tab" href="#changePassword" > Change Password </a> </li>
            </ul>
            <div class="tab-content">
              <div id="showProfile" class="tab-pane in active">
                <div class="row">
                  <div class="col-sm-5 col-md-4">
                    <div class="user-left">
                      <div class="center">
                        <h4>
                          <?=$facultyDetails->faculty_first_name?>
                          <?=$facultyDetails->faculty_last_name?>
                        </h4>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="user-image">
                            <div class="fileupload-new thumbnail"><img src="<?=($facultyDetails->faculty_image)?createImazeSize(get_small('faculty'),$facultyDetails->faculty_image,200,200):'design/images/avatar-1-xl.jpg'?>" alt=""> </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <form id="imageUpload"  enctype="multipart/form-data" action="<?=make_url('profile-uploadimage','type=faculty&id='.$faculty_id.'&redirectTo='.$page)?>" method="post">
                              <div class="user-image-buttons"> <span class="btn btn-teal btn-file btn-sm"><span class="fileupload-new"><i class="fa fa-pencil"></i></span><span class="fileupload-exists"><i class="fa fa-pencil"></i></span>
                                <input type="file"  name="image" onChange="uoloadImage('imageUpload');" accept="image/*">
                                </span> <a href="#" class="btn fileupload-exists btn-bricky btn-sm" data-dismiss="fileupload"> <i class="fa fa-times"></i> </a> </div>
                            </form>
                          </div>
                        </div>
                        <hr>
                      </div>
                      <table class="table table-condensed table-hover">
                        <thead>
                          <tr>
                            <th colspan="3">Contact Information</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>official email:</td>
                            <td><?=$facultyDetails->faculty_email_id?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>personal email:</td>
                            <td><?=$facultyDetails->faculty_email_personal?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>phone:</td>
                            <td><?=$facultyDetails->faculty_contact?></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>mobile:</td>
                            <td><?=$facultyDetails->faculty_mobile?>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-sm-7 col-md-8">
                    <p> </p>
                    <table class="table table-condensed table-hover">
                      <thead>
                        <tr>
                          <th colspan="3">General information</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Login ID:</td>
                          <td><?=$facultyDetails->faculty_user_id?>
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Designation</td>
                          <td><?=$fcultyDesignationArray[$facultyDetails->faculty_designation]?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Employee ID</td>
                          <td><?=$facultyDetails->faculty_employee_id?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Experience</td>
                          <td><?=$facultyDetails->faculty_years_of_experience?>
                            Years</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Class Incharge </td>
                          <td><?=$inchargeClass->class_name?>
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Bachelors </td>
                          <td><?=$facultyDetails->faculty_bachelors?>
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Role</td>
                          <td><span class="label label-sm label-info">Teacher</span></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Birth</td>
                          <td><?=$facultyDetails->faculty_dob?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Address</td>
                          <td><?=$facultyDetails->faculty_address?></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="editProfile" class="tab-pane">
                <div class="col-md-12">
                  <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
                  <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <h3>Account Info</h3>
                    <hr>
                  </div>
                  <form id="frmFaculty" action="<?=make_url('profile-faculty');?>" method="post" name="frmFaculty">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label"> Email Official </label>
                            <input type="email" placeholder="email@example.com" class="form-control" id="faculty_email_id" name="faculty_email_id" value="<?=$facultyDetails->faculty_email_id?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> Email Personal </label>
                            <input type="email" placeholder="email@example.com" class="form-control" id="faculty_email_personal" name="faculty_email_personal" value="<?=$facultyDetails->faculty_email_personal?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> Address </label>
                            <input type="text" placeholder="address" class="form-control" id="faculty_address" name="faculty_address" value="<?=$facultyDetails->faculty_address?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> Phone </label>
                            <input type="text" placeholder="1234567890" class="form-control" id="faculty_contact" name="faculty_contact" value="<?=$facultyDetails->faculty_contact?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> Mobile<span class="symbol required"></span> </label>
                            <input type="text" placeholder="1234567890" class="form-control" name="faculty_mobile" id="faculty_mobile" value="<?=$facultyDetails->faculty_mobile?>">
                          </div>
                        </div>
                      </div>
                      <div class="row" >
                        <div class="col-md-4" ></div>
                        <div class="col-md-3" >
                          <input class="btn btn-teal btn-block" type="submit" name="submit" value="Update">
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label> Image Upload </label>
                      <div class="user-left">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="user-image">
                            <div class="fileupload-new thumbnail"><img src="<?=($facultyDetails->faculty_image)?createImazeSize(get_small('faculty'),$facultyDetails->faculty_image,200,200):'design/images/avatar-1-xl.jpg'?>" alt=""> </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <form id="imageUpload1"  enctype="multipart/form-data" action="<?=make_url('profile-uploadimage','type=faculty&id='.$faculty_id.'&redirectTo='.$page)?>" method="post">
                              <div class="user-image-buttons"> <span class="btn btn-teal btn-file btn-sm"><span class="fileupload-new"><i class="fa fa-pencil"></i></span><span class="fileupload-exists"><i class="fa fa-pencil"></i></span>
                                <input type="file"  name="image" onChange="uoloadImage('imageUpload1');" accept="image/*">
                                </span> <a href="#" class="btn fileupload-exists btn-bricky btn-sm" data-dismiss="fileupload"> <i class="fa fa-times"></i>Remove </a> </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
  </div>
</div>
<!-- Main End -->
<!-- Footer Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
<!-- Footer End-->

</body>
</html>
