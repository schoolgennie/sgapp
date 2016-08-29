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
            <h1> <small>Academic Test</small></h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <?
            #handle sections here.
            switch ($section):
			case 'list':
			?>
      <div class="row">
        <div class="col-md-12">
          <!-- start: BASIC TABLE PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-external-link-square"></i> Scholastic Area </div>
            <div class="panel-body">
              <table class="table table-hover" >
                <thead>
                  <tr>
                    <th class="center hidden-xs">#</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th class="center">Academic Performance</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <? foreach($allAssignedSubjecClasstList as $k=>$v):?>
                  <tr>
                    <td class="center hidden-xs"><?=$k+1?></td>
                    <td><?=$v->class_name?></td>
                    <td class=""><?=$v->subject_name?></td>
                    <td class="center">
                    <a href="<?=make_long_url('exams-createacademictest','insertStudentTestMarks','insertStudentTestMarks','faculty_management_id='.$v->faculty_management_id.'&academic_test_id=1')?>"  class="btn btn-teal tooltips" data-placement="top" data-toggle="modal" data-original-title="FA1 Test Result"><i class=""></i>FA1</a> 
                    <a href="<?=make_long_url('exams-createacademictest','insertStudentTestMarks','insertStudentTestMarks','faculty_management_id='.$v->faculty_management_id.'&academic_test_id=2')?>"  class="btn btn-teal tooltips" data-placement="top" data-toggle="modal" data-original-title="FA2 Test Result"><i class=""></i>FA2</a> 
                    <a href="<?=make_long_url('exams-createacademictest','insertStudentTestMarks','insertStudentTestMarks','faculty_management_id='.$v->faculty_management_id.'&academic_test_id=3')?>"  class="btn btn-teal tooltips" data-placement="top" data-toggle="modal" data-original-title="FA3 Test Result"><i class=""></i>FA3</a> 
                    <a href="<?=make_long_url('exams-createacademictest','insertStudentTestMarks','insertStudentTestMarks','faculty_management_id='.$v->faculty_management_id.'&academic_test_id=4')?>"  class="btn btn-teal tooltips" data-placement="top" data-toggle="modal" data-original-title="FA4 Test Result"><i class=""></i>FA4</a>
                     <a href="<?=make_long_url('exams-createacademictest','insertStudentTestMarks','insertStudentTestMarks','faculty_management_id='.$v->faculty_management_id.'&academic_test_id=5')?>"  class="btn btn-purple tooltips" data-placement="top" data-toggle="modal" data-original-title="SA1 Test Result"><i class=""></i>SA1</a> 
                     <a href="<?=make_long_url('exams-createacademictest','insertStudentTestMarks','insertStudentTestMarks','faculty_management_id='.$v->faculty_management_id.'&academic_test_id=6')?>"  class="btn btn-purple tooltips" data-placement="top" data-toggle="modal" data-original-title="SA2 Test Result"><i class=""></i>SA2</a> 
                     </td>
                    <td class="center">
                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                        <div class="btn-group"> <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"> <i class="fa fa-cog"></i> <span class="caret"></span> </a>
                          <ul role="menu" class="dropdown-menu pull-right">
                            <li role="presentation"> <a role="menuitem" tabindex="-1" href="#"> <i class="fa fa-edit"></i> FA1 </a> </li>
                            <li role="presentation"> <a role="menuitem" tabindex="-1" href="#"> <i class="fa fa-edit"></i> FA2 </a> </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <? endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end: BASIC TABLE PANEL -->
        </div>
      </div>
      <? if($inchargeClass): ?>
      <? foreach($inchargeClass as $classKey=>$classValue):?>
      <div class="row">
        <div class="col-md-12">
          <!-- start: BASIC TABLE PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-external-link-square"></i>
              <?=$classValue->class_name?>
              <div class="panel-tools"> <span class="label label-success ">You are Incharge</span> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
            </div>
            <div class="panel-body">
              <table class="table table-striped table-condensed table-hover" >
                <thead>
                  <tr>
                    <th class="center">Photo</th>
                    <th>Full Name</th>
                    <th class="hidden-xs">Roll Number</th>
                    <th class="hidden-xs">Prefered Email</th>
                    <th class="hidden-xs">Phone</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <? $studentList=get_all_record_by_query('student','class_id="'.$classValue->class_id.'" and student_is_active!=0');?>
                  <? if($studentList):?>
                  <? foreach($studentList as $key=>$value):?>
                  <tr>
                    <td class="center"><img src="<?=($value->student_image)?createImazeSize(get_small('student'),$value->student_image,30,30):'design/images/avatar-1-small.jpg'?>" alt="image"/> </td>
                    <td><?=$value->student_first_name.' '.$value->student_last_name?></td>
                    <td class="hidden-xs"><?=$value->student_roll_number?>
                    </td>
                    <td class="hidden-xs"><?=$value->student_email_id?></td>
                    <td class="hidden-xs"><?=$value->student_contact?>
                    </td>
                    <td class="center"><div class=""> <a href="<?=make_long_url('exams-createacademictest','scholastic','scholastic','student_id='.$value->student_id);?>"  class="btn btn-purple tooltips" data-placement="top" data-toggle="modal" data-original-title="Co-Scholastic Performance"><i class=""></i>Co-Scholastic</a> </div></td>
                  </tr>
                  <? endforeach;?>
                  <? else:?>
                  <tr>
                    <td colspan="6">No Students.</td>
                  </tr>
                  <? endif;?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end: BASIC TABLE PANEL -->
        </div>
      </div>
      <? endforeach;?>
      <? endif;?>
      <? 
		break;
		case 'insertStudentTestMarks':
		#html code here.
		?>
      <!-- student list to enter marks start-->
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4"> <a class="btn btn-default" onClick="window.location.href='<?=make_url('exams-createacademictest')?>'"> <i class="fa fa-arrow-left "></i> Back </a> </div>
          <div class="col-md-8">
            <h2>
              <?=$academicTestDetail->academic_test_name?>
              Exam</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- start: BASIC TABLE PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-external-link-square"></i> Enter Marks </div>
            <div class="panel-body">
              <? if($studentList):?>
              <form id="frmTestMarks" action="<?=make_long_url('exams-createacademictest', 'insertStudentTestMarks', 'list','faculty_management_id='.$faculty_management_id.'&academic_test_id='.$academic_test_id);?>" method="post" name="frmTestMarks" >
                <table class="table table-hover" >
                  <thead>
                    <tr>
                      <th class="center hidden-xs">#</th>
                      <th>Roll Number</th>
                      <th>Name</th>
                      <th>Marks<span class="symbol required"></span></th>
                      <th>Review Comments</th>
                    </tr>
                  </thead>
                  <tbody>
                    <? foreach($studentList as $key=>$value):?>
                    <tr>
                      <td class="center hidden-xs"><?=$k+1?></td>
                      <td><?=$value->student_roll_number?>
                      </td>
                      <td><?=$value->student_first_name.' '.$value->student_last_name?></td>
                      <td><input type="number" max="100" name="academic_test_obtain_marks[]" placeholder="Enter Marks" id="" class="form-control input-sm" value="<?=studentAcademicTestResult($faculty_id,$academic_test_id,$managementDetail->class_id,$managementDetail->subject_id,$value->student_id,'academic_test_obtain_marks')?>" >
                      </td>
                      <td ><input type="text" name="academic_test_obtain_marks_comment[]" placeholder="Review Comments" id="" class="form-control input-sm" value="<?=studentAcademicTestResult($faculty_id,$academic_test_id,$managementDetail->class_id,$managementDetail->subject_id,$value->student_id,'academic_test_obtain_marks_comment')?>">
                      </td>
                    </tr>
                  <input type="hidden" name="student_id[]" value="<?=$value->student_id?>" />
                  <? endforeach;?>
                  </tbody>
                  
                </table>
                <div  align="center" >
                  <input type="submit" name="submit" value="Save" class="btn btn-primary">
                </div>
              </form>
              <? endif;?>
            </div>
          </div>
          <!-- end: BASIC TABLE PANEL -->
        </div>
      </div>
      <!-- student list to enter marks end-->
      <? 
		break;
		case 'scholastic':
		#html code here.
		?>

         
           
           
              <div class="row">
                <div class="col-sm-12">
                  <div class="tabbable">
                    <ul id="myTab" class="nav nav-tabs tab-teal">
                      <li class="active"> <a href="#classinfo" data-toggle="tab"> <i class="green fa fa-home"></i> Student Info </a> </li>
                      <li class="dropdown"> <a href="#cs-area"  data-toggle="tab"> Co-Scholastic Areas </a> </li>
                      <li class="dropdown"> <a href="#cs-activities" data-toggle="tab"> Co-Scholastic Activities </a> </li>
                      <li> <a href="#healthstatus" data-toggle="tab"> Health Status </a> </li>
                      <li> <a href="#selfawareness" data-toggle="tab"> Self Awareness </a> </li>
                    </ul>
                    <div class="tab-content">
                      <!-- start: Class Info -->
                      <div class="tab-pane in active" id="classinfo">
                        <h1>
                          <?=$studentDetail->student_first_name.' '.$studentDetail->student_last_name?>
                        </h1>
                        <h4> Roll Number:
                          <?=$studentDetail->student_roll_number?>
                        </h4>
                        <hr>
                      </div>
                      <!-- end: Class Info -->
                      <!-- start: Co-Scholastic Area -->
                      <div class="tab-pane" id="cs-area">
                        <form id="frmScholastic" action="<?=make_long_url('exams-createacademictest', 'scholastic', 'list','student_id='.$student_id);?>" method="post" name="frmScholastic" >
                          <h1> Life Skills <small> (Five Point Scale)</small> </h1>
						  <div class="row">
							<div class="col-sm-12">
							  <div class="panel panel-default">
								
								<div class="panel-body">
								  <h3>Thinking Skills</h3>
								  <div class="row">
									
									<div class="col-sm-5">
                                        <? foreach($coScholasticThinkingSkillsArray as $k=>$v):?>
                                        <? $thinking_skills_array=explode(',',$scholasticDetail->thinking_skills_array);?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="thinking_skills_array[]" value="<?=$k?>" <?=in_array($k,$thinking_skills_array)?'checked':'';?> class="green">
													<?=$v?>
												</label>
											</div>
										<? endforeach;?>	
									</div>
									<div class="col-sm-4">		
									  <div class="form-group">
										<label> Additional Comments </label>
										<span class="input-icon">
										<textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" name="thinking_skills" id="thinking_skills"><?=(isset($scholasticDetail->thinking_skills))?$scholasticDetail->thinking_skills:''?></textarea>
										</span> </div>
											
									</div>
									<div class="col-sm-1">
									  <div class="form-group">
										<label>Grade</label>
										<span class="input-icon">
										<select id="thinking_skills_grade" name="thinking_skills_grade" class="form-control input-sm">
										  <option value=""> </option>
										  <? foreach($CoScholasticGradeFiveArray as $k=>$v):?>
										  <option value="<?=$v?>" <?=(isset($scholasticDetail->thinking_skills_grade) && $scholasticDetail->thinking_skills_grade==$v)?'selected':''?>>
										  <?=$v?>
										  </option>
										  <? endforeach;?>
										</select>
										</span> </div>
									</div>
								   </div>
								   <hr>
									 <h3>Social Skills</h3>
									<div class="row">
									<div class="col-sm-5">
											 <? foreach($coScholasticSocialSkillsArray as $k=>$v):?>
                                             <? $social_skills_array=explode(',',$scholasticDetail->social_skills_array);?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="social_skills_array[]" value="<?=$k?>" <?=in_array($k,$social_skills_array)?'checked':'';?> class="green">
													<?=$v?>
												</label>
											</div>
										<? endforeach;?>
									</div>	
									<div class="col-sm-4">
									  <div class="form-group">
									  <label> Additional Comments </label>
										<span class="input-icon">
										<textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="social_skills" name="social_skills"><?=(isset($scholasticDetail->social_skills))?$scholasticDetail->social_skills:''?></textarea>
										</span> </div>
									</div>
									<div class="col-sm-1">
									  <div class="form-group">
										<label>Grade</label>
										<span class="input-icon">
										<select id="social_skills_grade" name="social_skills_grade" class="form-control input-sm">
										  <option value=""> </option>
										  <? foreach($CoScholasticGradeFiveArray as $k=>$v):?>
										  <option value="<?=$v?>" <?=(isset($scholasticDetail->social_skills_grade) && $scholasticDetail->social_skills_grade==$v)?'selected':''?>>
										  <?=$v?>
										  </option>
										  <? endforeach;?>
										</select>
										</span> </div>
									</div>
									</div>
									 <hr>
									 <h3>Emotional Skills</h3>
									<div class="row">
									<div class="col-sm-5">
											 <? foreach($coScholasticEmotionalSkillsArray as $k=>$v):?>
                                             <? $emotional_skills_array=explode(',',$scholasticDetail->emotional_skills_array);?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="emotional_skills_array[]" value="<?=$k?>" <?=in_array($k,$emotional_skills_array)?'checked':'';?> class="green">
													<?=$v?>
												</label>
											</div>
										<? endforeach;?>
									</div>
									<div class="col-sm-4">
									  <div class="form-group">
										<label> Additional Comments </label>
										<span class="input-icon">
										<textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="emotional_skills" name="emotional_skills"><?=(isset($scholasticDetail->emotional_skills))?$scholasticDetail->emotional_skills:''?></textarea>
										</span> </div>
									</div>
									<div class="col-sm-1">
									  <div class="form-group">
										<label>Grade</label>
										<span class="input-icon">
										<select id="emotional_skills_grade" name="emotional_skills_grade" class="form-control input-sm">
										  <option value=""> </option>
										  <? foreach($CoScholasticGradeFiveArray as $k=>$v):?>
										  <option value="<?=$v?>" <?=(isset($scholasticDetail->emotional_skills_grade) && $scholasticDetail->emotional_skills_grade==$v)?'selected':''?>>
										  <?=$v?>
										  </option>
										  <? endforeach;?>
										</select>
										</span> </div>
									</div>
								  </div>
                          		</div>
						  	   </div>
						  	  </div>
						  </div> 
						 
                          <h1> Attitudes & Values <small> (Three Point Scale) </small> </h1>
						  <div class="row">
							<div class="col-sm-12">
							  <div class="panel panel-default">
								
								<div class="panel-body">
									 <h3>Attitude towards Teachers</h3>
								  <div class="row">
								  	<div class="col-sm-5">
											 <? foreach($coScholasticAttitudeTowardsTeachersArray as $k=>$v):?>
                                             <? $attitude_towards_teachers_array=explode(',',$scholasticDetail->attitude_towards_teachers_array);?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="attitude_towards_teachers_array[]" value="<?=$k?>"  <?=in_array($k,$attitude_towards_teachers_array)?'checked':'';?> class="green">
													<?=$v?>
												</label>
											</div>
										<? endforeach;?>
									</div>
									<div class="col-sm-4">
									  <div class="form-group">
									  <label> Additional Comments </label>
										<span class="input-icon">
										<textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="attitude_towards_teachers" name="attitude_towards_teachers"><?=(isset($scholasticDetail->attitude_towards_teachers))?$scholasticDetail->attitude_towards_teachers:''?></textarea>
										</span> </div>
									</div>
									<div class="col-sm-1">
									  <div class="form-group">
										<label>Grade</label>
										<span class="input-icon">
										<select id="attitude_towards_teachers_grade" name="attitude_towards_teachers_grade" class="form-control input-sm">
										  <option value=""> </option>
										  <? foreach($CoScholasticGradeThreeArray as $k=>$v):?>
										  <option value="<?=$v?>" <?=(isset($scholasticDetail->attitude_towards_teachers_grade) && $scholasticDetail->attitude_towards_teachers_grade==$v)?'selected':''?>>
										  <?=$v?>
										  </option>
										  <? endforeach;?>
										</select>
										</span> </div>
									</div>
								  </div>
								  <hr>
									 <h3>Attitude towards School-Mates</h3>
								  <div class="row">
								  	<div class="col-sm-5">
											 <? foreach($coScholasticAttitudeTowardsSchoolMatesArray as $k=>$v):?>
                                             <? $attitude_towards_schoolmates_array=explode(',',$scholasticDetail->attitude_towards_schoolmates_array);?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="attitude_towards_schoolmates_array[]" value="<?=$k?>" <?=in_array($k,$attitude_towards_schoolmates_array)?'checked':'';?> class="green">
													<?=$v?>
												</label>
											</div>
										<? endforeach;?>
									</div>	
									<div class="col-sm-4">
									  <div class="form-group">
										<label> Additional Comments </label>
										<span class="input-icon">
										<textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="attitude_towards_schoolmates" name="attitude_towards_schoolmates"><?=(isset($scholasticDetail->attitude_towards_schoolmates))?$scholasticDetail->attitude_towards_schoolmates:''?></textarea>
										</span> </div>
									</div>
									<div class="col-sm-1">
									  <div class="form-group">
										<label>Grade</label>
										<span class="input-icon">
										<select id="attitude_towards_schoolmates_grade" name="attitude_towards_schoolmates_grade" class="form-control input-sm">
										  <option value=""> </option>
										  <? foreach($CoScholasticGradeThreeArray as $k=>$v):?>
										  <option value="<?=$v?>" <?=(isset($scholasticDetail->attitude_towards_schoolmates_grade) && $scholasticDetail->attitude_towards_schoolmates_grade==$v)?'selected':''?>>
										  <?=$v?>
										  </option>
										  <? endforeach;?>
										</select>
										</span> </div>
									</div>
								  </div>
								  <hr>
									 <h3>Attitude towards School Programming & Environment</h3>
								  <div class="row">	
								  		<div class="col-sm-5">
											 <? foreach($coScholasticAttitudeTowardsSchoolProgrammingEnvironmentArray as $k=>$v):?>
                                             <? $attitude_towards_school_programming_environment_array=explode(',',$scholasticDetail->attitude_towards_school_programming_environment_array);?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="attitude_towards_school_programming_environment_array[]" value="<?=$k?>" <?=in_array($k,$attitude_towards_school_programming_environment_array)?'checked':'';?> class="green">
													<?=$v?>
												</label>
											</div>
										<? endforeach;?>
									</div>	
									<div class="col-sm-4">
									  <div class="form-group">
									  <label> Additional Comments </label>
										<span class="input-icon">
										<textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="attitude_towards_school_programming_environment" name="attitude_towards_school_programming_environment"><?=(isset($scholasticDetail->attitude_towards_school_programming_environment))?$scholasticDetail->attitude_towards_school_programming_environment:''?></textarea>
										</span> </div>
									</div>
									<div class="col-sm-1">
									  <div class="form-group">
										<label>Grade</label>
										<span class="input-icon">
										<select id="attitude_towards_school_programming_environment_grade" name="attitude_towards_school_programming_environment_grade" class="form-control input-sm">
										  <option value=""> </option>
										  <? foreach($CoScholasticGradeThreeArray as $k=>$v):?>
                                          <? $attitude_towards_teachers_array=explode(',',$scholasticDetail->attitude_towards_teachers_array);?>
										  <option value="<?=$v?>" <?=(isset($scholasticDetail->attitude_towards_school_programming_environment_grade) && $scholasticDetail->attitude_towards_school_programming_environment_grade==$v)?'selected':''?>>
										  <?=$v?>
										  </option>
										  <? endforeach;?>
										</select>
										</span> </div>
									</div>
								  </div>
								  <hr>
									 <h3>Value Systems</h3>
								  <div class="row">	
								  	<div class="col-sm-5">
											 <? foreach($coScholasticValueSystemsEmotionalSkillsArray as $k=>$v):?>
                                             <? $value_systems_array=explode(',',$scholasticDetail->value_systems_array);?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="value_systems_array[]" value="<?=$k?>" <?=in_array($k,$value_systems_array)?'checked':'';?> class="green">
													<?=$v?>
												</label>
											</div>
										<? endforeach;?>
									</div>	
									<div class="col-sm-4">
									  <div class="form-group">
									  <label> Additional Comments </label>
										<span class="input-icon">
										<textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="value_systems" name="value_systems"><?=(isset($scholasticDetail->value_systems))?$scholasticDetail->value_systems:''?></textarea>
										</span> </div>
									</div>
									<div class="col-sm-1">
									  <div class="form-group">
										<label>Grade</label>
										<span class="input-icon">
										<select id="value_systems_grade" name="value_systems_grade" class="form-control input-sm">
										  <option value=""> </option>
										  <? foreach($CoScholasticGradeThreeArray as $k=>$v):?>
										  <option value="<?=$v?>" <?=(isset($scholasticDetail->value_systems_grade) && $scholasticDetail->value_systems_grade==$v)?'selected':''?>>
										  <?=$v?>
										  </option>
										  <? endforeach;?>
										</select>
										</span> </div>
									</div>
								  </div>
						  		</div>
						  	  </div>
							 </div>
						  </div>   
                          <div class="row">
                            <div class="col-sm-5"></div>
                            <button type="submit" class="btn btn-primary" name="submit" value="submit"> Save changes </button>
                          </div>
                        </form>
						<?php /*?> <h3> Work Education </h3>
                          <div class="row">
                          <div class="col-sm-5">
											 <? foreach($coScholasticWorkEducationArray as $k=>$v):?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="work_education_array[]" value="<?=$k?>" class="green">
													<?=$v?>
												</label>
											</div>
										<? endforeach;?>
									</div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>&nbsp;</label>
                                <span class="input-icon">
                                <textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="work_education" name="work_education" ><?=(isset($scholasticDetail->work_education))?$scholasticDetail->work_education:''?>
</textarea>
                                </span> </div>
                            </div>
                            <div class="col-sm-1">
                              <div class="form-group">
                                <label>Grade</label>
                                <span class="input-icon">
                                <select id="work_education_grade" name="work_education_grade" class="form-control">
                                  <option value=""> </option>
                                  <? foreach($CoScholasticGradeArray as $k=>$v):?>
                                  <option value="<?=$v?>" <?=(isset($scholasticDetail->work_education_grade) && $scholasticDetail->work_education_grade==$v)?'selected':''?>>
                                  <?=$v?>
                                  </option>
                                  <? endforeach;?>
                                </select>
                                </span> </div>
                            </div>
                          </div>
                          <h3> Visual and Performing Arts </h3>
                          <div class="row">
                          <div class="col-sm-5">
											 <? foreach($coScholasticVisualAndPerformingArtsArray as $k=>$v):?>
											<div class="checkbox">
												<label>
													<input type="checkbox" name="visual_and_performing_arts_array[]" value="<?=$k?>" class="green">
													<?=$v?>
												</label>
											</div>
										<? endforeach;?>
									</div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>&nbsp;</label>
                                <span class="input-icon">
                                <textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="visual_and_performing_arts" name="visual_and_performing_arts"><?=(isset($scholasticDetail->visual_and_performing_arts))?$scholasticDetail->visual_and_performing_arts:''?>
</textarea>
                                </span> </div>
                            </div>
                            <div class="col-sm-1">
                              <div class="form-group">
                                <label>Grade</label>
                                <span class="input-icon">
                                <select id="visual_and_performing_arts_grade" name="visual_and_performing_arts_grade" class="form-control">
                                  <option value=""> </option>
                                  <? foreach($CoScholasticGradeArray as $k=>$v):?>
                                  <option value="<?=$v?>" <?=(isset($scholasticDetail->visual_and_performing_arts_grade) && $scholasticDetail->visual_and_performing_arts_grade==$v)?'selected':''?>>
                                  <?=$v?>
                                  </option>
                                  <? endforeach;?>
                                </select>
                                </span> </div>
                            </div>
                          </div><?php */?>
                      </div>
                      <!-- end: Co-Scholastic Area -->
                      <!-- start: Co-Scholastic Activities -->
                      <div class="tab-pane" id="cs-activities">
                        <form id="frmScholastic" action="<?=make_long_url('exams-createacademictest', 'scholastic', 'list','student_id='.$student_id);?>" method="post" name="frmScholastic" >
                          <h1> Life Skills </h1>
                          <div class="row">
                            <div class="col-sm-10">
                              <div class="form-group">
                                <label>Literary & Creative Skills</label>
                                <span class="input-icon">
                                <textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="literary_creative_skills" name="literary_creative_skills"><?=(isset($scholasticDetail->literary_creative_skills))?$scholasticDetail->literary_creative_skills:''?>
