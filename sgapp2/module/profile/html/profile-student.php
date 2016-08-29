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
		url: "<?=DIR_WS_SITE?>?page=profile-studentajax",
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
  <? include_once(DIR_FS_SITE_INCLUDE.'studentNav.php'); ?>
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
                          <?=$studentDetails->student_first_name?>
                          <?=$studentDetails->student_last_name?>
                        </h4>
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="user-image">
                            <div class="fileupload-new thumbnail"><img src="<?=($studentDetails->student_image)?createImazeSize(get_small('student'),$studentDetails->student_image,200,200):'design/images/avatar-1-xl.jpg'?>" alt=""> </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <form id="imageUpload"  enctype="multipart/form-data" action="<?=make_url('profile-uploadimage','type=student&id='.$student_id.'&redirectTo='.$page)?>" method="post">
                              <div class="user-image-buttons"> <span class="btn btn-teal btn-file btn-sm"><span class="fileupload-new"><i class="fa fa-pencil"></i></span><span class="fileupload-exists"><i class="fa fa-pencil"></i></span>
                                <input type="file" name="image" onChange="uoloadImage('imageUpload');" accept="image/*">
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
                            <td>Contact No.</td>
                            <td><?=$studentDetails->student_contact?></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Father Email Id:</td>
                            <td><?=$studentDetails->student_father_email_id?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Mother Email Id:</td>
                            <td><?=$studentDetails->student_mother_email_id?>
                            </td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Father Contact No:</td>
                            <td><?=$studentDetails->student_father_phone?></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Mother Contact No:</td>
                            <td><?=$studentDetails->student_mother_phone?>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-sm-7 col-md-8">
                    <p> </p>
                    <div class="row">
                      <div class="col-sm-3">
                        <button class="btn btn-icon btn-block pulsate"> <i class="clip-bubble-2"></i> Messages <span class="badge badge-info"> 23 </span> </button>
                      </div>
                      <div class="col-sm-3">
                        <button class="btn btn-icon btn-block"> <i class="clip-calendar"></i> Calendar <span class="badge badge-info"> 5 </span> </button>
                      </div>
                      <div class="col-sm-3">
                        <button class="btn btn-icon btn-block"> <i class="clip-list-3"></i> Notifications <span class="badge badge-info"> 9 </span> </button>
                      </div>
                    </div>
                    <table class="table table-condensed table-hover">
                      <thead>
                        <tr>
                          <th colspan="3">General information</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Login ID:</td>
                          <td><?=$studentDetails->student_user_id?>
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Prefered Email ID:</td>
                          <td><?=$studentDetails->student_email_id?>
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Gender</td>
                          <td><?=$studentDetails->student_gender?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Date of Birth</td>
                          <td><?=$studentDetails->student_dob?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Class</td>
                          <td><?=get_object_by_query('class','class_id='.$studentDetails->class_id)->class_name;?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Admission No. </td>
                          <td><?=$studentDetails->student_admission_no?>
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Roll No. </td>
                          <td><?=$studentDetails->student_roll_number?>
                          </td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>With School Since </td>
                          <td><?=$studentDetails->student_with_school_since?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Father First Name</td>
                          <td><?=$studentDetails->student_father_first_name?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Father Last Name</td>
                          <td><?=$studentDetails->student_father_last_name?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Mother First Name</td>
                          <td><?=$studentDetails->student_mother_first_name?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>Mother Last Name</td>
                          <td><?=$studentDetails->student_mother_last_name?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td style="vertical-align:top">Address</td>
                          <td><?=$studentDetails->student_address.'<br/>'.$studentDetails->student_city.'<br/>'.$studentDetails->student_state.'<br/>'.$studentDetails->student_country.'<br/>'.$studentDetails->student_zip?></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="editProfile" class="tab-pane">
                <div class="row">
                  <div class="col-md-12">
                    <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
                    <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
                  </div>
                  <div class="col-md-12">
                    <h3>Account Info</h3>
                    <hr>
                  </div>
                  <div class="col-md-6">
                    <form id="frmStudent" action="<?=make_url('profile-student');?>" method="post" name="frmStudent">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label"> Contact No.<span class="symbol required"></span> </label>
                            <input type="text" placeholder="1234567890" class="form-control" id="student_contact" name="student_contact" value="<?=$studentDetails->student_contact?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> Father Contact No </label>
                            <input type="text" placeholder="1234567890" class="form-control" id="student_father_phone" name="student_father_phone" value="<?=$studentDetails->student_father_phone?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> Father Email Id </label>
                            <input type="email" placeholder="email@example.com" class="form-control" id="student_father_email_id" name="student_father_email_id" value="<?=$studentDetails->student_father_email_id?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> Mother Contact No </label>
                            <input type="text" placeholder="1234567890" class="form-control" id="student_mother_phone" name="student_mother_phone" value="<?=$studentDetails->student_mother_phone?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> Mother Email Id </label>
                            <input type="email" placeholder="email@example.com" class="form-control" id="student_mother_email_id" name="student_mother_email_id" value="<?=$studentDetails->student_mother_email_id?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> Address </label>
                            <input type="text" placeholder="address" class="form-control" id="student_address" name="student_address" value="<?=$studentDetails->student_address?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> State<span class="symbol required"></span> </label>
                            <select name="student_state"  class="form-control" >
                              <option value="">--State--</option>
                              <? foreach($stateArray as $k=>$v):?>
                              <option value="<?=$v?>" <?=($studentDetails->student_state==$v)?'selected="selected"':'';?>>
                              <?=$v?>
                              </option>
                              <? endforeach;?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="control-label"> City<span class="symbol required"></span> </label>
                            <input type="text" placeholder="City" class="form-control" name="student_city" id="student_city" value="<?=$studentDetails->student_city?>">
                          </div>
                          <div class="form-group">
                            <label class="control-label"> Zip </label>
                            <input type="text" placeholder="123456" class="form-control" name="student_zip" id="student_zip" value="<?=$studentDetails->student_zip?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-3">
                          <input class="btn btn-teal btn-block" type="submit" name="submit" value="Update">
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label> Image Upload </label>
                      <div class="user-left">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="user-image">
                            <div class="fileupload-new thumbnail"><img src="<?=($studentDetails->student_image)?createImazeSize(get_small('student'),$studentDetails->student_image,200,200):'design/images/avatar-1-xl.jpg'?>" alt=""> </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <form id="imageUpload1"  enctype="multipart/form-data" action="<?=make_url('profile-uploadimage','type=student&id='.$student_id.'&redirectTo='.$page)?>" method="post">
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
                <form id="frmChangePassword" name="frmChangePassword" action="<?=make_url('profile-studentchangepassword')?>" method="post" >
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
<!-- Footer Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
<!-- Footer End-->
<!-- Main End -->
</body>
</html>
