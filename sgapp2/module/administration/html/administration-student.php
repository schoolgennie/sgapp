<!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link rel="stylesheet" href="design/plugins/select2/select2.css">
<link rel="stylesheet" href="design/plugins/datepicker/css/datepicker.css">
<link rel="stylesheet" href="design/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="design/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="design/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
<link rel="stylesheet" href="design/plugins/jQuery-Tags-Input/jquery.tagsinput.css">
<link rel="stylesheet" href="design/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
<link rel="stylesheet" href="design/plugins/summernote/build/summernote.css">
<link rel="stylesheet" href="design/plugins/ckeditor/contents.css">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="design/plugins/autosize/jquery.autosize.min.js"></script>
<script src="design/plugins/select2/select2.min.js"></script>
<script src="design/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
<script src="design/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>
<script src="design/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="design/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="design/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script src="design/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="design/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="design/plugins/bootstrap-colorpicker/js/commits.js"></script>
<script src="design/plugins/jQuery-Tags-Input/jquery.tagsinput.js"></script>
<script src="design/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script src="design/plugins/summernote/build/summernote.min.js"></script>
<script src="design/plugins/ckeditor/ckeditor.js"></script>
<script src="design/plugins/ckeditor/adapters/jquery.js"></script>
<script src="design/js/form-elements.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: JAVASCRIPTS REQUIRED FOR validation -->
<script src="design/plugins/jquery-validation/dist/jquery.validate.js"></script>
<script src="design/js/form-validation.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR validation-->
<script>
			jQuery(document).ready(function() {
				FormElements.init();
				FormValidator.init();
			});
		</script>
<script>
          function createStudentToggle()
			{
			 $("#creatNewStudent").toggle();
			}
        </script>
<script>

		function searchResult()
		{
		
		$("#filter").submit();
		return true;
		
		}
		
	</script>
