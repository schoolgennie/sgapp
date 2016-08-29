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
<script>
			jQuery(document).ready(function() {
				FormElements.init();
				
			});
		</script>		
<link href="css/style1.css" media="screen, projection" rel="stylesheet" type="text/css">
<script>
			jQ172(document).ready(function(){
			
				// binds form submission and fields to the validation engine
				jQ172("#frmClass").validationEngine();
			});
	
		</script>
<script>
function toggle(id)
{
 $('#'+id).toggle();
}
</script>   
<script>
function editFeeCategory(id)
{
 $('#feeCategoryList'+id).toggle();
 $('#feeCategoryEdit'+id).toggle();
}
function editFeeCollectionType(id)
{

 $('#feeCollectionTypeList'+id).toggle();
 $('#feeCollectionTypeEdit'+id).toggle();
}
function editFeeStructure(id)
{
 $('#feeStructureList'+id).toggle();
 $('#feeStructureEdit'+id).toggle();
}
</script>    
<script>
function addTimeTablePeriod(){
    $('#addTimeTablePeriod').append(
         '<tr>'+
			'<th><input id="time_table_period[]" class="form-control input-sm" type="text" name="time_table_period[]" placeholder="Period Name" required></th>'+
			'<th><input id="time_table_period_time[]" class="form-control input-sm" type="text" name="time_table_period_time[]" placeholder="Period Time" required></th>'+
			'<th><span class="btn btn-xs btn-bricky"><i class="fa fa-trash-o"></i></span></th>'+
		  '</tr>');
        $(".fa-trash-o").bind("click", Delete);
};

function Delete(){
    var par = $(this).parent().parent().parent(); //tr
    par.remove();
};
<!--check faculty Occupied-->
function isThisFacultyOccupied(faculty_id,time_table_id,time_table_period_id,time_table_management_week_day)
{
myArray=faculty_id.split(',');
faculty_id=myArray[1];
$.ajax({
		
			type: "POST",
			url: "<?=DIR_WS_SITE?>?page=timetable-timetableajax",
			data:"mode=isThisFacultyOccupied&faculty_id="+faculty_id+"&time_table_id="+time_table_id+"&time_table_period_id="+time_table_period_id+"&time_table_management_week_day="+time_table_management_week_day,
			
			success: function(output)
			 {
				  if(output)
				  {
				  alert(output);
				  return false;
				  }
				
			}   
		});

}
	<!--get faculty list-->
	function getFacultyList(val,classId)
	{
	   	$.ajax({
		
			type: "POST",
			url: "<?=DIR_WS_SITE?>?page=administration-classajax",
			data:"mode=getFacultyList&designation="+val,
			
			success: function(output)
			 {
				  $("#assignFaculty"+classId+" #facultyList").html(output);
				
			}   
		});
		
	}
