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

<script>
			jQ172(document).ready(function(){
			
				// binds form submission and fields to the validation engine
				jQ172("#frmClass").validationEngine();
			});
	
		</script>
<!--smoth menu start-->


<!--end menu start-->

<script>
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
	<!--edit class details-->
	function editClassDetails(class_id)
	{
	
	  var class_name=$("#editClassDetails"+class_id+" #class_name").val();
	  var class_incharge=$("#editClassDetails"+class_id+"  #class_incharge").val();
	  var class_location=$("#editClassDetails"+class_id+"  #class_location").val();
	  
	  if(class_name=="")
	   {
	    $("#collapseEditClass"+class_id+" #alert1").toggle();
        $("#collapseEditClass"+class_id+" #alert1").delay(2500).fadeOut();
        return false;
	   }
	   
	  if(class_name)
	  { 
			$.ajax({
		
			type: "POST",
			url: "<?=DIR_WS_SITE?>?page=administration-classajax",
			data:"mode=editClassDetails&class_name="+class_name+"&class_id="+class_id+"&class_incharge="+class_incharge+'&class_location='+class_location,
			
			success: function(output)
			 {
				output=output.split("~!");
				if(output[1]==1)
				{
					location.reload();
				}
				else 
				{ 
				alert(output[1]);
				
				}
			}   
		});
		}
	 
	
	
	}
	<!--edit class details-->
	<!--activate deactivate class start-->
	function activeDeativeClass(class_id,status)
	{
	
		   
		$.ajax({
		
			type: "POST",
			url: "<?=DIR_WS_SITE?>?page=administration-classajax",
			data:"mode=activeDeativeClass&class_id="+class_id+"&class_is_active="+status,
			
			success: function(output)
			 {
					
					location.reload();
			
			}   
		});
	}
	
	<!--activate deactivate class end-->
	<!--activate deactivate faculty management start-->
	function activeDeativeFacultyManagement(faculty_management_id,status)
	{
		$.ajax({
		
			type: "POST",
			url: "<?=DIR_WS_SITE?>?page=administration-classajax",
			data:"mode=activeDeativeFacultyManagement&faculty_management_id="+faculty_management_id+"&faculty_management_is_active="+status,
			
			success: function(output)
			 { 
			 location.reload();
				
			}   
		});
	}
	
	<!--activate deactivate faculty management end-->
	
	<!-- add New subject Faculty In Class  start-->
	function addNewsubjectFacultyInClass(class_id)
	{
	   var faculty_role=$("#assignFaculty"+class_id+"  #role").val();
	   var faculty_id=$("#assignFaculty"+class_id+"  #faculty_id").val();
	   var subject_id=$("#assignFaculty"+class_id+"  #subject_id").val();
	   var student_id=$("#assignFaculty"+class_id+"  #student_id");
		var studentList ='';
		student_id.each(function() {
			if (this.checked)
				//studentList +=studentList+','+this.value;
				studentList += this.value+',';
		});

	  
	   //alert(studentList);
	   if(faculty_role=="")
	   {
	    $("#assignFaculty"+class_id+" #alert1").toggle();
        $("#assignFaculty"+class_id+" #alert1").delay(2500).fadeOut();
        return false;
	   }
	    if(faculty_id=="")
	   {
	    $("#assignFaculty"+class_id+" #alert2").toggle();
        $("#assignFaculty"+class_id+" #alert2").delay(2500).fadeOut();
        return false;
	   }
	    if(subject_id=="")
	   {
	    $("#assignFaculty"+class_id+" #alert3").toggle();
        $("#assignFaculty"+class_id+" #alert3").delay(2500).fadeOut();
        return false;
	   }
	  
	   if(faculty_id && subject_id)
	   { 
		$.ajax({
		
			type: "POST",
			url: "<?=DIR_WS_SITE?>?page=administration-classajax",
			data:"mode=addNewsubjectFacultyInClass&class_id="+class_id+"&faculty_id="+faculty_id+"&subject_id="+subject_id+"&student_id="+studentList,
			
			success: function(output)
			 {
					
					 if(output)
					{
					alert(output);
					}
					else
					{ 
					location.reload();
					}
					
				
			}   
		});
		}
		
	}
	
	<!-- add New subject Faculty In Class  end-->
	
	
	
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
          <!-- start: STYLE SELECTOR BOX -->
          <!-- end: STYLE SELECTOR BOX -->
          <!-- start: PAGE TITLE & BREADCRUMB -->
          <!-- end: PAGE TITLE & BREADCRUMB -->
          <div class="page-header">
		  <h1>Class Management</h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <div class="row">
        <div class="panel-body">
          <div class="col-sm-6"> <a href="#composeClass" data-toggle="modal" class="btn btn-primary"><i class="fa  fa-plus-circle "></i> &nbsp;New Class </a> </div>
        </div>
      </div>
      <div id="composeClass" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h4 class="modal-title">Create New Class </h4>
        </div>
        <form id="newClassForm" action="<?=make_long_url('administration-class', 'insert', 'list');?>" method="post" name="newClassForm" >
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Class Name <span class="symbol required"></span></label>
                  <input name="class_name" id="class_name"  class="form-control" type="text" placeholder="Class Name" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Location </label>
                  <input name="class_location" id="class_location"  class="form-control" type="text" placeholder="Class Location">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Incharge Teacher</label>
                  <select name="class_incharge" class="form-control">
                    <option value="">- No Teacher -</option>
                    <? foreach($facultyList as $facultyKey=>$facultyValue):?>
                    <option value="<?=$facultyValue->faculty_id?>" >
                    <?=$facultyValue->faculty_first_name.' '.$facultyValue->faculty_last_name?>
                    </option>
                    <? endforeach;?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-light-grey"> Cancel </button>
            <input type="submit" name="submit" class="btn btn-blue" value="Create">
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <!-- start: ACCORDION PANEL -->
          <div class=" ">
            
            <div class="panel-body">
              <div class="panel-group accordion-custom " id="accordion">
                <? if($classList):?>
                <? foreach($classList as $k=>$v):?>
                <? $studentList=get_all_record_by_query('student','class_id="'.$v->class_id.'" and student_is_active!=0');?>
                <div class="panel-body">
				<div class="panel panel-default">
				
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <div class="row">
                        <div class="col-sm-4"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEditClass<?=$v->class_id?>">  <i class="fa fa-chevron-circle-down"></i> Class ID (<?=$v->class_id?>) &nbsp;  <span class="label label-info ">
                          <?=$v->class_name?>
                          </span> </a> </div>
                        <div class="col-sm-4"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFacultyList<?=$v->class_id?>"> <i class="fa fa-chevron-circle-down"></i> Faculty List & Assignment </a> </div>
                        <div class="col-sm-2"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseStudentList<?=$v->class_id?>"> <i class="fa fa-chevron-circle-down"></i> Student List </a> </div>
                      </div>
                    </h4>
                    <div class="panel-tools">
                      <? if($v->class_is_active==1):?>
                      <span class="label label-success">Active</span>&nbsp;&nbsp;
                      <a onClick="activeDeativeClass(<?=$v->class_id?>,0)" class="btn btn-xs btn-bricky tooltips" data-placement="left" data-original-title="Deactivate"><i class="fa fa-ban fa fa-white"></i></a>
                      <? else:?>
                      <span class="label label-inverse">Inactive</span>&nbsp;&nbsp;
                     <a onClick="activeDeativeClass(<?=$v->class_id?>,1)" class="btn btn-xs btn-primary tooltips" data-placement="left" data-original-title="Activate"><i class="fa fa-check fa fa-white"></i></a>
                      <? endif;?>
                    </div>
                  </div>
                  <!--edit class start-->
                  <div id="collapseEditClass<?=$v->class_id?>" class="panel-collapse collapse ">
                    <div class="panel-body">
                      <div class="row" id="editClassDetails<?=$v->class_id?>">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Class Name <span class="symbol required"></span></label>
                            <input name="class_name" id="class_name" value="<?=$v->class_name?>"  class="form-control" type="text" placeholder="Class Name">
                          </div>
                          <div class="alert alert-danger" id="alert1" style="display:none">Please enter class name</div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Location </label>
                            <input name="class_location" id="class_location" value="<?=$v->class_location?>"  class="form-control" type="text" placeholder="Class Location">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Incharge Teacher</label>
                            <select name="class_incharge" id="class_incharge" class="form-control">
                              <option value="">- No Teacher -</option>
                              <? foreach($facultyList as $facultyKey=>$facultyValue):?>
                              <option value="<?=$facultyValue->faculty_id?>" <?=(isset($v->class_incharge) && $facultyValue->faculty_id==$v->class_incharge)?'selected':'';?> >
                              <?=$facultyValue->faculty_first_name.' '.$facultyValue->faculty_last_name?>
                              </option>
                              <? endforeach;?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group"> <br>
                            <a onClick="editClassDetails(<?=$v->class_id?>)" data-toggle="modal" class="btn  btn-primary tooltips" data-placement="left" data-original-title="Save"><i class="fa fa-save fa fa-white"></i></a> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--edit class end-->
                  <!--faculty list start-->
                  <div id="collapseFacultyList<?=$v->class_id?>" class="panel-collapse collapse ">
                    
					<div class="panel-body">
                      <!-- assign faculty start-->
                      <div class="row panel-body">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2"> <a href="#assignFaculty<?=$v->class_id?>" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa  fa-user "></i> &nbsp;Assign Faculty </a> </div>
                      </div>
                      <div id="assignFaculty<?=$v->class_id?>" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                          <h4 class="modal-title">Assign Faculty </h4>
                        </div>
                        <form id="frmSubject" name="frmSubject" >
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Faculty Category <span class="symbol required"></span></label>
                                  <select onChange="getFacultyList(this.value,<?=$v->class_id?>)" class="form-control" id="role">
                                    <option value="">-- Category --</option>
                                    <? foreach($fcultyDesignationArray as $designationKey=>$designationValue):?>
                                    <? if($designationValue!='students'):?>
                                    <option value="<?=$designationValue?>">
                                    <?=ucfirst($designationValue)?>
                                    </option>
                                    <? endif;?>
                                    <? endforeach;?>
                                  </select>
                                </div>
                                <div class="alert alert-danger" id="alert1" style="display:none">Please select role</div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group"  id="facultyList">
                                  <label>Name<span class="symbol required"></span></label>
                                  <select name="faculty_id" id="faculty_id" class="form-control">
                                    <option value="">-- Faculty --</option>
                                  </select>
                                </div>
                                <div class="alert alert-danger" id="alert2" style="display:none">Please select faculty</div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label>Subject<span class="symbol required"></span></label>
                                  <select name="subject_id" id="subject_id" class="form-control" >
                                    <option value="">-- subject --</option>
                                    <? foreach($subjectList as $subjevtKey=>$subjevtValue):?>
                                    <option value="<?=$subjevtValue->subject_id?>">
                                    <?=$subjevtValue->subject_name?>
                                    </option>
                                    <? endforeach;?>
                                  </select>
                                </div>
                                <div class="alert alert-danger" id="alert3" style="display:none">Please select subject</div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
									 <label> Applicable Students </label> 
                                  <button href="#studentLists<?=$v->class_id?>" data-toggle="modal" class="btn btn-xs btn-teal" > Select <i class="fa fa-user fa fa-white"></i></button> 
                                  <div id="studentLists<?=$v->class_id?>" class="modal fade" tabindex="-1" data-width="760" style="display: none;">      
                                         <? include('module/administration/include/studentList.php');?>                    
                                       </div>
                                </div>
                                <div class="alert alert-danger" id="alert1" style="display:none">Please select Category</div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-light-grey"> Cancel </button>
                            <input type="button" class="btn btn-blue" value="Assign" onClick="addNewsubjectFacultyInClass(<?=$v->class_id?>)">
                          </div>
                        </form>
                      </div>
                      <!-- assign faculty end-->
                      <? if(classSubjectFacultyList($v->class_id)):?>
                      <table class="table table-striped  table-hover" >
                        <thead>
                          <tr>
                            <th class="center"></th>
                            <th>Faculty Name</th>
							<th>Category</th>
                            <th>Subject</th>
                            <th >Employee ID</th>
                            <th>Phone</th>
                            <th> Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <? foreach(classSubjectFacultyList($v->class_id) as $fk=>$fv):?>
                          <tr>
                            <td class="center"><img src="<?=($fv->faculty_image)?createImazeSize(get_small('faculty'),$fv->faculty_image,30,30):'design/images/avatar-1-small.jpg'?>" alt="image"/></td>
                            <td><?=$fv->faculty_first_name.' '.$fv->faculty_last_name?>
                            </td>
							<td><?=ucfirst($fcultyDesignationArray[$fv->faculty_designation])?></td>
                            <td>
                             <strong> <?=$fv->subject_name?></strong>
                              </td>
                            <td ><?=$fv->faculty_employee_id?></td>
                            
                            <td ><?=$fv->faculty_contact?></td>
                            <td><? if($fv->faculty_management_is_active==1):?>
                              <span class="label label-success " onClick="activeDeativeFacultyManagement(<?=$fv->faculty_management_id?>,0)">Assigned</span>
                              <? else:?>
                              <span class="label label-inverse " onClick="activeDeativeFacultyManagement(<?=$fv->faculty_management_id?>,1)">Not Assigned</span>
                              <? endif;?>
                            </td>
                            <td class="center"><div class="">
                                <? if($fv->faculty_management_is_active==1):?>
                                <a onClick="activeDeativeFacultyManagement(<?=$fv->faculty_management_id?>,0)" class="btn btn-sm btn-bricky tooltips" data-placement="top" data-original-title="Remove from Class"><i class="fa fa-ban fa fa-white"></i></a>
                                <? else:?>
                                <a onClick="activeDeativeFacultyManagement(<?=$fv->faculty_management_id?>,1)" class="btn btn-sm btn-teal tooltips" data-placement="top" data-original-title="Assign to Class"><i class="fa fa-user fa fa-white"></i></a>
                                <? endif;?>
                              </div></td>
                          </tr>
                          <? endforeach;?>
                        </tbody>
                      </table>
                      <? else:?>
                      No Faculty Assigned to this class
                      <? endif;?>
                    </div>
					
                  </div>
                  <!--faculty list end-->
                  <!--student list start-->
                  <div id="collapseStudentList<?=$v->class_id?>" class="panel-collapse collapse ">
                    <div class="panel-body">
                      
                      <? if($studentList):?>
                      <table class="table table-striped table-condensed table-hover" >
                        <thead>
                          <tr>
                            <th class="center"></th>
                            <th>Student Name</th>
                            <th >Roll Number</th>
                            
                            <th >Phone</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                          <? foreach($studentList as $sk=>$sv):?>
                          <tr>
                            <td class="center"><img src="<?=($sv->student_image)?createImazeSize(get_small('student'),$sv->student_image,30,30):'design/images/avatar-1-small.jpg'?>" alt="image"/> </td>
                            <td><?=$sv->student_first_name.' '.$sv->student_last_name?></td>
                            <td ><?=$sv->student_roll_number?></td>
                            
                            <td ><?=$sv->student_contact?></td>
                            
                          </tr>
                          <? endforeach;?>
                        </tbody>
                      </table>
                      <? else:?>
                      No Student in Class
                      <? endif;?>
                    </div>
                  </div>
                  <!--student list end-->
				 </div> 
                </div>
                <? endforeach;?>
                <? endif;?>
              </div>
            </div>
          </div>
          <!-- end: ACCORDION PANEL -->
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
