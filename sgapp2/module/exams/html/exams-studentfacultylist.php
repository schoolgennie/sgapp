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
<? include_once(DIR_FS_SITE_INCLUDE.'studentNav.php'); ?>
<!--Navigation End -->
<div class="main-content">
	<?php display_form_error();?>
	<div class="container">
		<!-- start: PAGE HEADER -->
		<div class="row">
			<div class="col-sm-12">
				<!-- start: STYLE SELECTOR BOX -->
				<!-- end: STYLE SELECTOR BOX -->
				<!-- start: PAGE TITLE & BREADCRUMB -->
				<!-- end: PAGE TITLE & BREADCRUMB -->
				<div class="page-header">
					<h1>
						
						<small>Faculty List</small></h1>
				</div>
			</div>
		</div>
		<!-- end: PAGE HEADER -->
		
		
			
		<div class="row">
			<div class="col-md-12">
				<!-- start: BASIC TABLE PANEL -->
				<div class="panel panel-default">
					<div class="panel-heading"> <i class="fa fa-external-link-square"></i>Faculty List
						
					</div>
					<div class="panel-body">
									<table class="table table-striped  table-hover" >
										<thead>
											<tr>
												<th class="center">Photo</th>
												<th>Full Name</th>
												<th>Designation</th>
												<th class="hidden-xs">Email</th>
												<th class="hidden-xs">Phone</th>
												
											</tr>
										</thead>
										<tbody>
                                          <? if($facultyList):?>
                                           <? foreach($facultyList as $k=>$v):?>
											<tr>
												<td class="center">
                                              
                                                <img src="<?=($v->faculty_image)?createImazeSize(get_small('faculty'),$v->faculty_image,40,40):'design/images/avatar-1.jpg'?>" alt="image"/>
                                                </td>
												<td><strong><?=$v->faculty_first_name.' '.$v->faculty_last_name?></strong></td>
												<td><span class="label label-info "><?=$fcultyDesignationArray[$v->faculty_designation]?></span></td>
												<td class="hidden-xs">
												<a href="<?=$v->faculty_email_official?>" rel="nofollow" target="_blank">
													<?=$v->faculty_email_official?>
												</a></td>
												<td class="hidden-xs"><?=$v->faculty_mobile?></td>
												
												
											</tr>
											<? endforeach;?>
                                            <? else:?>
                                            <tr><td colspan="5">No Faculty.</td></tr>
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
	<!-- Footer Start-->
	<? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
	<!-- Footer End-->
</div>
</div>
<!-- Main End -->
</body>
</html>