</script>      
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
     <?
	#handle sections here.
	switch ($section):
	case 'list':
	?>
	<div class="row panel-body">					
	
		<button type="button" class="btn btn-primary" onClick="window.location.href='<?=make_long_url('timetable-timetable','insertTimetable','insertTimetable')?>'">
			New Time Table
		</button>
		
	
	</div>
		
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped  " >
                      <thead>
                        <tr>
                          <th>Time Table Name</th>
                          <th></th>
                          <th></th>
                          <th></th>
						  <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <? if($timeTableList):?>
                        <?  foreach($timeTableList as $k=>$v):?>
                        <tr>
                          <td><?=$v->time_table;?></td>
						  <td><button class="btn btn-primary btn-sm" type="button" onClick="window.location.href='<?=make_long_url('timetable-timetable','assignPeriodToFaculty','assignPeriodToFaculty','timeTableId='.$v->time_table_id)?>'">Configure</button></td>
                          <td><button class="btn btn-primary btn-sm" type="button" onClick="window.location.href='<?=make_long_url('timetable-timetable','updateTimeTable','updateTimeTable','timeTableId='.$v->time_table_id)?>'">Edit</button></td>
						  <td><?=($v->time_table_is_active==1)?'<span class="label label-success"> Active</span>':'<span class="label label-inverse"> Inactive</span>'?></td>
						  <td><? if($v->time_table_is_active==0):?>
                              <button class="btn btn-blue btn-sm" type="button" onClick="window.location.href='<?=make_long_url('timetable-timetable','changeTimeTable','changeTimeTable','timeTableId='.$v->time_table_id)?>'">Make Active</button>
                              <? endif;?>    
                           </td>
                            <td> 
                            <? if($v->time_table_is_active==0):?>
                            <span class="btn btn-xs btn-bricky" onClick="confirm('are you sure you want to delete this record? All data related with this record would be deleted')?window.location.href='<?=make_long_url("timetable-timetable","deleteTimeTable","list","timeTableId=".$v->time_table_id)?>':''"><i class="fa fa-trash-o"></i></span>
                            <? else:?>
                            <span class="btn btn-xs btn-bricky" onClick="alert('This is active tione table, To delete this time table make active to another.')"><i class="fa fa-trash-o"></i></span>
                            <? endif;?>
                            </td>
                        </tr>
                        <? endforeach;?>
                        <? else:?>
                        <tr>
                          <td colspan="4">No Time Table</td>
                        </tr>
                        <? endif;?>
                      </tbody>	
                    </table>
                </div>
              </div>
			
			<div class="row">
						
						<div class="col-md-12">
							<!-- start: BORDERED TABLE PANEL -->
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="">
													Classwise
												</label>
												<select name="class" class="form-control" onChange="if(this.value){ window.location.href='<?=make_url('timetable-timetable','class=')?>'+this.value}else{window.location.href='<?=make_url('timetable-timetable')?>'}">
													<option value="">--Select Class--</option>
													 <? foreach($classList as $classListKey=>$classListValue):?>
                                                      <option value="<?=$classListValue->class_id?>" <?=(isset($class) && $class==$classListValue->class_id)?'selected':'';?> ><?=$classListValue->class_name?></option>
                                                     <? endforeach;?>
												</select>
											</div>
										</div>	
										<div class="col-md-4">
											<div class="form-group">
												<label for="">
													Teacherwise
												</label>
												<select name="class" class="form-control" onChange="if(this.value){ window.location.href='<?=make_url('timetable-timetable','faculty=')?>'+this.value}else{window.location.href='<?=make_url('timetable-timetable')?>'}">
													<option value="">--Select Class--</option>
													 <? foreach($allFacultyList as $facultyListKey=>$facultyListValue):?>
                                                      <option value="<?=$facultyListValue->faculty_id?>" <?=(isset($faculty) && $faculty==$facultyListValue->faculty_id)?'selected':'';?> ><?=$facultyListValue->faculty_first_name.' '.$facultyListValue->faculty_last_name?></option>
                                                     <? endforeach;?>
												</select>
											</div>
										</div>
										
									</div>
									<? if($class):?>
									<h3>Timetable for <?=$classDetails->class_name?></h3>
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
                                                <td><?=getDataForActiveTimeTable($class,$activeTimeTable->time_table_id,$activeTimetablePeriodListValue->time_table_period_id,$keyWeekDays)->subject_name?></td>
                                                <? endforeach;?>
											</tr>
                                            <? endforeach;?>
											
											
										</tbody>
									</table>
                                    <? elseif($faculty):?>
                                    <h3>Timetable for <strong> <?=$facultyDetails->faculty_first_name.' '.$facultyDetails->faculty_last_name?></strong></h3>
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
                                                <td><?=(getDataForFacultyOfActiveTimeTable($faculty,$activeTimeTable->time_table_id,$activeTimetablePeriodListValue->time_table_period_id,$keyWeekDays))?getDataForFacultyOfActiveTimeTable($faculty,$activeTimeTable->time_table_id,$activeTimetablePeriodListValue->time_table_period_id,$keyWeekDays)->subject_name.' <span class="label label-info "> '.getDataForFacultyOfActiveTimeTable($faculty,$activeTimeTable->time_table_id,$activeTimetablePeriodListValue->time_table_period_id,$keyWeekDays)->class_name:' </span>';?></td>
                                                <? endforeach;?>
											</tr>
                                            <? endforeach;?>
											
											
										</tbody>
									</table>
                                    <? else:?>
                                    <h3>Today Timetable</h3>
									<table class="table table-bordered " id="">
										<thead>
											<tr>
												<th></th>
                                                <? foreach($activeTimetablePeriodList as $activeTimetablePeriodListKey=>$activeTimetablePeriodListValue):?>
												<th><?=$activeTimetablePeriodListValue->time_table_period?><br><?=$activeTimetablePeriodListValue->time_table_period_time?></th>
												<? endforeach;?>
											</tr>
										</thead>
										<tbody>
                                        <? foreach($classList as $classListKey=>$classListValue):?>
											<tr>
                                               
                                                <td><strong><?=ucwords($classListValue->class_name);?></strong></td>
												 <? foreach($activeTimetablePeriodList as $activeTimetablePeriodListKey=>$activeTimetablePeriodListValue):?>
												<td><?=getDataForActiveTimeTable($classListValue->class_id,$activeTimeTable->time_table_id,$activeTimetablePeriodListValue->time_table_period_id,$weekDay)->subject_name?></td>
												<? endforeach;?>
                                               
											</tr>
										<? endforeach;?>	
											
										</tbody>
									</table>
                                    <? endif;?>
								</div>	
								
							</div>
							<!-- end: BORDERED TABLE PANEL -->
						</div>
					</div>
	 <? 
				    break;
					case 'insertTimetable':
					?>		
      <div class="row">
        <div class="col-sm-12">
          <!-- start: ACCORDION PANEL -->
          <div class="panel panel-default">
            
            <div class="panel-body">
				<form role="form" class="form-horizontal" action="<?=make_long_url('timetable-timetable','insertTimetable','insertTimetable')?>" method="post">
				<div class="row">					
              		<div class="col-md-6">
					
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-field-1">
								Time Table Name
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="" name="time_table" id="time_table" class="form-control" required>
							</div>
						</div>
					
						<div class="input-group input-append bootstrap-timepicker">
										<input type="text" class="form-control time-picker" placeholder="Timepicker not working :-(" >
										<span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
									</div>
					
					</div>	
					
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								Define Periods
							</div>
							<div class="panel-body">
							<button class="btn btn-sm btn-green" type="button" onClick="addTimeTablePeriod();"><i class="fa fa-plus"></i> Add Period</button>
						
							<table class="table " id="">
                                <thead id="addTimeTablePeriod">
                                  <tr>
                                    <th></th>
                                    <th>
									</th>
									<th></th>
                                  </tr>
                                </thead>
							</table>
							</div>
						</div>		
					</div>		
				</div>						
				
				<div class="row">					
					<div class="col-md-12" align="center">
						<button type="submit" name="CreateTimeTable" class="btn btn-primary btn-squared">
							Create Time Table
						</button>
                        <button type="button" name="saveTimeTable" class="btn btn-primary btn-squared" onClick="window.location.href='<?=make_url('timetable-timetable')?>'">Back</button>
					</div>
				</div>		
				</form>	  
             	
			  </div>
            </div>
          </div>
      </div>  
	 <? 
				    break;
					case 'updateTimeTable':
					?>		
      <div class="row">
        <div class="col-sm-12">
          <!-- start: ACCORDION PANEL -->
          <div class="panel panel-default">
            
            <div class="panel-body">
				<form role="form" class="form-horizontal" action="<?=make_long_url('timetable-timetable','updateTimeTable','updateTimeTable','timeTableId='.$timeTableId)?>" method="post">
				<div class="row">					
              		<div class="col-md-6">
					
						<div class="form-group">
							<label class="col-sm-3 control-label" for="form-field-1">
								Time Table Name
							</label>
							<div class="col-sm-8">
								<input type="text" placeholder="" name="time_table" id="time_table" class="form-control" value="<?=$timeTableDetails->time_table?>" required>
							</div>
						</div>
					
						
					
					</div>	
					
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								Define Periods
							</div>
							<div class="panel-body">
							<button class="btn btn-sm btn-green" type="button" onClick="addTimeTablePeriod();"><i class="fa fa-plus"></i> Add Period</button>
						
							<table class="table " id="">
                                <thead id="addTimeTablePeriod">
                                 <? if($assignPeriodToFacultyList):?>
                                  <? foreach($assignPeriodToFacultyList as $k=>$v):?>
                                   <tr>
                                    <th><input id="time_table_period_old[]" class="form-control input-sm" type="text" name="time_table_period_old[<?=$v->time_table_period_id?>]" placeholder="Period Name" value="<?=$v->time_table_period?>" required></th>
                                    <th><input id="time_table_period_time_old[]" class="form-control input-sm" type="text" name="time_table_period_time_old[<?=$v->time_table_period_id?>]" placeholder="Period Time" value="<?=$v->time_table_period_time?>" required></th>
                                    <th><span class="btn btn-xs btn-bricky" onClick="confirm('are you sure you want to delete this record? All data related with this record would be deleted')?window.location.href='<?=make_long_url("timetable-timetable","deletePeriod","list","timeTableId=".$timeTableId."&timeTablePeriodId=".$v->time_table_period_id)?>':''"><i class="fa fa-trash-o"></i></span></th>
                                  </tr>
                                  <? endforeach;?>
                                 <? endif;?> 
                                </thead>
							</table>
							</div>
						</div>		
					</div>		
				</div>						
				
				<div class="row">					
					<div class="col-md-12" align="center">
						<button type="submit" name="CreateTimeTable" class="btn btn-primary btn-squared">
							Update Time Table
						</button>
                        <button type="button" name="saveTimeTable" class="btn btn-primary btn-squared" onClick="window.location.href='<?=make_url('timetable-timetable')?>'">Back</button>
					</div>
				</div>		
				</form>	  
             	
			  </div>
            </div>
          </div>
      </div>  
	 <? 
				    break;
					case 'assignPeriodToFaculty':
					?>	
	 <div class="row">
        <div class="col-sm-12">
          <!-- start: ACCORDION PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-reorder"></i> Configure Timetable
              <div class="panel-tools"></div>
            </div>
            <form action="<?=make_long_url('timetable-timetable','assignPeriodToFaculty','assignPeriodToFaculty','timeTableId='.$timeTableId)?>" method="post">
            <div class="panel-body">
				<div class="row alert">
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<select name="class_id"  class="form-control input-sm" onChange="if(this.value){ window.location.href='<?=make_long_url('timetable-timetable','assignPeriodToFaculty','assignPeriodToFaculty','timeTableId='.$timeTableId.'&class=')?>'+this.value}else{window.location.href='<?=make_long_url('timetable-timetable','assignPeriodToFaculty','assignPeriodToFaculty','timeTableId='.$timeTableId)?>'}">
											 <option value="">--Select Class--</option>
											 <? foreach($classList as $classListKey=>$classListValue):?>
											  <option value="<?=$classListValue->class_id?>" <?=(isset($class) && $class==$classListValue->class_id)?'selected':'';?> ><?=$classListValue->class_name?></option>
											 <? endforeach;?>
											</select>
					</div>						
				</div>
                <? if($class):?>
				<div class="row">					
              		<div class="col-md-12">
					  
						   <? if($assignPeriodToFacultyList):?>
							<!-- start: CONDENSED TABLE PANEL -->
							<div class="panel panel-default">
								
								<div class="panel-body">
									<div class="row">					
              						<div class="col-md-12">
                                     
									<table class="table " id="">
										<thead>
											<tr>
												<th>Period</th>
												<th>Time</th>
                                                <? foreach($weekDaysArray as $keyWeekDays=>$valueWeekDays):?>
                                                <th><?=$valueWeekDays?></th>
                                                <? endforeach;?>
											</tr>
										</thead>
                                       
										<tbody>
                                           <? foreach($assignPeriodToFacultyList as $KetPeriod=>$ValuePeriod):?>
											<tr>
												<td><?=$ValuePeriod->time_table_period?></td>
												<td><?=$ValuePeriod->time_table_period_time?></td>
                                                <? foreach($weekDaysArray as $keyWeekDays=>$valueWeekDays):?>
                                                <td>
													<select  class="form-control" onChange="isThisFacultyOccupied(this.value,<?=$timeTableId?>,<?=$ValuePeriod->time_table_period_id?>,<?=$keyWeekDays?>)" name="faculty_management_id[]">
												 		    <option value=",">Empty</option>
                                                            <? foreach($facultyList as $keyFaculty=>$valueFaculty):?>
												  			<option value="<?=$valueFaculty->faculty_management_id.','.$valueFaculty->faculty_id?>" <?=(getAssignedPeriodInTimeTable($class,$timeTableId,$ValuePeriod->time_table_period_id,$keyWeekDays,$valueFaculty->faculty_management_id))?'selected':''?>><?=$valueFaculty->subject_name.' - '.$valueFaculty->faculty_first_name.' '.$valueFaculty->faculty_last_name?></option>
                                                            <? endforeach;?>
													</select>
                                                    
                                                    <input type="hidden" name="time_table_period_id[]" value="<?=$ValuePeriod->time_table_period_id?>">
                                                    <input type="hidden" name="time_table_management_week_day[]" value="<?=$keyWeekDays?>">
												</td>
                                                <? endforeach;?>
												
											</tr>
                                            <? endforeach;?>
										</tbody>	
                                        
									</table>
                                  
									</div>
									</div>
									<div class="row">					
              						<div class="col-md-4"></div>
									<div class="col-md-4" align="center">
										<button type="submit" name="saveTimeTable" class="btn btn-primary ">
											Save Time Table
										</button>
										<button type="button" name="saveTimeTable" class="btn btn-gray " onClick="window.location.href='<?=make_url('timetable-timetable')?>'">Back</button>
									</div>
									</div>
									</div>
								</div>
                                  <? else:?>
                                    No time table.
                                    <? endif;?>
							</div>
							<!-- end: CONDENSED TABLE PANEL -->
						</div>
						<? endif;?>
					</div>
					</form>	
					  
             	
			  </div>
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
