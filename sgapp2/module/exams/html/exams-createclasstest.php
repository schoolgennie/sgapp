    <!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link rel="stylesheet" href="design/plugins/ladda-bootstrap/dist/ladda-themeless.min.css">
<link rel="stylesheet" href="design/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css">
<link rel="stylesheet" href="design/plugins/bootstrap-social-buttons/social-buttons-3.css">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link href="design/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="design/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
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
<script src="design/plugins/ladda-bootstrap/dist/spin.min.js"></script>
<script src="design/plugins/ladda-bootstrap/dist/ladda.min.js"></script>
<script src="design/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js"></script>
<script src="design/js/ui-buttons.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
			jQuery(document).ready(function() {
				UIButtons.init();
			});
		</script>
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
<script src="design/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script src="design/js/ui-modals.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
			jQuery(document).ready(function() {
				UIModals.init();
			});
		</script>
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
function getStudentTestSubject(id)
{
	$.ajax({
		type: "GET",
		url: "<?=DIR_WS_SITE?>?page=exams-createtestajax",
		data:"mode=getStudentTestSubject&class_id="+id,
		success: function(output){
		    if(output)
			{
			    $("#studentTestSubjectList").html(output);
			}
		}   
	});}
	
function deleteStudentTest(id)
{
	$.ajax({
		type: "GET",
		url: "<?=DIR_WS_SITE?>?page=exams-createtestajax",
		data:"mode=deleteStudentTest&student_test_id="+id,
		success: function(output){
			location.reload();
		}   
	});
}