</textarea>
                                </span> </div>
                            </div>
                            <div class="col-sm-1">
                              <div class="form-group">
                                <label>Grade</label>
                                <span class="input-icon">
                                <select id="literary_creative_skills_grade" name="literary_creative_skills_grade" class="form-control">
                                  <option value=""> </option>
                                  <? foreach($CoScholasticGradeArray as $k=>$v):?>
                                  <option value="<?=$v?>" <?=(isset($scholasticDetail->literary_creative_skills_grade) && $scholasticDetail->literary_creative_skills_grade==$v)?'selected':''?>>
                                  <?=$v?>
                                  </option>
                                  <? endforeach;?>
                                </select>
                                </span> </div>
                            </div>
                            <div class="col-sm-10">
                              <div class="form-group">
                                <label>Organizational & Leadership Skills</label>
                                <span class="input-icon">
                                <textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="organizational_leadership_skills" name="organizational_leadership_skills"><?=(isset($scholasticDetail->organizational_leadership_skills))?$scholasticDetail->organizational_leadership_skills:''?>
</textarea>
                                </span> </div>
                            </div>
                            <div class="col-sm-1">
                              <div class="form-group">
                                <label>Grade</label>
                                <span class="input-icon">
                                <select id="organizational_leadership_skills_grade" name="organizational_leadership_skills_grade" class="form-control">
                                  <option value=""> </option>
                                  <? foreach($CoScholasticGradeArray as $k=>$v):?>
                                  <option value="<?=$v?>" <?=(isset($scholasticDetail->organizational_leadership_skills_grade) && $scholasticDetail->organizational_leadership_skills_grade==$v)?'selected':''?>>
                                  <?=$v?>
                                  </option>
                                  <? endforeach;?>
                                </select>
                                </span> </div>
                            </div>
                          </div>
                          <h1> Health and Physical Activities </h1>
                          <div class="row">
                            <div class="col-sm-10">
                              <div class="form-group">
                                <label>Sports/Indigenous Sports</label>
                                <span class="input-icon">
                                <textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="sports_indigenous_sports" name="sports_indigenous_sports"><?=(isset($scholasticDetail->sports_indigenous_sports))?$scholasticDetail->sports_indigenous_sports:''?>
