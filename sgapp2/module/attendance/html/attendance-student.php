<!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link rel="stylesheet" href="design/plugins/gritter/css/jquery.gritter.css">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
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
<script src="design/plugins/bootstrap-paginator/src/bootstrap-paginator.js"></script>
<script src="design/plugins/jquery.pulsate/jquery.pulsate.min.js"></script>
<script src="design/plugins/gritter/js/jquery.gritter.min.js"></script>
<script src="design/js/ui-elements.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
			jQuery(document).ready(function() {
				UIElements.init();
			});
		</script>
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
function markAttendance(val,id)
{
$("#studentList"+id+" #student_attendance").val(val);
$("#studentList"+id+" #Present").toggle();
$("#studentList"+id+" #Absent").toggle();
$('input[type="submit"]').removeAttr('disabled');
}
</script>
</head>
<body>
<!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<div class="main-container">
<!--Navigation Start -->
<? include_once(DIR_FS_SITE_INCLUDE.'facultyNav.php'); ?>
<!--Navigation End -->
<div class="main-content">
<?php display_form_error();?>
<div class="container">
  <!-- start: PAGE HEADER -->
  <div class="row">
    <div class="col-sm-12">
     <div class="page-header">
        <h3>
          <?=$inchargeClass->class_name?>
          <small>Attendance</small></h3>
      </div>
    </div>
  </div>
  <!-- end: PAGE HEADER -->
  <div class="row">
    <div class="col-md-12">
      <!-- start: TABLE WITH IMAGES PANEL -->
      <div class="panel panel-default">
        <div class="panel-heading"> <i class="fa fa-external-link-square"></i> Attendance
          <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> <a class="btn btn-xs btn-link panel-expand" href="#"> <i class="fa fa-resize-full"></i> </a> </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <ul class="pagination" style="margin:0">
                <li> <a href="<?=make_url('attendance-student','ondate='.$previous)?>"> Prev </a> </li>
                <li> <a style="padding:0">
                  <form name="attendanceFrm" action="<?=make_url('attendance-student');?>" method="post" id="attendanceFrm">
                    <input name="ondate" class="form-control date-picker input-sm" style="border:0;height: 29px;text-align:center;"  type="text" data-date-viewmode="years" data-date-format="dd-mm-yyyy" onChange="this.form.submit()" value="<?=date('d-m-Y',strtotime($ondate))?>">
                  </form>
                  </a> </li>
                <li> <a href="<?=make_url('attendance-student','ondate='.$next)?>"> Next </a> </li>
              </ul>
            </div>
            
          </div>
          <? if($studentList):?>
          <form name="studentAttendanceFrm" id="studentAttendanceFrm" action= "<?=make_url('attendance-student')?>" method="post">
		   <div class="row"> 
		    <div class="col-md-8"></div>
			<div class="col-md-4">
              <label class="checkbox-inline">
              <input type="checkbox" class="flat-grey" value="" >
               SMS Alert on Absent </label>
            </div>
		   </div>
            <table class="table table-striped table-bordered table-hover" id="sample-table-2">
              <thead>
                <tr>
                  <th class="center"></th>
                  <th>Full Name</th>
                  <th >Role Number</th>
                  <th>Mark Attendance</th>
                </tr>
              </thead>
              <tbody>
                <? $sr=0;?>
                <? foreach($studentList as $k=>$v):?>
                <? $sr++;?>
                <? $checkAttendance=get_object_by_query('student_attendance','student_id="'.$v->student_id.'" and school_id="'.$school_id.'" and student_attendance_date="'.$ondate.'"');?>
                <tr id="studentList<?=$v->student_id?>">
                  <td class="center"><a class="image" href="<?=make_url('profile-studentpublicprofile','id='.$v->student_id)?>"  rel="day_view"> <img src="<?=($v->student_image)?createImazeSize(get_small('student'),$v->student_image,30,30):'design/images/avatar-1-small.jpg';?>" alt="image" /> </a></td>
                  <td><?=$v->student_first_name.' '.$v->student_last_name?></td>
                  <td ><?=$v->student_roll_number?></td>
                  <td class="center"><div > <img  src="design/images/absent-big.png" id="Absent" onClick="markAttendance('1','<?=$v->student_id?>')" <?=($checkAttendance && $checkAttendance->student_attendance==0)?'':'style="display:none"'?>> <img src="design/images/present-big.png" id="Present" onClick="markAttendance('0','<?=$v->student_id?>')" <?=($checkAttendance && $checkAttendance->student_attendance==0)?'style="display:none"':''?>>
                      <input type="hidden" id="student_attendance" name="student_attendance[<?=$v->student_id?>]" value="<?=($checkAttendance)?$checkAttendance->student_attendance:1?>" />
                      <input type="hidden" id="student_attendance_date" name="student_attendance_date" value="<?=$ondate?>" />
                    </div></td>
                </tr>
                <? endforeach;?>
              </tbody>
            </table>
            <? if($checkAttendance):?>
            <div  align="center" >
              <input name="submit" class="btn btn-primary" type="submit" value="Update"   disabled />
            </div>
            <? else:?>
            <div align="center" >
              <input name="submit"  class="btn btn-primary" type="submit" value="Submit" />
            </div>
          </form>
          <? endif;?>
          <? endif;?>
        </div>
      </div>
      <!-- end: TABLE WITH IMAGES PANEL -->
    </div>
  </div>
</div>
<div>
  <!-- Footer Start-->
  <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
  <!-- Footer End-->
</div>
<!-- Main End -->
</body>
</html>