function getCreatedTestSearchResult(id)
{
$('#frmfilter').submit();
return true;
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
            <h1>
              <?=$inchargeClass->class_name?>
              <small>Class</small></h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <a data-toggle="modal" class="btn btn-primary" role="button" href="#newTest"> New Test &nbsp;<i class="fa fa-plus-circle" ></i> </a>
      <div class="modal fade" id="newTest" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
          <form id="frmTest" action="<?=make_long_url('exams-createclasstest', 'insertTest', 'assignedClassList');?>" method="post" name="frmTest" >
            <div class="modal-header">
              <div class="row">
                <div class="col-sm-7">
                  <h4 class="modal-title">Create New Test</h4>
                </div>
                <div class="col-sm-4">
                  <input name="student_test_date" placeholder="Date*" type="text" class="form-control  date-picker" id="student_test_date" data-date-format="dd-mm-yyyy" value="<?=date('d-m-Y')?>" required/>
                </div>
                <div class="col-sm-1">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                </div>
              </div>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <input name="student_test_name" type="text" placeholder="Test Name*" id="" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-3">
                  <input name="student_test_max_marks" placeholder="Max Marks*" type="number" class="form-control" value="100" max="100" required/>
                </div>
                <div class="col-sm-3">
                  <select name="class_id"  class="form-control" onChange="getStudentTestSubject(this.value)" required>
                    <option value="">Class*</option>
                    <? foreach($assignedClassList as $k=>$v):?>
                    <option value="<?=$v->class_id?>">
                    <?=$v->class_name?>
                    </option>
                    <? endforeach;?>
                  </select>
                </div>
                <div class="col-sm-3">
                  <div id="studentTestSubjectList">
                    <select name="subject_id"  class="form-control" required>
                      <option value="">Subject*</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button aria-hidden="true" data-dismiss="modal" class="btn btn-default"> Cancel </button>
              <input name="submit" type="submit" class="btn btn-primary" value="Create">
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-body">
              <form id="frmfilter" action="<?=make_url('exams-createclasstest');?>" method="post" name="frmfilter" >
                <ul class="nav nav-tabs " >
                  <li><a>Search By</a></li>
                  <li class="dropdown" > <a href="#" data-toggle="dropdown" class="dropdown-toggle" > Class &nbsp; <i class="fa fa-caret-down width-auto"></i> </a>
                    <ul  class="dropdown-menu  inside-clickable">
                      <li >
                        <div class="panel-body">
                          <? foreach($assignedClassList as $k=>$v):?>
                          <label class="checkbox-inline">
                          <input type="checkbox" class="flat-grey" name="class_id[]" onChange="getCreatedTestSearchResult()" value="<?=$v->class_id?>" <?=in_array($v->class_id,explode(',',$class_id))?'checked':'';?>  />
                          <?=$v->class_name?>
                          </label>
                          <? endforeach;?>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown"> <a href="#"  data-toggle="dropdown"  class="dropdown-toggle" > Subject  &nbsp; <i class="fa fa-caret-down width-auto"></i> </a>
                    <ul class="dropdown-menu inside-clickable">
                      <li >
                        <div class="panel-body">
                          <? foreach($assignedSubjectList as $k=>$v):?>
                          <label class="checkbox-inline">
                          <input type="checkbox" class="flat-grey" name="subject_id[]" onChange="getCreatedTestSearchResult()" value="<?=$v->subject_id?>" <?=in_array($v->subject_id,explode(',',$subject_id))?'checked':'';?>/>
                          <?=$v->subject_name?>
                          </label>
                          <? endforeach;?>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li > <a >Date &nbsp; <i class="fa fa-caret-right width-auto"></i> </a> </li>
				 
				  	<li>  	
							<div class="input-group ">
							  <input name="dateRange" id="dateRange" type="text" class="form-control date-range" onChange="getCreatedTestSearchResult()" value="<?=($dateRange)?implode(' - ',$dateRange):'';?>">
							   </div>
							  
                  </li>
                  <li>
                    <div class="input-group ">
                      <input type="submit" value="Search" class="btn btn-teal">
                    </div>
                  </li>
                </ul>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- start: BASIC TABLE PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-external-link-square"></i> Class Test </div>
            <div class="panel-body">
              <table class="table table-hover" >
                <thead>
                  <tr>
                    <th class="center hidden-xs">#</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th class="hidden-xs visible-sm">Test Name</th>
                    <th class="center ">Max Marks</th>
                    <th >Date</th>
                    <th class="visible-md visible-lg hidden-sm hidden-xs">Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                
                <? if($createdTestList):?>
                <!--test details start-->
                <? foreach($createdTestList as $k=>$v):?>
                <tr>
                  <td class="center hidden-xs"><?=$k+1?></td>
                  <td><span class="label label-info">
                    <?=$v->class_name?>
                    </span></td>
                  <td class=""><?=$v->subject_name?></td>
                  <td class="hidden-xs visible-sm"><?=$v->student_test_name?></td>
                  <td class="center "><?=$v->student_test_max_marks?></td>
                  <td ><?=$v->student_test_date?></td>
                  <td class="visible-md visible-lg hidden-sm hidden-xs"><? $getEnterMarkStaus=get_object_by_query_count('student_test_obtain_marks','faculty_id="'.$faculty_id.'"  and student_test_id="'.$v->student_test_id.'"');?>
                    <?=($getEnterMarkStaus>0)?'<span class="label label-success ">Complete</span>':'<span class="label label-danger">Pending</span>';?>
                  </td>
                  <td class="center"><div class="visible-md visible-lg hidden-sm hidden-xs"> <a href="#classdetails<?=$v->student_test_id?>"  class="btn btn-teal tooltips" data-placement="top" data-toggle="modal" data-original-title="Enter Marks"><i class="fa fa-edit"></i></a> <a onClick="deleteStudentTest('<?=$v->student_test_id?>')" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Delete Test"><i class="fa fa-times fa fa-white"></i></a> </div>
                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                      <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"> <i class="fa fa-cog"></i> <span class="caret"></span> </a>
                        <ul role="menu" class="dropdown-menu pull-right">
                          <li role="presentation"> <a role="menuitem" tabindex="-1" href="#"> <i class="fa fa-edit"></i> Enter Marks </a> </li>
                          <li role="presentation"> <a role="menuitem" tabindex="-1" onClick="deleteStudentTest('<?=$v->student_test_id?>')"> <i class="fa fa-times"></i> Delete Test </a> </li>
                        </ul>
                      </div>
                    </div>
                    <!-- student list to enter marks start-->
                    <? $studentList=get_all_record_by_query('student as a,faculty_management as b,student_subject as c','b.class_id="'.$v->class_id.'" and b.faculty_id="'.$faculty_id.'" and b.subject_id="'.$v->subject_id.'" and c.faculty_management_id=b.faculty_management_id and c.student_id=a.student_id and a.student_is_active!=0');?>
                    <? if($studentList):?>
                    <div id="classdetails<?=$v->student_test_id?>" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
                      <form id="frmTestMarks" action="<?=make_long_url('exams-createclasstest', 'insertStudentTestMarks', 'list');?>" method="post" name="frmTestMarks" >
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                          <h4 class="modal-title">Enter Marks</h4>
                        </div>
                        <div class="panel-body panel-scroll">
                          <table class="table table-condensed table-hover" id="">
                            <thead>
                              <tr>
                                <th class="hidden-xs"> Roll Number </th>
                                <th>Name</th>
                                <th>Marks<span class="symbol required"></span></th>
                              </tr>
                            </thead>
                            <tbody>
                              <? foreach($studentList as $key=>$value):?>
                              <tr>
                                <td class="hidden-xs"><?=$value->student_roll_number?>
                                </td>
                                <td><?=$value->student_first_name.' '.$value->student_last_name?></td>
                                <td><div class="form-group">
                                    <div class="col-sm-3" style="padding-left:0;">
                                      <input type="number" name="student_test_obtain_marks[]" placeholder="" id="" class="form-control input-sm" value="<?=studentTestResult($faculty_id,$v->student_test_id,$value->student_id,'student_test_obtain_marks')?>" max="<?=$v->student_test_max_marks?>" >
                                    </div>
                                    <div class="col-sm-8">
                                      <input type="text" name="student_test_obtain_marks_comment[]" placeholder="Review Comments" id="" class="form-control input-sm" value="<?=studentTestResult($faculty_id,$v->student_test_id,$value->student_id,'student_test_obtain_marks_comment')?>">
                                    </div>
                                  </div></td>
                              </tr>
                            <input type="hidden" name="student_id[]" value="<?=$value->student_id?>" />
                            <? endforeach;?>
                            </tbody>
                            
                          </table>
                        </div>
                        <div class="modal-footer">
                          <label class="checkbox-inline">
                          <input type="checkbox" class="flat-teal" id="sendSms" name="sendSms" >
                          Send SMS </label>
                          <label class="checkbox-inline">
                          <input type="checkbox" class="flat-teal" name="sendMail" id="sendMail"  checked="checked">
                          Send Email </label>
                          <input type="hidden" name="student_test_id" value="<?=$v->student_test_id?>" />
                          <button type="button" data-dismiss="modal" class="btn btn-light-grey"> Close </button>
                          <input type="submit" name="submit" value="Save" class="btn btn-teal">
                        </div>
                      </form>
                    </div>
                    <? endif;?>
                    <!-- student list to enter marks end-->
                  </td>
                </tr>
                <? endforeach;?>
                <? endif;?>
                </tbody>
                
              </table>
            </div>
          </div>
          <!-- end: BASIC TABLE PANEL -->
        </div>
      </div>
      <!--test listing end-->
    </div>
    <script>
    $("button.btn-success").click(function(){

  getCreatedTestSearchResult();
});
    </script>
    <!-- Footer Start-->
    <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
    <!-- Footer End-->
  </div>
</div>
<!-- Main End -->
</body>
</html>
