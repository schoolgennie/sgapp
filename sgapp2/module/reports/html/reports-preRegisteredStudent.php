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
          <div class="col-sm-4">
            <button type="button" class="btn btn-primary" value="Download" onClick="window.location.href='<?=make_long_url('reports-preRegisteredStudent', 'download', 'download');?>'">Download Report <i class="fa fa-download"></i></button>
          </div>
          
        </div>
        
      </div>
      <!-- start: List Student -->
      <div class="row">
        <div class="col-md-12">
          <!-- start: TABLE WITH IMAGES PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading">  Admission Enquiries
              <div class="panel-tools"> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-condensed table-hover" >
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Date</th>
                          <th>Date of Birth </th>
                          <th class="hidden-xs">Email</th>
                          <th class="hidden-xs">Father Name</th>
                          <th class="hidden-xs">Mother Name</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <? if($studentList):?>
                        <?  foreach($studentList as $k=>$v):?>
                        <tr>
                          <td><?=$v->student_pre_registration_first_name.' '.$v->student_pre_registration_last_name;?></td>
                          <td><?=ToIndianDate($v->student_pre_registration_date);?></td>
                          <td><?=ToIndianDate($v->student_pre_registration_dob);?></td>
                          <td class="hidden-xs"><?=$v->student_pre_registration_email?></td>
                          <td class="hidden-xs"><?=$v->student_pre_registration_father_first_name.' '.$v->student_pre_registration_father_last_name?></td>
                          <td class="hidden-xs"><?=$v->student_pre_registration_mother_first_name.' '.$v->student_pre_registration_mother_last_name?> </td>
                          <td class="center"><div class="visible-md visible-lg hidden-sm hidden-xs">
                              <? if($v->student_pre_registration_status==1):?>
                               <span class="label label-success" >complete</span>
                              <? else:?>
                              <span class="label label-success" >Pending</span>
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