<script>
<!--check user od already exist or not-->
function checkUserIdExist(student_id)
{
student_user_id=$('#student_user_id').val();
$.ajax({
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=administration-studentajax",
		data:"mode=checkUserIdExist&student_user_id="+student_user_id+"&student_id="+student_id,
		success: function(output)
		 {
		   if(output)
		  {
		    $('#ckeckUserId').html(output);
		    $('#UserId').addClass('has-error').removeClass('has-success');
		    $('#UserId span.symbol').addClass('required').removeClass('ok');
		    return false;
		  } 
		  else
		  {
		   $('#ckeckUserId').html('');
		   $('#UserId').addClass('has-success').removeClass('has-error');
		   $('#UserId span.symbol').addClass('ok').removeClass('required');
		   
		  }	
		  
		}   
	});
}
<!--check user od already exist or not-->
function checkUserIdExistOnSubmit(student_id)
{
student_user_id=$('#student_user_id').val();
$.ajax({
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=administration-studentajax",
		data:"mode=checkUserIdExist&student_user_id="+student_user_id+"&student_id="+student_id,
		success: function(output)
		 {
		   if(output)
		  {
		    $('#ckeckUserId').html(output);
		    $('#UserId').addClass('has-error').removeClass('has-success');
		    $('#UserId span.symbol').addClass('required').removeClass('ok');
		    return false;
		  } 
		  else
		  {
		   $('#ckeckUserId').html('');
		   $('#UserId').addClass('has-success').removeClass('has-error');
		   $('#UserId span.symbol').addClass('ok').removeClass('required');
		   $('#frmStudent').submit();
		    return true;
		  }	
		  
		}   
	});
}
<!--check admission no already exist or not-->
function checkAdmissionNoExist(student_id)
{
student_admission_no=$('#student_admission_no').val();
if(student_admission_no)
{
$.ajax({
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=administration-studentajax",
		data:"mode=checkAdmissionNo&student_admission_no="+student_admission_no+"&student_id="+student_id,
		success: function(output)
		 {
		 
		   if(output)
		  {
		    $('#checkAdmissionNo').html(output);
		    $('#AdmissionNo').addClass('has-error').removeClass('has-success');
		    $('#AdmissionNo span.symbol').addClass('required').removeClass('ok');
		    return false;
		  } 
		  else
		  {
		   $('#checkAdmissionNo').html('');
		   $('#AdmissionNo').addClass('has-success').removeClass('has-error');
		   $('#AdmissionNo span.symbol').addClass('ok').removeClass('required');
		   
		  }	
		  
		}   
	});
}
}
<!--check roll no already exist or not-->
function checkRollNoExist(student_id)
{
student_roll_number=$('#student_roll_number').val();
if(student_roll_number)
{
$.ajax({
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=administration-studentajax",
		data:"mode=checkRollNo&student_roll_number="+student_roll_number+"&student_id="+student_id,
		success: function(output)
		 {
		
		   if(output)
		  {
		    $('#checkRollNo').html(output);
		    $('#RollNo').addClass('has-error').removeClass('has-success');
		    $('#RollNo span.symbol').addClass('required').removeClass('ok');
		    return false;
		  } 
		  else
		  {
		   $('#checkRollNo').html('');
		   $('#RollNo').addClass('has-success').removeClass('has-error');
		   $('#RollNo span.symbol').addClass('ok').removeClass('required');
		   
		  }	
		  
		}   
	});
}	
}
function getSubjectList(classId)
{
    $('#subjectList').hide();
	if(classId)
	{
	$.ajax({
			type: "POST",
			url: "<?=DIR_WS_SITE?>?page=administration-studentajax",
			data:"mode=subjectList&class_id="+classId,
			success: function(output)
			 {
			   if(output)
			  {
				$('#subjectList div.row').html(output);
				$('#subjectList').show();
			  } 		  
			}   
		});
	}
		
}
</script>
</head>
<body>
<!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<!-- start: MAIN CONTAINER -->
<div class="main-container">
  <!--Navigation Start -->
  <? include_once(DIR_FS_SITE_INCLUDE.'schoolNav.php'); ?>
  <!--Navigation End -->
  <div class="main-content">
    <?php display_form_error();?>
    <div class="container">
      <!-- start: PAGE HEADER -->
      <!-- end: PAGE HEADER -->
      <?
                    #handle sections here.
                    switch ($section):
				    case 'list':
				    ?>
      <!-- start: PAGE CONTENT -->
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <div class="alert alert-info">
              <label>Total Licence</label>
              <span class="badge badge-info">
              <?=$schoolDetail->school_student_create_limit?>
              </span>
              <label>Available Licence</label>
              <span class="badge badge-success">
              <?=$schoolDetail->school_student_create_limit-$totalStudent?>
              </span>
              <label>Used Licence</label>
              <span class="badge badge-warning">
              <?=$totalStudent?>
              </span> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <? if($schoolDetail->school_student_create_limit-$totalStudent!=0):?>
            <button class="btn btn-primary" type="button" onClick="window.location.href='<?=make_long_url('administration-student','insert','insert')?>'"> Enroll New Student <i class="clip-user-plus"></i></button>
            <? else:?>
            <button class="btn btn-primary" type="button" disabled > Enroll New Student </button>
            <? endif;?>
          </div>
          <div class="col-sm-4">
            <button type="button" class="btn btn-primary" value="Download" onClick="window.location.href='<?=make_long_url('administration-student', 'download', 'download');?>'">Download Template <i class="fa fa-download"></i></button>
            <? if($_SESSION['user_session']['set_student_unsuccessfull_list']):?>
            <button type="button" class="btn btn-danger" onClick="window.location.href='<?=make_long_url('administration-student', 'downloadNotSuccess', 'downloadNotSuccess');?>'">Failed Records <i class="fa fa-exclamation-triangle"></i></button>
            <? endif;?>
          </div>
          <div class="col-sm-4">
            <form name="" action="<?=make_long_url('administration-student', 'import', 'import');?>" method="post" enctype="multipart/form-data">
              <button class="btn btn-primary" type="submit"  name="submit" value="Upload">Upload Bulk <i class="fa fa-upload"></i></button>
              <input type="file" name="download">
            </form>
          </div>
        </div>
      </div>
      <!-- start: List Student -->
      <div class="row">
        <div class="col-md-12">
          <!-- start: TABLE WITH IMAGES PANEL -->
          <div class="panel panel-default">
            <div class="panel-body">
              <form action="<?=make_url('administration-student');?>" name="filter" id="filter" method="post">
                <div class="row">
                  <div class="col-md-4">
                    <div class="" >
                      <div class="form-group">
                        <label>Filter By Class </label>
                        <select name="class" id="class" class="form-control" onChange="searchResult();">
                          <option value=""> All Classes </option>
                          <? foreach($classList as $k=>$v):?>
                          <option value="<?=$v->class_id?>" <?=($class==$v->class_id)?'selected':'';?>>
                          <?=$v->class_name?>
                          </option>
                          <? endforeach;?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="col-sm-12">
                  <form  action="<?=make_long_url('administration-student', 'sendEmail', 'list');?>" method="post" >
                    <table class="table table-striped  table-hover" >
                      <thead>
                        <tr>
                          <th class="center"></th>
                          <th class="center">Photo</th>
                          <th>Full Name</th>
                          <th>User ID</th>
                          <th>Admission Number</th>
                         <th>Class</th>
                          <th >Roll Number</th>
                          <th >Phone</th>
                          <th> Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <? if($studentList->GetNumRows()>0):?>
                        <?  while($studentListing=$studentList->GetObjectFromRecord()):?>
                        <tr>
                          <td class="center"><? if($studentListing->student_is_active!=1 && $studentListing->student_is_active!=0):?>
                            <div class="checkbox-table">
                              <input type="checkbox" class="flat-green" name="sendmail[]" value="<?=$studentListing->student_id?>">
                            </div>
                            <? endif;?>
                          </td>
                          <td class="center"><img src="<?=($studentListing->student_image)?createImazeSize(get_small('student'),$studentListing->student_image,30,30):'design/images/avatar-1-small.jpg'?>" alt="image"/> </td>
                          <td ><strong><?=$studentListing->student_first_name.' '.$studentListing->student_last_name?></strong></td>
                          <td ><?=$studentListing->student_user_id?></td>
                          <td ><?=$studentListing->student_admission_no?></td>
                         <td><span class="label label-info "><?=get_object_by_query('class','class_id='.$studentListing->class_id)->class_name;?></span></td>
                          <td ><?=$studentListing->student_roll_number?></td>
                          <td ><?=$studentListing->student_contact?></td>
                          <td><? if($studentListing->student_is_active==1):?>
                            <span class="label label-success " >
                            <?=$statusArray[$studentListing->student_is_active]?>
                            </span>
							<? elseif($studentListing->student_is_active==2):?>
                            <span class="label label-primary " >
                            <?=$statusArray[$studentListing->student_is_active]?>
                            </span>
                            <? else:?>
                            <span class="label label-inverse ">
                            <?=$statusArray[$studentListing->student_is_active]?>
                            </span>
                            <? endif;?>
                          </td>
                          <td class="center"><div > 
                              <a href="<?=make_long_url('administration-student', 'update', 'update', 'student_id='.$studentListing->student_id)?>" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                              <a href="<?=make_long_url('administration-student', 'feeCollection', 'feeCollection', 'student_id='.$studentListing->student_id)?>" class="btn btn-xs btn-primary tooltips" data-placement="top" data-original-title="Fee Settings">Fees</a>
                              <? if($studentListing->student_is_active==1):?>
                              <a href="<?=make_long_url('administration-student', 'reset', 'list', 'student_id='.$studentListing->student_id)?>" class="btn btn-xs btn-orange tooltips" data-placement="top" data-original-title="Reset Password"><i class="fa fa-refresh fa fa-white"></i></a>
							  <a href="<?=make_long_url('administration-student', 'deactivate', 'list', 'student_id='.$studentListing->student_id)?>" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Deactivate"><i class="fa fa-ban fa fa-white"></i></a> 
							  
                              <? elseif($studentListing->student_is_active==0):?>
                              <a href="<?=make_long_url('administration-student', 'activate', 'list', 'student_id='.$studentListing->student_id)?>" class="btn btn-xs btn-purple tooltips" data-placement="top" data-original-title="Activate"><i class="clip-user-plus"></i></a>
                              <? endif;?>
                            </div></td>
                        </tr>
                        <? endwhile;?>
                        
                        <? else:?>
                        <tr>
                          <td colspan="8">No Student</td>
                        </tr>
                        <? endif;?>
                      </tbody>
                    </table>
					<div class="row">
                  	<div class="col-md-3">
						<input class="btn btn-purple btn-block" name="submit" type="submit" value="Activate New Account">
					</div>
					<div class="col-md-9">
						Select Users from list and Activate
					</div>
					</div>	
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- end: TABLE WITH IMAGES PANEL -->
        </div>
      </div>
      <!-- end: List Student -->
      <? 
				    break;
					case 'insert':
					?>
      <!-- start: Enroll Student -->
      <div class="row" id="creatNewStudent" >
        <div class="col-md-12">
          <div class="">
            <div class="panel-body">
              <h2><i class="fa fa-pencil-square teal"></i> Enroll Student</h2>
              <p> Fill up form and create new student </p>
              <hr>
              <form name="frmStudent" id="frmStudent" action="<?=make_long_url('administration-student', 'insert', 'list',($preRegisterId)?'preRegisterId='.$preRegisterId:'');?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12">
                    <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
                    <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group" id="UserId">
                              <label class="control-label"> User ID <span class="symbol required"></span> </label>
                              <input type="text" placeholder="User ID " class="form-control" id="student_user_id" name="student_user_id" onBlur="checkUserIdExist()">
                              <span  id="ckeckUserId" style="color:#b94a48"></span> </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Class <span class="symbol required"></span> </label>
                              <select name="class_id" id="class_id" class="form-control" onChange="getSubjectList(this.value)">
                                <option value="">- Select Class -</option>
                                <? foreach($classList as $k=>$v):?>
                                <option value="<?=$v->class_id?>">
                                <?=$v->class_name?>
                                </option>
                                <? endforeach;?>
                              </select>
                            </div>
                          </div>
                        </div>
                         <div class="row">
                          <div class="col-md-12">
                              <div class="form-group" id="subjectList" style="display:none">
                                   <label class="control-label"> Sublect </label>
                                   <div class="panel panel-default">
                                   <div class="panel-body">
                                   <div class="checkbox">
                                    <div class="row">
                                      
                                        </div>
                                      </div>  
                                   </div>
                                </div>
                              </div>
                            
                           </div>
                         </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> First Name <span class="symbol required"></span> </label>
                              <input type="text" placeholder="" class="form-control" id="student_first_name" name="student_first_name" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_first_name:''?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Last Name </label>
                              <input type="text" placeholder="" class="form-control " id="student_last_name" name="student_last_name" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_last_name:''?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Date of Birth <span class="symbol "></span> </label>
                              <input type="text" placeholder="DD-MM-YYYY" class="form-control date-picker" id="student_dob" name="student_dob" data-date-format="dd-mm-yyyy" value="<?=($preRegisterStudentDetails)?ToIndianDate($preRegisterStudentDetails->student_pre_registration_dob):''?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Gender <span class="symbol "></span> </label>
                              <div>
                                <label class="radio-inline">
                                <input type="radio" class="grey" value="female" name="student_gender" id="student_gender">
                                Female </label>
                                <label class="radio-inline">
                                <input type="radio" class="grey" value="male" name="student_gender"  id="student_gender">
                                Male </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Primary Mobile Number <span class="symbol "></span> </label>
                              <input type="text" placeholder="For SMS Notifications" class="form-control" id="student_contact" name="student_contact">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Primary Email ID </label>
                              <input type="email" placeholder="For Email Notifications" class="form-control" id="student_email_id" name="student_email_id" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_email:''?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group" id="AdmissionNo">
                              <label class="control-label"> Admission Number <span class="symbol "></span> </label>
                              <input class="form-control" placeholder="" type="text" name="student_admission_no" id="student_admission_no" onBlur="checkAdmissionNoExist()">
                              <span  id="checkAdmissionNo" style="color:#b94a48"></span> </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group" id="RollNo">
                              <label class="control-label"> Roll Number <span class="symbol "></span> </label>
                              <input class="form-control" placeholder="" type="text" name="student_roll_number" id="student_roll_number" onBlur="checkRollNoExist()">
                              <span  id="checkRollNo" style="color:#b94a48"></span> </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Transport </label>
                              <div>
                                <label class="radio-inline">
                                <input type="radio" class="grey" value="Personal" name="student_transport_type" id="student_transport_type">
                                Personal </label>
                                <label class="radio-inline">
                                <input type="radio" class="grey" value="School Vehicle" name="student_transport_type"  id="student_transport_type">
                                School Vehicle </label>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group ">
                              <label class="control-label">Nationality <span class="symbol "></span> </label>
                              <input type="text" placeholder="" class="form-control" id="student_nationality" name="student_nationality" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Admission Date <span class="symbol "></span> </label>
                              <input class="form-control date-picker" placeholder="DD-MM-YYYY" type="text" name="student_with_school_since" id="student_with_school_since" data-date-format="dd-mm-yyyy">
                              
                            </div>
                          </div>
                          <div class="col-md-6">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Country <span class="symbol "></span> </label>
                              <input class="form-control"  type="text" name="student_country" id="student_country" value="" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> State <span class="symbol "></span> </label>
                              <select name="student_state" id="student_state"  class="form-control ">
                                <option value="">-- Select State --</option>
                                <? foreach($stateArray as $k=>$v):?>
                                <option value="<?=$v?>">
                                <?=$v?>
                                </option>
                                <? endforeach;?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group connected-group">
                              <label class="control-label"> City  </label>
                              <input type="text" placeholder="" class="form-control" id="student_city" name="student_city" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group connected-group">
                              <label class="control-label"> Zip Code </label>
                              <input type="text" placeholder="" class="form-control" id="student_zip" name="student_zip" >
                            </div>
                          </div>
                        </div>
                        <div class="form-group connected-group">
                          <label class="control-label"> Address <span class="symbol "></span> </label>
                          <textarea class="autosize form-control" placeholder="Address" id="student_address" name="student_address" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 69px;"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-heading"> Father Information
                        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> First Name </label>
                              <input class="form-control" placeholder="" type="text" name="student_father_first_name" id="student_father_first_name" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_father_first_name:''?>" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Last Name </label>
                              <input class="form-control" placeholder="" type="text" name="student_father_last_name" id="student_father_last_name" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_father_last_name:''?>" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Occupation </label>
                              <input type="text" placeholder="" class="form-control" id="student_father_occupation" name="student_father_occupation" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_father_occupation:''?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Contact Number </label>
                              <input type="text" placeholder="" class="form-control" id="student_father_mobile" name="student_father_mobile" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_father_mobile:''?>">
                            </div>
                          </div>
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading"> Mother Information
                        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> First Name </label>
                              <input class="form-control" placeholder="" type="text" name="student_mother_first_name" id="student_mother_first_name" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_mother_first_name:''?>" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Last Name </span></label>
                              <input class="form-control" placeholder="" type="text" name="student_mother_last_name" id="student_mother_last_name" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_mother_last_name:''?>" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Occupation </label>
                              <input type="text" placeholder="" class="form-control" id="student_mother_occupation" name="student_mother_occupation" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_mother_occupation:''?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Contact Number </label>
                              <input type="text" placeholder="" class="form-control" id="student_mother_mobile" name="student_mother_mobile" value="<?=($preRegisterStudentDetails)?$preRegisterStudentDetails->student_pre_registration_mother_mobile:''?>">
                            </div>
                          </div>
                        </div>
                        
                        
                      </div>
                    </div>
                    
                    <div class="panel panel-default">
                      <div class="panel-heading"> Emergency Contact Person
                        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Name </label>
                              <input type="text" placeholder="" class="form-control" id="student_emergency_contact_person_name" name="student_emergency_contact_person_name" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Relation </label>
                              <input type="text" placeholder="" class="form-control" id="student_emergency_contact_person_relation" name="student_emergency_contact_person_relation" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Mobile </label>
                              <input type="text" placeholder="" class="form-control" id="student_emergency_contact_person_mobile" name="student_emergency_contact_person_mobile" >
                            </div>
                          </div>
                          <div class="col-md-6"> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div> <span class="symbol required"></span>Required Fields
                      <hr>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4"> </div>
                  <div class="col-md-2">
                    <input type="button" class="btn btn-gray btn-block" value="Cancel" onClick="window.location.href='<?=make_url('administration-student')?>'">
                  </div>
                  <div class="col-md-2">
                    <input type="hidden" name="validate" value="Register">
                    <input class="btn btn-primary btn-block" type="button" onClick="checkUserIdExistOnSubmit()" value="Register">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- end: Enroll Student -->
      <?
					break;
					case 'update':
					?>
      
      <!-- start: Enroll Student -->
      <div class="row" id="creatNewStudent" >
        <div class="col-md-12">
          <div class="">
            <div class="panel-body">
              <h2><i class="fa fa-pencil-square teal"></i> Update Student</h2>
              <p> Update Student Information </p>
              <hr>
              <form id="frmStudent" action="<?=make_long_url('administration-student', 'update', 'list','student_id='.$student_id);?>" method="post" name="frmStudent" >
                <div class="row">
                  <div class="col-md-12">
                    <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
                    <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group" id="UserId">
                              <label class="control-label"> User ID <span class="symbol required"></span> </label>
                              <input type="text" placeholder="User ID" class="form-control" id="student_user_id" name="student_user_id" value="<?=$studentDetails->student_user_id?>" onBlur="checkUserIdExist(<?=$studentDetails->student_id?>)">
                              <span  id="ckeckUserId" style="color:#b94a48"></span> </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Class <span class="symbol required"></span> </label>
                              <select name="class_id" id="class_id" class="form-control" onChange="getSubjectList(this.value)">
                                <option value="">- Select Class -</option>
                                <? foreach($classList as $k=>$v):?>
                                <option value="<?=$v->class_id?>" <?=($studentDetails->class_id==$v->class_id)?'selected':'';?>>
                                <?=$v->class_name?>
                                </option>
                                <? endforeach;?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                          
                            <div class="form-group" id="subjectList">
                               <label class="control-label"> Subject </label>
                               <div class="panel panel-default">
                               <div class="panel-body">
                               <div class="checkbox">
                               	<div class="row">
                                   <? if($subjectList):?>
									 <? foreach($subjectList as $k=>$v):?>
                                      <div class="col-sm-4">
                                      <?=$v->subject_name;?>
                                      <input type="checkbox" <?=in_array($v->faculty_management_id,$studentSubjectListArray)?'checked':'';?> class="flat-green" id="faculty_management_id" name="faculty_management_id[]" value="<?=$v->faculty_management_id?>">
                                      </div>
                                      <? endforeach;?>
                                    <? else:?>
                                      No Subject List
                                    <? endif;?>
                                    </div>
                                  </div>  
                               </div>
                            </div>
                          </div>  
                           </div>
                         </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> First Name <span class="symbol required"></span> </label>
                              <input type="text" placeholder="" class="form-control" id="student_first_name" name="student_first_name" value="<?=$studentDetails->student_first_name?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Last Name </label>
                              <input type="text" placeholder="" class="form-control " id="student_last_name" name="student_last_name" value="<?=$studentDetails->student_last_name?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Date of Birth <span class="symbol "></span> </label>
                              <input type="text" placeholder="DD-MM-YYYY" class="form-control date-picker" id="student_dob" name="student_dob" data-date-format="dd-mm-yyyy" value="<?=ToIndianDate($studentDetails->student_dob);?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Gender <span class="symbol "></span> </label>
                              <div>
                                <label class="radio-inline">
                                <input type="radio" class="grey" value="female" name="student_gender" id="student_gender" <?=($studentDetails->student_gender=='female')?'checked':'';?>>
                                Female </label>
                                <label class="radio-inline">
                                <input type="radio" class="grey" value="male" name="student_gender"  id="student_gender" <?=($studentDetails->student_gender=='male')?'checked':'';?>>
                                Male </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Primary Mobile Number <span class="symbol "></span> </label>
                              <input type="text" placeholder="For SMS Notifications" class="form-control" id="student_contact" name="student_contact" value="<?=$studentDetails->student_contact?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Primary Email ID </label>
                              <input type="email" placeholder="For Email Notifications" class="form-control" id="student_email_id" name="student_email_id" value="<?=$studentDetails->student_email_id?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group" id="AdmissionNo">
                              <label class="control-label"> Admission Number <span class="symbol "></span> </label>
                              <input class="form-control" placeholder="" type="text" name="student_admission_no" id="student_admission_no" onBlur="checkAdmissionNoExist(<?=$studentDetails->student_id?>)" value="<?=$studentDetails->student_admission_no?>">
                              <span  id="checkAdmissionNo" style="color:#b94a48"></span> </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group" id="RollNo">
                              <label class="control-label"> Roll Number <span class="symbol "></span> </label>
                              <input class="form-control" placeholder="" type="text" name="student_roll_number" id="student_roll_number" onBlur="checkRollNoExist(<?=$studentDetails->student_id?>)" value="<?=$studentDetails->student_roll_number?>">
                              <span  id="checkRollNo" style="color:#b94a48"></span> </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Transport </label>
                              <div>
                                <label class="radio-inline">
                                <input type="radio" class="grey" value="Personal" name="student_transport_type" id="student_transport_type" <?=($studentDetails->student_transport_type=='Personal')?'checked':'';?>>
                                Personal </label>
                                <label class="radio-inline">
                                <input type="radio" class="grey" value="School Vehicle" name="student_transport_type"  id="student_transport_type" <?=($studentDetails->student_transport_type=='School Vehicle')?'checked':'';?>>
                                School Vehicle </label>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group ">
                              <label class="control-label">Nationality <span class="symbol "></span> </label>
                              <input type="text" placeholder="" class="form-control" id="student_nationality" name="student_nationality" value="<?=$studentDetails->student_nationality?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Admission Date <span class="symbol "></span> </label>
                              <input class="form-control date-picker" placeholder="DD-MM-YYYY" type="text" name="student_with_school_since" id="student_with_school_since" data-date-format="dd-mm-yyyy" value="<?=$studentDetails->student_with_school_since?>">
                              
                            </div>
                          </div>
                          <div class="col-md-6">
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Country <span class="symbol "></span> </label>
                              <input class="form-control" placeholder="" type="text" name="student_country" id="student_country" value="<?=$studentDetails->student_country?>" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> State <span class="symbol "></span> </label>
                              <select name="student_state" id="student_state"  class="form-control ">
                                <option value="">-- Select State --</option>
                                <? foreach($stateArray as $k=>$v):?>
                                <option value="<?=$v?>" <?=($studentDetails->student_state==$v)?'selected':'';?>>
                                <?=$v?>
                                </option>
                                <? endforeach;?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group connected-group">
                              <label class="control-label"> City <span class="symbol "></span> </label>
                              <input type="text" placeholder="" class="form-control" id="student_city" name="student_city" value="<?=$studentDetails->student_city?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group connected-group">
                              <label class="control-label"> Zip Code<span class="symbol "></span> </label>
                              <input type="text" placeholder="" class="form-control" id="student_zip" name="student_zip" value="<?=$studentDetails->student_zip?>">
                            </div>
                          </div>
                        </div>
                        <div class="form-group connected-group">
                          <label class="control-label"> Address <span class="symbol "></span> </label>
                          <textarea class="autosize form-control" placeholder="Address" id="student_address" name="student_address" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 69px;"><?=$studentDetails->student_address?>
