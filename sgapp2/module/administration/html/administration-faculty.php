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
<script src="design/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="design/js/form-validation.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR validation-->
<script>
			jQuery(document).ready(function() {
			    FormValidator.init();
				FormElements.init();
			});
		</script>

<script>
function checkUserIdExist(faculty_id)
{
faculty_user_id=$('#faculty_user_id').val();
$.ajax({
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=administration-facultyajax",
		data:"mode=checkUserIdExist&faculty_user_id="+faculty_user_id+"&faculty_id="+faculty_id,
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
function checkUserIdExistOnSubmit(faculty_id)
{
faculty_user_id=$('#faculty_user_id').val();
$.ajax({
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=administration-facultyajax",
		data:"mode=checkUserIdExist&faculty_user_id="+faculty_user_id+"&faculty_id="+faculty_id,
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
		  $('#frmFaculty').submit();
		    return true;
		  }	
		  
		}   
	});
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
      <div class="row">
        <div class="col-sm-12">
         <div class="page-header">
		 <h1>Faculty Management</h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <?
                    #handle sections here.
                    switch ($section):
				    case 'list':
				    ?>
      <!-- start: PAGE CONTENT -->
      <div class="panel-body">
        <div class="col-sm-4">
          <button class="btn btn-primary" type="button" onClick="window.location.href='<?=make_long_url('administration-faculty','insert','insert')?>'"> Enroll New Faculty <i class="clip-user-plus"></i></button>
        </div>
		<div class="col-sm-3"></div>
        <div class="col-sm-3">
          <button class="btn btn-primary" type="button"  onClick="window.location.href='<?=make_long_url('administration-faculty', 'download', 'download');?>'">Template <i class="fa fa-download"></i></button>
          <? if($_SESSION['user_session']['set_faculty_unsuccessfull_list_session_id']):?>
          <button class="btn btn-danger" type="button"  onClick="window.location.href='<?=make_long_url('administration-faculty', 'downloadNotSuccess', 'downloadNotSuccess');?>'">Fail <i class="fa fa-exclamation-triangle"></i></button>
          <? endif;?>
        </div>
        <div class="col-sm-2">
          <form name="" action="<?=make_long_url('administration-faculty', 'import', 'import');?>" method="post" enctype="multipart/form-data">
            <button class="btn btn-primary" type="submit"  name="submit" value="Upload">Upload Bulk <i class="fa fa-upload"></i></button>
            <input type="file" name="download">
          </form>
          <!--<button class="btn btn-primary hidden-xs" type="button">  Enroll Bulk Faculty </button>-->
        </div>
      </div>
      <!-- start: List Faculty -->
      <div class="row">
        <div class="col-md-12">
          <!-- start: TABLE WITH IMAGES PANEL -->
          <div class="panel panel-default">
            
            <div class="panel-body">
             <form  action="<?=make_long_url('administration-faculty', 'sendEmail', 'list');?>" method="post" >
              <table class="table table-striped  table-hover" >
                <thead>
                  <tr>
                    <th class="center"></th>
                    <th class="center">Photo</th>
                    <th>Full Name</th>
                    <th>Category</th>
                    <th >Employee ID</th>
                    <th >Phone</th>
                    <th> Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <? if($facultyList):?>
               
                  <? foreach($facultyList as $k=>$v):?>
                  <tr>
                    <td class="center">
					<? if($v->faculty_is_active!=1):?>
					<div class="checkbox-table">
                        <input type="checkbox" class="flat-green" name="sendmail[]" value="<?=$v->faculty_id?>">
                      </div>
					  <? endif;?>
					  </td>
                    <td class="center"><img src="<?=($v->faculty_image)?createImazeSize(get_small('faculty'),$v->faculty_image,30,30):'design/images/avatar-1-small.jpg'?>" alt="image"/> </td>
                    <td class="teal"><strong> <?=$v->faculty_first_name.' '.$v->faculty_last_name?></strong></td>
                    <td><span class="label label-info ">
                      <?=ucfirst($fcultyDesignationArray[$v->faculty_designation])?>
                      </span></td>
                    <td ><?=$v->faculty_employee_id?></td>
                    
                    <td ><?=$v->faculty_mobile?></td>
                    <td><? if($v->faculty_is_active==1):?>
                      <span class="label label-success ">
                      <?=$statusArray[$v->faculty_is_active]?>
                      </span>
					  <? elseif($v->faculty_is_active==2):?>
                      <span class="label label-primary ">
                      <?=$statusArray[$v->faculty_is_active]?>
                      </span>
                      <? else:?>
                      <span class="label label-inverse ">
                      <?=$statusArray[$v->faculty_is_active]?>
                      </span>
                      <? endif;?>
                    </td>
                    <td class="center"><div class=""> <a href="<?=make_long_url('administration-faculty', 'update', 'update', 'faculty_id='.$v->faculty_id)?>" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                        <? if($v->faculty_is_active==1):?>
                        <a href="<?=make_long_url('administration-faculty', 'reset', 'list', 'faculty_id='.$v->faculty_id)?>" class="btn btn-xs btn-orange tooltips" data-placement="top" data-original-title="Reset"><i class="fa fa-refresh fa fa-white"></i></a>
						<a href="<?=make_long_url('administration-faculty', 'deactivate', 'list', 'faculty_id='.$v->faculty_id)?>" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Deactivate"><i class="fa fa-ban fa fa-white"></i></a> 
						
                        <? elseif($v->faculty_is_active==0):?>
                        <a href="<?=make_long_url('administration-faculty', 'activate', 'list', 'faculty_id='.$v->faculty_id)?>" class="btn btn-xs btn-primary tooltips" data-placement="top" data-original-title="Activate"><i class="fa fa-check "></i></a>
                        <? endif;?>
                      </div></td>
                  </tr>
                  <? endforeach;?>
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
          <!-- end: TABLE WITH IMAGES PANEL -->
        </div>
      </div>
      <!-- start: List Faculty -->
      <? break;
					case 'insert':
					?>
        
      <!-- start: Enroll / Edit Faculty -->
      <div class="row">
        <div class="col-md-12">
            
            <div class="panel-body">
              <h2><i class="fa fa-pencil-square teal"></i> Enroll Faculty</h2>
              <p> Fill up form and create new faculty account </p>
              <hr>
              <form id="frmFaculty" action="<?=make_long_url('administration-faculty', 'insert', 'list');?>" method="post" name="frmFaculty" >
                <div class="row">
                  <div class="col-md-12">
                    <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
                    <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
                  </div>
                  <div class="col-md-6">
				  	<div class="row">
                      	<div class="col-md-6">
							<div class="form-group" id="UserId">
							  <label class="control-label"> User Id <span class="symbol required"></span> </label>
							  <input type="text" placeholder="User Id" class="form-control" id="faculty_user_id" name="faculty_user_id" onBlur="checkUserIdExist()">
							  <span  id="ckeckUserId" style="color:#b94a48"></span> 
							  </div>
						</div>	  
						<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label"> Preffered Email </label>
							  <input type="email" placeholder="To Receive Email Notifications" class="form-control" id="faculty_email_id" name="faculty_email_id">
							</div>
						</div>
					</div>		
					<div class="row">
                      	<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label"> Mobile No <span class="symbol required"></span> </label>
							  <input type="text" placeholder="To Receive SMS Notifications" class="form-control" id="faculty_mobile" name="faculty_mobile">
							</div>
						</div>
						<div class="col-md-6">	
							<div class="form-group">
							  <label class="control-label"> Phone No </label>
							  <input type="text" placeholder="" class="form-control" id="faculty_contact" name="faculty_contact">
							</div>
						</div>
					</div>		
					 <div class="form-group">
                      <label class="control-label"> Address </label>
					  <textarea class="autosize form-control" name="faculty_address" id="faculty_address" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 69px;"></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
				  	 <div class="row">
                      	<div class="col-md-6">
						   <div class="form-group">
							  <label class="control-label"> First Name <span class="symbol required"></span> </label>
							  <input type="text" placeholder="" class="form-control" id="faculty_first_name" name="faculty_first_name">
							</div>
						</div>
						<div class="col-md-6">	
							<div class="form-group">
							  <label class="control-label"> Last Name <span class="symbol required"></span> </label>
							  <input type="text" placeholder="" class="form-control" id="faculty_last_name" name="faculty_last_name">
							</div>
						</div>
					</div>
					<div class="row">
                      	<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label"> Date of Birth <span class="symbol required"></span> </label>
							  <input type="text" placeholder="DD-MM-YYYY" class="form-control date-picker" id="faculty_dob" name="faculty_dob" data-date-format="dd-mm-yyyy">
							</div>
						</div>	
						<div class="col-md-6">	
							<div class="form-group">
							  <label class="control-label"> Gender <span class="symbol required"></span> </label>
							  <div>
								<label class="radio-inline">
								<input type="radio" class="grey" value="female" name="faculty_gender" id="faculty_gender">
								Female </label>
								<label class="radio-inline">
								<input type="radio" class="grey" value="male" name="faculty_gender"  id="faculty_gender">
								Male </label>
							  </div>
							</div>
						</div>
					</div>		
                    <div class="row">
                      <div class="col-md-6">
					  	<div class="form-group">
                          <label class="control-label"> Faculty Category<span class="symbol required"></span> </label>
                          <select name="faculty_designation" id="faculty_designation"  class="form-control">
                            <option value="">-- Category --</option>
                            <? foreach($fcultyDesignationArray as $k=>$v):?>
                            <? if($v!=$defaultDesignationArrayKeys[1]):?>
                            <option value="<?=$k?>" >
                            <?=ucfirst($v)?>
                            </option>
                            <? endif;?>
                            <? endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Employee ID </label>
                          <input class="form-control" placeholder="" type="text" name="faculty_employee_id" id="faculty_employee_id">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Bachelors </label>
                          <input class="form-control" placeholder="" type="text" name="faculty_bachelors" id="faculty_bachelors">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Other Qualification </label>
                          <input class="form-control" placeholder="" type="text" name="faculty_highest_qualification" id="faculty_highest_qualification">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Total Experience<span class="symbol "></span> </label>
                          <input class="form-control" placeholder="" type="text" name="faculty_years_of_experience" id="faculty_years_of_experience" value="<?=$facultyDetails->faculty_years_of_experience?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Joining Date <span class="symbol "></span> </label>
                          <input class="form-control date-picker" placeholder="DD-MM-YYYY" type="text" data-date-format="dd-mm-yyyy" name="faculty_with_school_since" id="faculty_with_school_since" value="<?=$facultyDetails->faculty_with_school_since?>">
						  
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
                    <input type="button" class="btn btn-gray btn-block" value="Cancel" onClick="window.location.href='<?=make_url('administration-faculty')?>'">
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
      <!-- end: Enroll / Edit Faculty -->
      <? 
					break;
					case 'update':
					?>
      
      <!-- start: Enroll / Edit Faculty -->
     
            
            <div class="panel-body">
              <h2><i class="fa fa-pencil-square teal"></i> Update</h2>
              <p> Update faculty account </p>
              <hr>
              <form id="frmFaculty" action="<?=make_long_url('administration-faculty', 'update', 'list','faculty_id='.$faculty_id);?>" method="post" name="frmFaculty" >
                <div class="row">
                  <div class="col-md-12">
                    <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
                    <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" id="UserId">
                      <label class="control-label"> User Id <span class="symbol required"></span> </label>
                      <input type="text" placeholder="" class="form-control" id="faculty_user_id" name="faculty_user_id" value="<?=$facultyDetails->faculty_user_id?>" onBlur="checkUserIdExist(<?=$facultyDetails->faculty_id?>)">
                      <span  id="ckeckUserId" style="color:#b94a48"></span> </div>
                    
                    <div class="form-group">
                      <label class="control-label"> Email Official <span class="symbol "></span> </label>
                      <input type="email" placeholder="" class="form-control" id="faculty_email_id" name="faculty_email_id" value="<?=$facultyDetails->faculty_email_id?>">
                    </div>
                    <div class="form-group">
                      <label class="control-label"> Email Personal <span class="symbol "></span> </label>
                      <input type="email" placeholder="" class="form-control" id="faculty_email_personal" name="faculty_email_personal" value="<?=$facultyDetails->faculty_email_personal?>">
                    </div>
					<div class="row">
                      	<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label"> Mobile No <span class="symbol required"></span> </label>
							  <input type="text" placeholder="" class="form-control" id="faculty_mobile" name="faculty_mobile" value="<?=$facultyDetails->faculty_mobile?>">
							</div>
						</div>
						<div class="col-md-6">	
							<div class="form-group">
							  <label class="control-label"> Phone No <span class="symbol "></span> </label>
							  <input type="text" placeholder="" class="form-control" id="faculty_contact" name="faculty_contact" value="<?=$facultyDetails->faculty_contact?>">
							</div>
                    	</div>
					</div>	
					<div class="form-group connected-group">
                      <label class="control-label"> Address <span class="symbol "></span> </label>
                      
					  <textarea class="autosize form-control" name="faculty_address" id="faculty_address" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 69px;" ><?=$facultyDetails->faculty_address?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
				  	<div class="row">
                      	<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label"> First Name <span class="symbol required"></span> </label>
							  <input type="text" placeholder="" class="form-control" id="faculty_first_name" name="faculty_first_name" value="<?=$facultyDetails->faculty_first_name?>" >
							</div>
						</div>
						<div class="col-md-6">	
							<div class="form-group">
							  <label class="control-label"> Last Name <span class="symbol required"></span> </label>
							  <input type="text" placeholder="" class="form-control" id="faculty_last_name" name="faculty_last_name" value="<?=$facultyDetails->faculty_last_name?>" >
							</div>
				  		</div>
					</div>	
				  	 <div class="row">
                      	<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label"> Date of Birth <span class="symbol required"></span> </label>
							  <input type="text" placeholder="DD-MM-YYYY" class="form-control date-picker" id="faculty_dob" name="faculty_dob" data-date-format="dd-mm-yyyy" value="<?=$facultyDetails->faculty_dob?>">
							</div>
						</div>
						<div class="col-md-6">	
							<div class="form-group">
							  <label class="control-label"> Gender <span class="symbol required"></span> </label>
							  <div>
								<label class="radio-inline">
								<input type="radio" class="grey" value="female" name="faculty_gender" id="faculty_gender" <?=($facultyDetails->faculty_gender=='female')?'checked':'';?>>
								Female </label>
								<label class="radio-inline">
								<input type="radio" class="grey" value="male" name="faculty_gender"  id="faculty_gender" <?=($facultyDetails->faculty_gender=='male')?'checked':'';?>>
								Male </label>
							  </div>
							</div>
						</div>
					</div>		
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Employee ID <span class="symbol "></span> </label>
                          <input class="form-control" placeholder="" type="text" name="faculty_employee_id" id="faculty_employee_id" value="<?=$facultyDetails->faculty_employee_id?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Faculty Category<span class="symbol required"></span> </label>
                          <select name="faculty_designation"  class="form-control">
                            <option value="">-- Category --</option>
                            <? foreach($fcultyDesignationArray as $k=>$v):?>
                            <? if($v!=$defaultDesignationArrayKeys[1]):?>
                            <option value="<?=$k?>" <?=($facultyDetails->faculty_designation==$k)?'selected':'';?>>
                            <?=ucfirst($v)?>
                            </option>
                            <? endif;?>
                            <? endforeach;?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Bachelors<span class="symbol "></span> </label>
                          <input class="form-control" placeholder="" type="text" name="faculty_bachelors" id="faculty_bachelors" value="<?=$facultyDetails->faculty_bachelors?>" >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Other Qualification<span class="symbol "></span> </label>
                          <input class="form-control" placeholder="" type="text" name="faculty_highest_qualification" id="faculty_highest_qualification" value="<?=$facultyDetails->faculty_highest_qualification?>" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Total Experience<span class="symbol "></span> </label>
                          <input class="form-control" placeholder="" type="text" name="faculty_years_of_experience" id="faculty_years_of_experience" value="<?=$facultyDetails->faculty_years_of_experience?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label"> Joining Date <span class="symbol "></span> </label>
                          <input class="form-control date-picker" placeholder="DD-MM-YYYY" type="text" data-date-format="dd-mm-yyyy" name="faculty_with_school_since" id="faculty_with_school_since" value="<?=$facultyDetails->faculty_with_school_since?>">
						  
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
                    <input type="button" class="btn btn-gray btn-block" value="Cancel" onClick="window.location.href='<?=make_url('administration-faculty')?>'">
                  </div>
                  <div class="col-md-2">
                    <input type="hidden" name="validate" value="Update">
                    <input class="btn btn-primary btn-block" type="button" name="update" value="Update" onClick="checkUserIdExistOnSubmit(<?=$facultyDetails->faculty_id?>)">
                  </div>
                </div>
              </form>
            </div>
         
      <!-- end: Enroll / Edit Faculty -->
      <? 
					break;
					
				    endswitch;?>
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