</textarea>
                                </span> </div>
                            </div>
                            <div class="col-sm-1">
                              <div class="form-group">
                                <label>Grade</label>
                                <span class="input-icon">
                                <select id="sports_indigenous_sports_grade" name="sports_indigenous_sports_grade" class="form-control">
                                  <option value=""> </option>
                                  <? foreach($CoScholasticGradeArray as $k=>$v):?>
                                  <option value="<?=$v?>" <?=(isset($scholasticDetail->sports_indigenous_sports_grade) && $scholasticDetail->sports_indigenous_sports_grade==$v)?'selected':''?>>
                                  <?=$v?>
                                  </option>
                                  <? endforeach;?>
                                </select>
                                </span> </div>
                            </div>
                            <div class="col-sm-10">
                              <div class="form-group">
                                <label>Yoga</label>
                                <span class="input-icon">
                                <textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize:none; height: 69px;" id="yoga" name="yoga"><?=(isset($scholasticDetail->yoga))?$scholasticDetail->yoga:''?>
</textarea>
                                </span> </div>
                            </div>
                            <div class="col-sm-1">
                              <div class="form-group">
                                <label>Grade</label>
                                <span class="input-icon">
                                <select id="yoga_grade" name="yoga_grade" class="form-control">
                                  <option value=""> </option>
                                  <? foreach($CoScholasticGradeArray as $k=>$v):?>
                                  <option value="<?=$v?>" <?=(isset($scholasticDetail->yoga_grade) && $scholasticDetail->yoga_grade==$v)?'selected':''?>>
                                  <?=$v?>
                                  </option>
                                  <? endforeach;?>
                                </select>
                                </span> </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-5"></div>
                            <button type="submit" class="btn btn-primary" name="submit" value="submit"> Save changes </button>
                          </div>
                        </form>
                      </div>
                      <!-- end: Co-Scholastic Activities -->
                      <!-- start: Health Status -->
                      <div class="tab-pane" id="healthstatus">
                        <form id="frmScholastic" action="<?=make_long_url('exams-createacademictest', 'scholastic', 'list','student_id='.$student_id);?>" method="post" name="frmScholastic" >
                          <h1> Health Status </h1>
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Height</label>
                                <span class="input-icon">
                                <input type="text" placeholder="Height" class="form-control" id="height" name="height" value="<?=(isset($scholasticDetail->height))?$scholasticDetail->height:''?>">
                                <i class="fa fa-hand-o-right"></i> </span> </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Weight</label>
                                <span class="input-icon">
                                <input type="text" placeholder="Weight" class="form-control" id="weight" name="weight" value="<?=(isset($scholasticDetail->weight))?$scholasticDetail->weight:''?>">
                                <i class="fa fa-hand-o-right"></i> </span> </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Blood Group</label>
                                <span class="input-icon">
                                <input type="text" placeholder="Blood Group" class="form-control" id="blood_group" name="blood_group" value="<?=(isset($scholasticDetail->blood_group))?$scholasticDetail->blood_group:''?>">
                                <i class="fa fa-hand-o-right"></i> </span> </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Vision(L)</label>
                                <span class="input-icon">
                                <input type="text" placeholder="Vision(L)" class="form-control" id="vision_l" name="vision_l" value="<?=(isset($scholasticDetail->vision_l))?$scholasticDetail->vision_l:''?>">
                                <i class="fa fa-hand-o-right"></i> </span> </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Vision(R)</label>
                                <span class="input-icon">
                                <input type="text" placeholder="Vision(R)" class="form-control" id="vision_r" name="vision_r" value="<?=(isset($scholasticDetail->vision_r))?$scholasticDetail->vision_r:''?>">
                                <i class="fa fa-hand-o-right"></i> </span> </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Dental Hygiene</label>
                                <span class="input-icon">
                                <input type="text" placeholder="Dental Hygiene" class="form-control" id="dental_hygiene" name="dental_hygiene" value="<?=(isset($scholasticDetail->dental_hygiene))?$scholasticDetail->dental_hygiene:''?>">
                                <i class="fa fa-hand-o-right"></i> </span> </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-5"></div>
                            <button type="submit" class="btn btn-primary" name="submit" value="submit"> Save changes </button>
                          </div>
                        </form>
                      </div>
                      <!-- end: Health Status -->
                      <!-- start: Self Awareness -->
                      <div class="tab-pane" id="selfawareness">
                        <form id="frmScholastic" action="<?=make_long_url('exams-createacademictest', 'scholastic', 'list','student_id='.$student_id);?>" method="post" name="frmScholastic" >
                          <h1> Self Awareness </h1>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="form-field-24">My Goals</label>
                                <textarea rows="6" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 69px;" id="my_goals" name="my_goals"><?=(isset($scholasticDetail->my_goals))?$scholasticDetail->my_goals:''?>
