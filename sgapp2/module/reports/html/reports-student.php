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
            <button type="button" class="btn btn-primary" value="Download" onClick="window.location.href='<?=make_long_url('reports-student', 'download', 'download');?>'">Download Report <i class="fa fa-download"></i></button>
          </div>
          
        </div>
        
      </div>
      <!-- start: List Student -->
      <div class="row">
        <div class="col-md-12">
          <!-- start: TABLE WITH IMAGES PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-users-2"></i> Student List
              <div class="panel-tools"> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
            </div>
            <div class="panel-body">
              <form action="<?=make_url('reports-student');?>" name="filter" id="filter" method="post">
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <div class="panel-body" >
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
                    <table class="table table-striped table-condensed table-hover" >
                      <thead>
                        <tr>
                          <th>Full Name</th>
                          <th>Roll Number</th>
                          <th>Admission No.</th>
                          <th>Prefered Email</th>
                          <th>Phone</th>
                          <th>Gender</th>
                          <th>Date of birth</th>
                          <th>Class</th>
                        </tr>
                      </thead>
                      <tbody>
                        <? if($studentList->GetNumRows()>0):?>
                        <?  while($studentListing=$studentList->GetObjectFromRecord()):?>
                        <tr>
                          <td><?=$studentListing->student_first_name.' '.$studentListing->student_last_name?></td>
                          <td><?=$studentListing->student_roll_number?></td>
                          <td><?=$studentListing->student_admission_no?></td>
                          <td><a href="mailto:<?=$studentListing->student_email_id?>" rel="nofollow"><?=$studentListing->student_email_id?></a></td>
                          <td><?=$studentListing->student_contact?></td>
                          <td><?=$studentListing->student_gender?></td>
                          <td><?=$studentListing->student_dob?></td>
                          <td><?=$studentListing->class_name?></td>
                          
                        </tr>
                        <? endwhile;?>
                       
                        <? else:?>
                        <tr>
                          <td colspan="8">No Student</td>
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