</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-heading"> Father Information
                        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> First Name </label>
                              <input class="form-control" placeholder="" type="text" name="student_father_first_name" id="student_father_first_name" value="<?=$studentDetails->student_father_first_name?>" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Last Name </label>
                              <input class="form-control" placeholder="" type="text" name="student_father_last_name" id="student_father_last_name" value="<?=$studentDetails->student_father_last_name?>" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Occupation </label>
                              <input type="text" placeholder="" class="form-control" id="student_father_occupation" name="student_father_occupation" value="<?=$studentDetails->student_father_occupation?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Contact Number </label>
                              <input type="text" placeholder="" class="form-control" id="student_father_mobile" name="student_father_mobile" value="<?=$studentDetails->student_father_mobile?>">
                            </div>
                          </div>
                        </div>
                        
                        
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading"> Mother Information
                        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> First Name </label>
                              <input class="form-control" placeholder="" type="text" name="student_mother_first_name" id="student_mother_first_name" value="<?=$studentDetails->student_mother_first_name?>" >
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Last Name </label>
                              <input class="form-control" placeholder="" type="text" name="student_mother_last_name" id="student_mother_last_name" value="<?=$studentDetails->student_mother_last_name?>" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Occupation </label>
                              <input type="text" placeholder="" class="form-control" id="student_mother_occupation" name="student_mother_occupation" value="<?=$studentDetails->student_mother_occupation?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Contact Number </label>
                              <input type="text" placeholder="" class="form-control" id="student_mother_mobile" name="student_mother_mobile" value="<?=$studentDetails->student_mother_mobile?>">
                            </div>
                          </div>
                        </div>
                        
                        
                      </div>
                    </div>
                    
                    <div class="panel panel-default">
                      <div class="panel-heading"> Emergency Contact Person
                        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Name </label>
                              <input type="text" placeholder="" class="form-control" id="student_emergency_contact_person_name" name="student_emergency_contact_person_name" value="<?=$studentDetails->student_emergency_contact_person_name?>">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Relation </label>
                              <input type="text" placeholder="" class="form-control" id="student_emergency_contact_person_relation" name="student_emergency_contact_person_relation" value="<?=$studentDetails->student_emergency_contact_person_relation?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"> Mobile </label>
                              <input type="text" placeholder="" class="form-control" id="student_emergency_contact_person_mobile" name="student_emergency_contact_person_mobile" value="<?=$studentDetails->student_emergency_contact_person_mobile?>">
                            </div>
                          </div>
                          <div class="col-md-6"> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div> <span class="symbol required"></span>Required Fields
                      <hr>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4"> </div>
                  <div class="col-md-2">
                    <input type="button" class="btn btn-gray btn-block" value="Cancel" onClick="window.location.href='<?=make_url('administration-student')?>'">
                  </div>
                  <div class="col-md-2">
                    <input type="hidden" name="validate" value="Update">
                    <input class="btn btn-primary btn-block" type="button" onClick="checkUserIdExistOnSubmit(<?=$studentDetails->student_id?>)" value="Update">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- end: Enroll Student -->
      <?
					break;
	case 'feeCollection':
	?>
      <!-- start: PAGE CONTENT -->
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header">
                <h1>Student Fees Structure</h1>
              </div>
            </div>
          </div>
          <!-- start: ACCORDION PANEL -->
          <div class="panel panel-default">
            
            <div class="panel-body">
			<div class="row">
	  <div class="col-md-4 ">
		<table class="table table-condensed table-hover">
		  <thead>
			<tr>
			  <h4 align="center">
			  <?=$studentDetails->student_first_name.' '.$studentDetails->student_last_name?>
			</h4>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td>Roll Number</td>
			  <td><?=$studentDetails->student_roll_number?>
			  </td>
			  <td></td>
			</tr>
			<tr>
			  <td>Class</td>
			  <td><?=get_object_by_query('class','class_id='.$studentDetails->class_id)->class_name;?></td>
			  <td></td>
			</tr>
			<tr>
			  <td>Father Name</td>
			  <td><?=$studentDetails->student_father_first_name.' '.$studentDetails->student_father_last_name?></td>
			  <td></td>
			</tr>
			
			<tr>
			  <td>Primary Contact Number </td>
			  <td><?=$studentDetails->student_contact?>
			  </td>
			  <td></td>
			</tr>
		   
		  </tbody>
		</table>
	  </div>
	   
	</div>
            <form id="frmStudentFeeCollection" action="<?=make_long_url('administration-student', 'feeCollection', 'feeCollection','student_id='.$student_id);?>" method="post" name="frmStudentFeeCollection" >
              
                
                 
                    <? if($feeCollectionTypetList):?>
                    <? foreach($feeCollectionTypetList as $feeCollectionTypetListKey=>$feeCollectionTypetListValue):?>
					
					<?=($feeCollectionTypetListKey%2)==1?'': '<div class="row">'; ?>
					<div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <h3>
                          <?=$feeCollectionTypetListValue->fee_collection_type?>
                        </h3>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="">
                              <table class="table table-condensed table-hover">
                                <thead>
                                  <tr>
                                    <th>Fees Category</th>
                                    <th>Amount</th>
                                    <th>Notes</th>
                                    <th>Students</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <? 
							  #fetch fee collection type list
                              $feeStructuretList=get_all_record_by_query('fee_structure as a,fee_category as b','a.fee_collection_type_id="'.$feeCollectionTypetListValue->fee_collection_type_id.'" and a.class_id="'.$class.'" and b.fee_category_id=a.fee_category_id');
							 
							  ?>
                                <? if($feeStructuretList):?>
                                <tbody>
                                  <? foreach($feeStructuretList as $k=>$v):?>
                                  <tr>
                                    <td><?=ucfirst($v->fee_category);?></td>
                                    <td><?=$v->fee_structure_amount;?></td>
                                    <td><?=$v->fee_structure_notes;?></td>
                                    <td><div class="checkbox-table">
                                        <input type="checkbox" class="flat-green" name="fee_structure_id[]" value="<?=$v->fee_structure_id?>" <?=in_array($student_id,feeCollectionManagementtList($v->fee_structure_id))?'checked="checked"':'';?>>
                                      </div></td>
                                  </tr>
                                  <? endforeach;?>
                                </tbody>
                                <? endif;?>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
					</div>
					<?=($feeCollectionTypetListKey%2)==0?'':'</div>'; ?>
                    <? endforeach;?>
					<?=($feeCollectionTypetListKey%2)==1?'':'</div>'; ?>
                    <? endif;?>
                  
               
             
              <div class="row">
                <div class="col-sm-12" align="center">
                  <input type="hidden" name="student_id" value="<?=$student_id?>" />
                  
                  <button type="submit" name="submit" value="Save" class="btn btn-purple"> Save </button>
                  <a class="btn btn-med-grey" href="<?=make_url('administration-student')?>" > Cancel</a>
                </div>
              </div>
              </form>
            </div>
          </div>
          <!-- end: ACCORDION PANEL -->
        </div>
      </div>
      <?
	
	 break;				
				    default:break;
                    endswitch;
                    ?>
      <!-- end: PAGE CONTENT-->
    </div>
  </div>
  <!--End App Container	-->
  <!-- Footer Start-->
  <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
  <!-- Footer End-->
</div>
<!-- Main End -->
</body>
</html>
