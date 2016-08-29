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

<script>
			jQuery(document).ready(function() {
				FormElements.init();
				
			});
		</script>
<script>
function editEnquiryToggle()
{
$("#editEnquiry").toggle();
$("#showEnquiry").toggle();
}
</script>
<script>
function searchResult()
{
  $("#filter").submit();
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
            <h1>Admission Enquiries</h1>
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
        <div class="row">
          <div class="col-sm-4">
            <button class="btn btn-primary" type="button" onClick="window.location.href='<?=make_long_url('administration-preRegisteredStudent','insert','insert')?>'"> New Enquiry <i class="clip-user-plus"></i></button>
           </div>
          <div class="col-sm-4">
           <button type="button" class="btn btn-primary" value="Download" onClick="window.location.href='<?=make_long_url('administration-preRegisteredStudent', 'download', 'download');?>'">Download Template <i class="fa fa-download"></i></button>
            <? if($_SESSION['user_session']['set_lead_student_unsuccessfull_list']):?>
            <button type="button" class="btn btn-danger" onClick="window.location.href='<?=make_long_url('administration-preRegisteredStudent', 'downloadNotSuccess', 'downloadNotSuccess');?>'">Failed Records <i class="fa fa-exclamation-triangle"></i></button>
            <? endif;?>
          </div>
          <div class="col-sm-4">
            <form name="" action="<?=make_long_url('administration-preRegisteredStudent', 'import', 'import');?>" method="post" enctype="multipart/form-data">
              <button class="btn btn-primary" type="submit"  name="submit" value="Upload">Upload Bulk <i class="fa fa-upload"></i></button>
              <input type="file" name="download">
            </form>
          </div>
        </div>
        
      </div>
      <!-- start: List Student -->
      <form action="<?=make_url('administration-preRegisteredStudent');?>" name="filter" id="filter" method="post">
                <div class="row">
                  <div class="col-md-4">
                    <div class="" >
                      <div class="form-group">
                        <label>Filter By Previous School </label>
                        <select name="previousSchool" id="previousSchool" class="form-control" onChange="searchResult();">
                          <option value=""> --Select Previous School-- </option>
                          <? foreach($previousSchoolArray as $k=>$v):?>
                          <option value="<?=$v->student_pre_registration_previous_school?>" <?=($previousSchool==$v->student_pre_registration_previous_school)?'selected':'';?>>
                          <?=$v->student_pre_registration_previous_school?>
                          </option>
                          <? endforeach;?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="" >
                      <div class="form-group">
                        <label>Filter By Location </label>
                        <select name="location" id="location" class="form-control" onChange="searchResult();">
                          <option value=""> --Select Location-- </option>
                          <? foreach($locationArray as $k=>$v):?>
                          <option value="<?=$v->student_pre_registration_location?>" <?=($location==$v->student_pre_registration_location)?'selected':'';?>>
                          <?=$v->student_pre_registration_location?>
                          </option>
                          <? endforeach;?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
      <div class="row">
        <div class="col-md-12">
          <!-- start: TABLE WITH IMAGES PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-users-2"></i> Admission Enquiry List
              <div class="panel-tools"> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-12">
              
                    <table class="table table-striped table-condensed table-hover" >
                      <thead>
                        <tr>
                          <th>Enquiry Date</th>
                          <th>Student Name</th>
                          <th>Date of Birth </th>
                          <th class="hidden-xs">Previous School</th>
                          <th class="hidden-xs">Location</th>
						  <th class="hidden-xs">Email</th>
						  <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <? if($studentList):?>
                        <?  foreach($studentList as $k=>$v):?>
                        <tr>
                          <td><?=ToIndianDate($v->student_pre_registration_date);?></td>
                          <td><?=$v->student_pre_registration_first_name.' '.$v->student_pre_registration_last_name;?></td>
                          <td><?=ToIndianDate($v->student_pre_registration_dob);?></td>
                          <td class="hidden-xs"><?=$v->student_pre_registration_previous_school;?></td>
                          <td class="hidden-xs"><?=$v->student_pre_registration_location;?> </td>
						  <td class="hidden-xs"><?=$v->student_pre_registration_email;?></td>
						  <td><a href="<?=make_long_url('administration-preRegisteredStudent', 'comment', 'comment', 'id='.$v->student_pre_registration_id)?>"><span class="label <?=$admissionEnquiryStatusLabelArray[$v->student_pre_registration_status]?>" ><?=$admissionEnquiryStatusArray[$v->student_pre_registration_status]?></span></a></td>
                          <td><div class="visible-md visible-lg hidden-sm hidden-xs">
                                 
                              
							  
							 
								
							  <a href="<?=make_long_url('administration-preRegisteredStudent', 'update', 'update', 'id='.$v->student_pre_registration_id)?>" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                              <a href="<?=make_long_url('administration-preRegisteredStudent', 'delete', 'list', 'id='.$v->student_pre_registration_id)?>" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Delete"><i class="fa fa-ban fa fa-white"></i></a>
                              <? if($v->student_pre_registration_status!=1):?>
                                <a href="<?=make_long_url('administration-student', 'insert', 'insert', 'preRegisterId='.$v->student_pre_registration_id)?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="Enroll Student"> Enroll </a>
                                <? endif;?>
                              
                            </div></td>
                        </tr>
                        <? endforeach;?>
                        <? else:?>
                        <tr>
                          <td colspan="6">No Student</td>
                        </tr>
                        <? endif;?>
                      </tbody>
                    </table>
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
          <div class="panel panel-default">
            
            <div class="panel-body">
              <h2><i class="fa fa-pencil-square teal"></i> Admission Enquiry </h2>
              <p> Fill up form and enter student information </p>
              <hr>
              <form  action="<?=make_long_url('administration-preRegisteredStudent', 'insert', 'list');?>" method="post" >
                <div class="row">
                  <div class="col-md-12">
                    <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
                    <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label"> Enquiry Date <span class="symbol required"></span> </label>
                      <input type="text" placeholder="DD-MM-YYYY" class="form-control date-picker" id="student_pre_registration_date" name="student_pre_registration_date" data-date-format="dd-mm-yyyy" required>
                    </div>   
                    <div class="form-group">
                      <label class="control-label">First Name <span class="symbol required"></span> </label>
                      <input type="text" placeholder="First Name" class="form-control" id="student_pre_registration_first_name" name="student_pre_registration_first_name" required>
                    </div>
                     <div class="form-group">
                      <label class="control-label">Last Name  </label>
                      <input type="text" placeholder="Last Name" class="form-control" id="student_pre_registration_last_name" name="student_pre_registration_last_name" >
                    </div>
					<div class="form-group">
                      <label class="control-label"> Date of Birth <span class="symbol required"></span> </label>
                      <input type="text" placeholder="DD-MM-YYYY" class="form-control date-picker" id="student_pre_registration_dob" name="student_pre_registration_dob" data-date-format="dd-mm-yyyy" required>
                    </div>
                     <div class="form-group">
                      <label class="control-label">Preferred Email ID </label>
                      <input type="email" placeholder="email@example.com" class="form-control" id="student_pre_registration_email" name="student_pre_registration_email" >
                    </div>
                     <div class="form-group">
                      <label class="control-label">Previous School  </label>
                      <input type="text" placeholder="Previous School" class="form-control" id="student_pre_registration_previous_school" name="student_pre_registration_previous_school" >
                    </div>
                     <div class="form-group">
                      <label class="control-label">Location  </label>
                      <input type="text" placeholder="Location" class="form-control" id="student_pre_registration_location" name="student_pre_registration_location" >
                    </div>
                    <div class="form-group">
                      <label class="control-label"> How did you get to know about us  </label>
                      <input type="text" placeholder=" " class="form-control " id="student_pre_registration_how_to_know" name="student_pre_registration_how_to_know">
                   </div>
				   <div class="form-group">
                      <label class="control-label"> We value your suggestion </label>
                      <input type="text" placeholder="" class="form-control " id="student_pre_registration_suggestion" name="student_pre_registration_suggestion">
                   </div>
                    <div class="form-group">
                      <label class="control-label"> Attended By </label>
                      <input type="text" placeholder="Attended By" class="form-control " id="student_pre_registration_attendent" name="student_pre_registration_attendent" value="<?=$login_session->get_username()?>">
                    </div>
                  </div>
                  <div class="col-md-6">
				  	<div class="panel panel-default">
						<div class="panel-heading"> Father Information
						  <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>  </div>
						</div>
						<div class="panel-body">
							<div class="row">
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> First Name  </label>
								  <input class="form-control" placeholder="Father First Name" type="text" name="student_pre_registration_father_first_name" id="student_pre_registration_father_first_name" >
								</div>
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Last Name  </label>
								  <input class="form-control" placeholder="Father Last Name" type="text" name="student_pre_registration_father_last_name" id="student_pre_registration_father_last_name" >
								</div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Occupation  </label>
								  <input type="text" placeholder="Father Occupation" class="form-control " id="student_pre_registration_father_occupation" name="student_pre_registration_father_occupation">
								</div>
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Office Phone  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_father_office_phone" name="student_pre_registration_father_office_phone">
								</div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Residence Phone  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_father_resi_phone" name="student_pre_registration_father_resi_phone">
								</div>
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Mobile  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_father_mobile" name="student_pre_registration_father_mobile">
								</div>
							  </div>
							</div>
						</div>
					</div>		
					
					<div class="panel panel-default">
						<div class="panel-heading"> Mother Information
						  <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>  </div>
						</div>
						<div class="panel-body">
							<div class="row">
							  <div class="col-md-6">
							  	 <div class="form-group">
								  <label class="control-label"> First Name </label>
								  <input class="form-control" placeholder="Mother First Name" type="text" name="student_pre_registration_mother_first_name" id="student_pre_registration_mother_first_name" >
								</div>
								
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Last Name  </label>
								  <input class="form-control" placeholder="Mother Last Name" type="text" name="student_pre_registration_mother_last_name" id="student_pre_registration_mother_last_name" >
								</div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Occupation  </label>
								  <input type="text" placeholder="Mother Occupation" class="form-control " id="student_pre_registration_mother_occupation" name="student_pre_registration_mother_occupation">
								</div>
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Office Phone  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_mother_office_phone" name="student_pre_registration_mother_office_phone">
								</div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Residence Phone  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_mother_resi_phone" name="student_pre_registration_mother_resi_phone">
								</div>
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Mobile  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_mother_mobile" name="student_pre_registration_mother_mobile">
								</div>
							  </div>
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
                    <input type="button" class="btn btn-gray btn-block" value="Cancel" onClick="window.location.href='<?=make_url('administration-preRegisteredStudent')?>'">
                  </div>
                  <div class="col-md-2">
                    <input class="btn btn-primary btn-block" type="submit" name="submit"  value="Register">
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
        
          <div class="panel panel-default">
            
            <div class="panel-body">
              <h2><i class="fa fa-pencil-square teal"></i> Admission Enquiry </h2>
              <p> Fill up form and enter student information </p>
              <hr>
              <form id="frmStudent" action="<?=make_long_url('administration-preRegisteredStudent', 'update', 'list','id='.$id);?>" method="post" name="frmStudent" >
                <div class="row">
                  <div class="col-md-12">
                    <div class="errorHandler alert alert-danger no-display"> <i class="fa fa-times-sign"></i> You have some form errors. Please check below. </div>
                    <div class="successHandler alert alert-success no-display"> <i class="fa fa-ok"></i> Your form validation is successful! </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label"> Enquiry Date <span class="symbol required"></span> </label>
                      <input type="text" placeholder="DD-MM-YYYY" class="form-control date-picker" id="student_pre_registration_date" name="student_pre_registration_date" data-date-format="dd-mm-yyyy" value="<?=ToIndianDate($studentDetails->student_pre_registration_date)?>" required>
                    </div>   
                    <div class="form-group">
                      <label class="control-label">First Name <span class="symbol required"></span> </label>
                      <input type="text" placeholder="First Name" class="form-control" id="student_pre_registration_first_name" name="student_pre_registration_first_name" value="<?=$studentDetails->student_pre_registration_first_name?>" required>
                    </div>
                     <div class="form-group">
                      <label class="control-label">Last Name </label>
                      <input type="text" placeholder="Last Name" class="form-control" id="student_pre_registration_last_name" name="student_pre_registration_last_name" value="<?=$studentDetails->student_pre_registration_last_name?>" >
                    </div>
					<div class="form-group">
                      <label class="control-label"> Date of Birth <span class="symbol required"></span> </label>
                      <input type="text" placeholder="DD-MM-YYYY" class="form-control date-picker" id="student_pre_registration_dob" name="student_pre_registration_dob" data-date-format="dd-mm-yyyy" value="<?=ToIndianDate($studentDetails->student_pre_registration_dob)?>" required>
                    </div>
                     <div class="form-group">
                      <label class="control-label">Preferred Email ID </label>
                      <input type="email" placeholder="email@example.com" class="form-control" id="student_pre_registration_email" name="student_pre_registration_email" value="<?=$studentDetails->student_pre_registration_email?>">
                    </div>
                      <div class="form-group">
                      <label class="control-label">Previous School  </label>
                      <input type="text" placeholder="Previous School" class="form-control" id="student_pre_registration_previous_school" name="student_pre_registration_previous_school" value="<?=$studentDetails->student_pre_registration_previous_school?>">
                    </div>
                     <div class="form-group">
                      <label class="control-label">Location  </label>
                      <input type="text" placeholder="Location" class="form-control" id="student_pre_registration_location" name="student_pre_registration_location" value="<?=$studentDetails->student_pre_registration_location?>">
                    </div>
                    <div class="form-group">
                      <label class="control-label"> How did you get to know about us  </label>
                      <input type="text" placeholder=" " class="form-control " id="student_pre_registration_how_to_know" name="student_pre_registration_how_to_know" value="<?=$studentDetails->student_pre_registration_how_to_know?>">
                   </div>
				   <div class="form-group">
                      <label class="control-label"> We value your suggestion </label>
                      <input type="text" placeholder="" class="form-control " id="student_pre_registration_suggestion" name="student_pre_registration_suggestion" value="<?=$studentDetails->student_pre_registration_suggestion?>">
                   </div>
                   <div class="form-group">
                      <label class="control-label"> Attended By </label>
                      <input type="text" placeholder="Attended By" class="form-control " id="student_pre_registration_attendent" name="student_pre_registration_attendent" value="<?=$studentDetails->student_pre_registration_attendent?>">
                    </div>
                  </div>
                  <div class="col-md-6">
				  	<div class="panel panel-default">
						<div class="panel-heading"> Father Information
						  <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>  </div>
						</div>
						<div class="panel-body">
							<div class="row">
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> First Name </label>
								  <input class="form-control" placeholder="Father First Name" type="text" name="student_pre_registration_father_first_name" id="student_pre_registration_father_first_name" value="<?=$studentDetails->student_pre_registration_father_first_name?>" >
								</div>
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Last Name  </label>
								  <input class="form-control" placeholder="Father Last Name" type="text" name="student_pre_registration_father_last_name" id="student_pre_registration_father_last_name" value="<?=$studentDetails->student_pre_registration_father_last_name?>" >
								</div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Occupation  </label>
								  <input type="text" placeholder="Father Occupation" class="form-control " id="student_pre_registration_father_occupation" name="student_pre_registration_father_occupation" value="<?=$studentDetails->student_pre_registration_father_occupation?>">
								</div>
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Office Phone  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_father_office_phone" name="student_pre_registration_father_office_phone" value="<?=$studentDetails->student_pre_registration_father_office_phone?>">
								</div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Residence Phone  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_father_resi_phone" name="student_pre_registration_father_resi_phone" value="<?=$studentDetails->student_pre_registration_father_resi_phone?>">
								</div>
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Mobile  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_father_mobile" name="student_pre_registration_father_mobile" value="<?=$studentDetails->student_pre_registration_father_mobile?>">
								</div>
							  </div>
							</div>
						</div>
					</div>		
					
					<div class="panel panel-default">
						<div class="panel-heading"> Mother Information
						  <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>  </div>
						</div>
						<div class="panel-body">
							<div class="row">
							  <div class="col-md-6">
							  	 <div class="form-group">
								  <label class="control-label"> First Name  </label>
								  <input class="form-control" placeholder="Mother First Name" type="text" name="student_pre_registration_mother_first_name" id="student_pre_registration_mother_first_name" value="<?=$studentDetails->student_pre_registration_mother_first_name?>" >
								</div>
								
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Last Name  </label>
								  <input class="form-control" placeholder="Mother Last Name" type="text" name="student_pre_registration_mother_last_name" id="student_pre_registration_mother_last_name" value="<?=$studentDetails->student_pre_registration_mother_last_name?>" >
								</div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Occupation  </label>
								  <input type="text" placeholder="Mother Occupation" class="form-control " id="student_pre_registration_mother_occupation" name="student_pre_registration_mother_occupation" value="<?=$studentDetails->student_pre_registration_mother_occupation?>">
								</div>
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Office Phone  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_mother_office_phone" name="student_pre_registration_mother_office_phone" value="<?=$studentDetails->student_pre_registration_mother_office_phone?>">
								</div>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Residence Phone  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_mother_resi_phone" name="student_pre_registration_mother_resi_phone" value="<?=$studentDetails->student_pre_registration_mother_resi_phone?>">
								</div>
							  </div>
							  <div class="col-md-6">
							  	<div class="form-group">
								  <label class="control-label"> Mobile  </label>
								  <input type="text" placeholder="" class="form-control " id="student_pre_registration_mother_mobile" name="student_pre_registration_mother_mobile" value="<?=$studentDetails->student_pre_registration_mother_mobile?>">
								</div>
							  </div>
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
                    <input type="button" class="btn btn-gray btn-block" value="Cancel" onClick="window.location.href='<?=make_url('administration-preRegisteredStudent')?>'">
                  </div>
                  <div class="col-md-2">
                    <input class="btn btn-primary btn-block" type="submit" name="submit"  value="Update">
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
		case 'comment':
		?>
          <!-- start: Enroll Student -->
       <h2>
            <i class="fa fa-user teal"></i> <?=ucwords($studentDetails->student_pre_registration_first_name.' '.$studentDetails->student_pre_registration_last_name);?>
       </h2> 
      <div class="row" id="creatNewStudent" >
        <div class="col-md-12">
        <table class="table table-striped table-condensed table-hover" >
                      <thead>
                        <tr>
                          <th>Enquiry Date</th>
                          <th>Student Name</th>
                          <th>Date of Birth </th>
                          <th class="hidden-xs">Father Name</th>
                          <th class="hidden-xs">Mother Name</th>
						  <th class="hidden-xs">Email</th>
						  
                        </tr>
                      </thead>
                      <tbody>
                    
                        <tr>
                          <td><?=ToIndianDate($studentDetails->student_pre_registration_date);?></td>
                          <td><?=ucwords($studentDetails->student_pre_registration_first_name.' '.$studentDetails->student_pre_registration_last_name);?></td>
                          <td><?=ToIndianDate($studentDetails->student_pre_registration_dob);?></td>
                          <td class="hidden-xs"><?=$studentDetails->student_pre_registration_father_first_name.' '.$studentDetails->student_pre_registration_father_last_name?></td>
                          <td class="hidden-xs"><?=$studentDetails->student_pre_registration_mother_first_name.' '.$studentDetails->student_pre_registration_mother_last_name?> </td>
						  <td class="hidden-xs"><?=$studentDetails->student_pre_registration_email?></td>
						  
                        </tr>
                       
                      </tbody>
                    </table>
          <div class="">
            
            <div class="">
             
              <hr>	
                <div class="row">
                  
                  <div class="col-md-8">
                    <? if($commentHistory):?>
                      <? foreach($commentHistory as $commentHistoryKey=>$commentHistoryValue):?>
                      <? $UserInfo=getUserInfo($commentHistoryValue->user_type,$commentHistoryValue->user_id);?>
                        <blockquote>
					<a><?=$UserInfo['name'];?></a>
						<p>
							<?=$commentHistoryValue->student_pre_registration_comment;?>
						</p>
						<medium> <?=ToIndianDate($commentHistoryValue->student_pre_registration_comment_history_ondate);?> </medium>
					</blockquote>   
					<hr>		
                      <? endforeach;?>
                    <? endif;?>
							
					
                    <form  action="<?=make_long_url('administration-preRegisteredStudent', 'insertcomment', 'insertcomment','id='.$id);?>" method="post" >
					<div class="form-group">				
						<textarea  id="student_pre_registration_comment" class="form-control" name="student_pre_registration_comment" required></textarea>				
                    </div>
					<div class="row">
					  <div class="col-md-5"> </div>
					  
					  <div class="col-md-2">
						<input class="btn btn-info btn-block" type="submit" name="submit"  value="Comment">
					  </div>
					  
					</div>
                    </form>
                  </div>
				  
                  <div class="col-md-4">
				  	<div class="panel panel-default">
						<div class="panel-body" id="showEnquiry">
						
							<div class="row">
							  <div class="col-md-5" align="right">
								  
								  <div class="form-group"> Status </div>
								 
								  <div class="form-group">Created On</div>
								  <div class="form-group">Reminder</div>
							  </div>
							  <div class="col-md-7" align="left">
							  	<div class="form-group">
								   <span class="label <?=$admissionEnquiryStatusLabelArray[$studentDetails->student_pre_registration_status]?>" ><?=$admissionEnquiryStatusArray[$studentDetails->student_pre_registration_status]?></span>	
								</div>
								<div class="form-group">
									<h5><?=ToIndianDate($studentDetails->student_pre_registration_ondate)?></h5>
								</div>
								<div class="form-group">
									<?=($studentDetails->student_pre_registration_reminder_date!='0000-00-00')?ToIndianDate($studentDetails->student_pre_registration_reminder_date):'';?>
								</div>
							  </div>
							</div>
							<? if($studentDetails->student_pre_registration_status!=1):?>
							<div class="row">
							<div class="col-md-12" align="center">
								<button class="btn btn-default" type="button" onClick="editEnquiryToggle();"> Edit </button>
							</div>
							</div>
                            <? endif;?>
                            
						</div>
						<div class="panel-body" style="display:none" id="editEnquiry">
							
							
                            <form id="frmStudent" action="<?=make_long_url('administration-preRegisteredStudent', 'updateEnquiry', 'comment','id='.$id);?>" method="post" name="frmStudent" >
							<div class="row">
							  <div class="col-md-5" align="right">
								  
								  <div class="form-group"><h4> Status</h4> </div>
								 
								  <div class="form-group"><h4>Created On</h4></div>
								  <div class="form-group"><h4>Reminder</h4></div>
							  </div>
							  <div class="col-md-7" align="left">
							  	<div class="form-group">
								   <select id="student_pre_registration_status" name="student_pre_registration_status" class="form-control search-select">
                                      <? foreach($admissionEnquiryStatusArray as $k=>$v):?>
                                        <? if($k!=1):?>
                                         <option value="<?=$k?>" <?=($studentDetails->student_pre_registration_status==$k)?'selected':'';?>><?=$v?></option>
                                        <? endif;?> 
                                      <? endforeach;?>
									</select>		
								 
								</div>
								<div class="form-group">
									<h5><?=ToIndianDate($studentDetails->student_pre_registration_ondate)?></h5>
								</div>
								<div class="form-group">
									<input type="text" placeholder="DD-MM-YYYY" class="form-control date-picker" id="student_pre_registration_reminder_date" name="student_pre_registration_reminder_date" data-date-format="dd-mm-yyyy" value="<?=($studentDetails->student_pre_registration_reminder_date!='0000-00-00')?ToIndianDate($studentDetails->student_pre_registration_reminder_date):date('d-m-Y');?>" >
								</div>
							  </div>
							</div>
							
							<div class="row">
							<div class="col-md-12" align="center">
								<button class="btn btn-default" type="submit" name="submit"> Update </button>
								<button class="btn btn-default" type="button" onClick="editEnquiryToggle();">Cancel</button>
							</div>
							</div>
                            </form>
						</div>
					</div>		
					
					  
               </div>
                </div>
                  <hr>
                
                
                <div class="row">
                  <div class="col-md-4"> </div>
                  <div class="col-md-2">
                    <input type="button" class="btn btn-gray btn-block" value="Cancel" onClick="window.location.href='<?=make_url('administration-preRegisteredStudent')?>'">
                  </div>
                  <div class="col-md-2">
                  </div>
                </div>
         
            </div>
          </div>
        </div>
      </div>
      <!-- end: Enroll Student -->
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
