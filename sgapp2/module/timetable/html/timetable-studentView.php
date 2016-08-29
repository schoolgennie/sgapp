<!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link href="design/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="design/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" href="design/plugins/select2/select2.css">
		<link rel="stylesheet" href="design/plugins/datepicker/css/datepicker.css">
		<link rel="stylesheet" href="design/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
		<link rel="stylesheet" href="design/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
		<link rel="stylesheet" href="design/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
		<link rel="stylesheet" href="design/plugins/jQuery-Tags-Input/jquery.tagsinput.css">
		<link rel="stylesheet" href="design/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
		<link rel="stylesheet" href="design/plugins/summernote/build/summernote.css">
		<link rel="stylesheet" href="design/plugins/ckeditor/contents.css">


<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/flot/jquery.flot.js"></script>
<script src="design/plugins/flot/jquery.flot.pie.js"></script>
<script src="design/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="design/plugins/jquery.sparkline/jquery.sparkline.js"></script>
<script src="design/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="design/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script src="design/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
<script src="design/js/index.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->


<script>
			jQuery(document).ready(function() {
			    $("#newClassForm").validate();
				Index.init();
				
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
		
<!-- start: JAVASCRIPTS for FormElements -->
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
    
<!--smoth menu start-->
<link href="css/front.css" media="screen, projection" rel="stylesheet" type="text/css">

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
          <!-- start: STYLE SELECTOR BOX -->
          <!-- end: STYLE SELECTOR BOX -->
          <!-- start: PAGE TITLE & BREADCRUMB -->
          <!-- end: PAGE TITLE & BREADCRUMB -->
          <div class="page-header">
            <h1>Time Table</h1>
          </div>
        </div>
      </div>
 	<div class="row">
						
						<div class="col-md-12">
							<!-- start: BORDERED TABLE PANEL -->
							<div class="panel panel-default">
								<div class="panel-body">
									
									<table class="table table-bordered " id="">
										<thead>
											<tr>
												<th>Period</th>
												<th>Time</th>
												<? foreach($weekDaysArray as $keyWeekDays=>$valueWeekDays):?>
                                                <th><?=$valueWeekDays?></th>
                                                <? endforeach;?>
										</thead>
										<tbody>
                                            <? foreach($activeTimetablePeriodList as $activeTimetablePeriodListKey=>$activeTimetablePeriodListValue):?>
											<tr>
												<td><strong><?=$activeTimetablePeriodListValue->time_table_period?></strong></td>
												<td><strong><?=$activeTimetablePeriodListValue->time_table_period_time?></strong></td>
											    <? foreach($weekDaysArray as $keyWeekDays=>$valueWeekDays):?>
                                                <td>
												<? $getDataForActiveTimeTable=getDataForActiveTimeTable($class,$activeTimeTable->time_table_id,$activeTimetablePeriodListValue->time_table_period_id,$keyWeekDays);?>
												<?=$getDataForActiveTimeTable?$getDataForActiveTimeTable->subject_name.' <span class="label label-default "> '.$getDataForActiveTimeTable->faculty_first_name.' '.$getDataForActiveTimeTable->faculty_last_name.' </span>':'';?></td>
                                                <? endforeach;?>
											</tr>
                                            <? endforeach;?>
											
											
										</tbody>
									</table>
                                   
								</div>	
								
							</div>
							<!-- end: BORDERED TABLE PANEL -->
						</div>
					</div>
	 
                    
      
      
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