</textarea>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="form-field-24">My Strengths</label>
                                <textarea class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 69px;" id="my_strengths" name="my_strengths"><?=(isset($scholasticDetail->my_strengths))?$scholasticDetail->my_strengths:''?>
</textarea>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="form-field-24">My Interests and Hobbies</label>
                                <textarea class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 69px;" id="my_interests_hobbies" name="my_interests_hobbies"><?=(isset($scholasticDetail->my_interests_hobbies))?$scholasticDetail->my_interests_hobbies:''?>
</textarea>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="form-field-24">Resposibilities Discharged / Exceptional Achievements</label>
                                <textarea class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 69px;" id="resposibilities_discharged_exceptional_achievements" name="resposibilities_discharged_exceptional_achievements"><?=(isset($scholasticDetail->resposibilities_discharged_exceptional_achievements))?$scholasticDetail->resposibilities_discharged_exceptional_achievements:''?>
</textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-5"></div>
                            <button type="submit" class="btn btn-primary" name="submit" value="submit"> Save changes </button>
                          </div>
                        </form>
                      </div>
                      <!-- start: Self Awareness -->
                    </div>
                  </div>
                </div>
              </div>
           
         

      <? 
			break;
			default:break;
            endswitch;
            ?>
      <!--test listing end-->
    </div>
    <!-- Footer Start-->
    <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
    <!-- Footer End-->
  </div>
</div>
<!-- Main End -->
</body>
</html>
