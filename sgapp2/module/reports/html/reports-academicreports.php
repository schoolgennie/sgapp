<!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>

		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" type="text/css" href="design/plugins/select2/select2.css" />
		<link rel="stylesheet" href="design/plugins/DataTables/media/css/DT_bootstrap.css" />
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="design/plugins/flot/jquery.flot.js"></script>
		<script src="design/plugins/flot/jquery.flot.resize.js"></script>
		<script src="design/plugins/flot/jquery.flot.categories.js"></script>
		<script src="design/plugins/flot/jquery.flot.pie.js"></script>
		<script src="design/js/charts.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Charts.init();
			});
			
		</script>
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script type="text/javascript" src="design/plugins/select2/select2.min.js"></script>
		<script type="text/javascript" src="design/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="design/plugins/DataTables/media/js/DT_bootstrap.js"></script>
		<script src="design/js/table-data.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				TableData.init();
			});
		</script>	
         <? $res='{';?>
         
                                      <? foreach($subjectListArray as $k=>$v):?>
                                      <? $data=schoolReportsdata($classId,$student_id,$v->subject_id,$fromDate,$reportType,$todateToTime,$fromDateToTime,$days,$months);?>
                                        <? $res.='"'.$v->subject_name.'":{label:"'.$v->subject_name.'"';?>
                                            <? $res.=',data: ['?>
                                             <? foreach($data as $kk=>$vv):?>
												
                                                 <? $res.='['.$kk.','.$vv.'],';?>
                                                 
                                                
                                            <? endforeach;?> 
                                           
                                           <? $res.=']'?>    
                                        <? $res.='},';?>    
                                      <? endforeach;?>
                                      <? $res.='}';?>
        <script>
		  var datasets =<?=$res;?>;
		var plot = $.plot(placeholder2, datasets, options);
		
<!--student drop down-->
function getStudentAndSubjectList(class_id,studendId,subjectId)
{
	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=reports-reportajax",
		data:"mode=getStudentAndSubjectList&class_id="+class_id+"&studendId="+studendId+"&subjectId="+subjectId,
		
		success: function(output)
		 {
	
		    output=output.split("~!");
			
			  $("#studentList").html('<label>Student <span class="symbol required"></span></label>'+output[1]);
			
		}   
	});
}

<!--report type-->

</script>
<? if(isset($classId) && $classId!=''):?>
<script>
			jQuery(document).ready(function() {
				getStudentAndSubjectList(<?=$classId?>,<?=$student_id?><?=($subject_id && $subject_id!='')?','.$subject_id:''?>);
			});
		</script>
<? endif;?>        
</head>

<body>

 <!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->

<!-- start: MAIN CONTAINER -->
<div class="main-container">
<!--Navigation Start -->
<? include_once(DIR_FS_SITE_INCLUDE.$login_session->get_usertype().'Nav.php'); ?>
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
								<h1>Performance Reports</h1>
							</div>
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					
					<!-- start: PAGE CONTENT -->
					
					
					<!-- start:  PANEL -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Report Card and Graphs
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="fa fa-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="fa fa-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="panel-body">
								
									<!-- start: Selection -->
                                          <? if($login_session->get_usertype()==$userTypeArray[0] || $login_session->get_usertype()==$userTypeArray[1]):# school or faculty?>
                                            <form name="frmReport" id="frmReport" action="<?=make_url('reports-academicreports')?>" method="post">
											<div class="alert alert-block alert-info fade in">
												<div class="row">
													<div class="col-md-2">
														<div class="form-group">
															<label>Class <span class="symbol required"></span></label>                                                     
															<select id="class_id" name="class_id" class="form-control" onChange="getStudentAndSubjectList(this.value)" required>
																<option value="" >--Class--</option>
																<? foreach($classList as $k=>$v):?>
                                                                <option value="<?=$v->class_id?>" <?=(isset($classId) && $v->class_id==$classId)?'selected':''?> >
                                                                <?=$v->class_name?>
                                                                </option>
                                                                <? endforeach;?>
															</select>	
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group" id="studentList">
															<label>Student <span class="symbol required"></span></label>
															<select id="student_id" name="student_id" class="form-control" required>
																<option value="">-- Student --</option>
															</select>	
														</div>
													</div>
													
													
													<div class="col-md-2">
														<div class="form-group">
															<input class="btn btn-primary" type="submit" value="Generate" name="submit">
														</div>
													</div>
												</div>		
											</div>
                                            </form>
                                          <? elseif($login_session->get_usertype()==$userTypeArray[2]):# student?>
                                            
                                          <? endif;?>
									<!-- start: Selection -->
									
									<!-- start: Report -->	
							          <? if($academicTestArray):?>
      		                          <div class="row">
										<div class="col-md-11">
                                        <table class="table table-striped table-bordered table-hover " id="">
                                            <thead>
                                                <tr>
                                                    <th>Subject</th>
                                                    <? foreach($academicTestArray as $k=>$v):?>
                                                    <th ><?=$k;?></th>
                                                   <? endforeach;?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? foreach($subjectListArray as $k=>$v):?>
                                                <tr>
                                                    <td> <?=$v->subject_name?></td>
                                                    <? foreach($academicTestArray as $kk=>$vv):?>
                                                    <td>
                                                    <?=number_format(getAcademicTestMarks($school_id,$student_id,$classId,$v->subject_id,$vv,$fromDate),1).','?>
                                                    <?=convertMarksToGrade(getAcademicTestMarks($school_id,$student_id,$classId,$v->subject_id,$vv,$fromDate),0);?>
                                                    </td>
                                                    <? endforeach;?>
                                                </tr>
                                                <? endforeach;?>
                                            </tbody>
                                        </table>
										</div>
									</div>
									<!-- end: Report -->
							
							        <? if($scholasticDetail):?>
									<h1>Co-Scholastic Area</h1>
									<label>Life Skills</label>							
							
									<div class="row">
										<div class="col-md-11">
                                        <table class="table table-striped table-bordered table-hover " id="">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th> Description</th>
                                                    <th > Grade</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> Thinking Skills</td>
                                                    <td> <?=(isset($scholasticDetail->thinking_skills))?html_entity_decode($scholasticDetail->thinking_skills):''?></td>
													<td><?=(isset($scholasticDetail->thinking_skills_grade))?$scholasticDetail->thinking_skills_grade:''?> </td>
                                                </tr>
												<tr>
                                                    <td> Social Skills</td>
                                                    <td><?=(isset($scholasticDetail->social_skills))?html_entity_decode($scholasticDetail->social_skills):''?></td>
													<td> <?=(isset($scholasticDetail->social_skills_grade))?$scholasticDetail->social_skills_grade:''?></td>
                                                </tr>
                                                <tr>
                                                    <td> Emotional Skills</td>
                                                    <td><?=(isset($scholasticDetail->emotional_skills))?html_entity_decode($scholasticDetail->emotional_skills):''?></td>
													<td> <?=(isset($scholasticDetail->emotional_skills_grade))?$scholasticDetail->emotional_skills_grade:''?> </td>
                                                </tr>
                                            </tbody>
                                            
                                        </table>
										</div>
									</div>
                                    <label>Work Education </label>							
							
									<div class="row">
										<div class="col-md-11">
                                        <table class="table table-striped table-bordered table-hover " id="">
                                            <thead>
                                                <tr>
                                                  
                                                    <th> Description</th>
                                                    <th > Grade</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <tr>
                                                     <td><?=(isset($scholasticDetail->work_education))?html_entity_decode($scholasticDetail->work_education):''?></td>
													<td> <?=(isset($scholasticDetail->work_education_grade))?$scholasticDetail->work_education_grade:''?> </td>
                                                </tr>
                                            </tbody>
                                            
                                        </table>
										</div>
									</div>
                                    <label>Visual and Performing Arts </label>							
							
									<div class="row">
										<div class="col-md-11">
                                        <table class="table table-striped table-bordered table-hover " id="">
                                            <thead>
                                                <tr>
                                                    
                                                    <th> Description</th>
                                                    <th > Grade</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                 
                                                     <td><?=(isset($scholasticDetail->visual_and_performing_arts))?html_entity_decode($scholasticDetail->visual_and_performing_arts):''?></td>
													<td> <?=(isset($scholasticDetail->visual_and_performing_arts_grade))?$scholasticDetail->visual_and_performing_arts_grade:''?> </td>
                                                </tr>
												
                                            </tbody>
                                            
                                        </table>
										</div>
									</div>
                                    <label>Attitudes & Values</label>							
							
									<div class="row">
										<div class="col-md-11">
                                        <table class="table table-striped table-bordered table-hover " id="">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th> Description</th>
                                                    <th > Grade</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> Attitude towards Teachers</td>
                                                     <td><?=(isset($scholasticDetail->attitude_towards_teachers))?html_entity_decode($scholasticDetail->attitude_towards_teachers):''?></td>
													<td> <?=(isset($scholasticDetail->attitude_towards_teachers_grade))?$scholasticDetail->attitude_towards_teachers_grade:''?> </td>
                                                </tr>
												<tr>
                                                    <td> Attitude towards School-Mates</td>
                                                     <td><?=(isset($scholasticDetail->attitude_towards_schoolmates))?html_entity_decode($scholasticDetail->attitude_towards_schoolmates):''?></td>
													<td> <?=(isset($scholasticDetail->attitude_towards_schoolmates_grade))?$scholasticDetail->attitude_towards_schoolmates_grade:''?> </td>
                                                </tr>
                                                <tr>
                                                    <td> Attitude towards School Programming & Environment</td>
                                                     <td><?=(isset($scholasticDetail->attitude_towards_school_programming_environment))?html_entity_decode($scholasticDetail->attitude_towards_school_programming_environment):''?></td>
													<td> <?=(isset($scholasticDetail->attitude_towards_school_programming_environment_grade))?$scholasticDetail->attitude_towards_school_programming_environment_grade:''?> </td>
                                                </tr>
                                                 <tr>
                                                    <td> Value Systems</td>
                                                    <td><?=(isset($scholasticDetail->value_systems))?html_entity_decode($scholasticDetail->value_systems):''?></td>
													<td> <?=(isset($scholasticDetail->value_systems_grade))?$scholasticDetail->value_systems_grade:''?> </td>
                                                </tr>
                                            </tbody>
                                            
                                        </table>
										</div>
									</div>
                                    <label>Life Skills</label>							
							
									<div class="row">
										<div class="col-md-11">
                                        <table class="table table-striped table-bordered table-hover " id="">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th> Description</th>
                                                    <th > Grade</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> Literary & Creative Skills</td>
                                                    <td> <?=(isset($scholasticDetail->literary_creative_skills))?html_entity_decode($scholasticDetail->literary_creative_skills):''?></td>
													<td><?=(isset($scholasticDetail->literary_creative_skills_grade))?$scholasticDetail->literary_creative_skills_grade:''?> </td>
                                                </tr>
												<tr>
                                                    <td> Organizational & Leadership Skills</td>
                                                    <td><?=(isset($scholasticDetail->organizational_leadership_skills))?html_entity_decode($scholasticDetail->organizational_leadership_skills):''?></td>
													<td> <?=(isset($scholasticDetail->organizational_leadership_skills_grade))?$scholasticDetail->organizational_leadership_skills_grade:''?></td>
                                                </tr>
                                               
                                            </tbody>
                                            
                                        </table>
										</div>
									</div>
                                    <label>Health and Physical Activities</label>							
							
									<div class="row">
										<div class="col-md-11">
                                        <table class="table table-striped table-bordered table-hover " id="">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th> Description</th>
                                                    <th > Grade</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Sports/Indigenous Sports</td>
                                                    <td> <?=(isset($scholasticDetail->sports_indigenous_sports))?html_entity_decode($scholasticDetail->sports_indigenous_sports):''?></td>
													<td><?=(isset($scholasticDetail->sports_indigenous_sports_grade))?$scholasticDetail->sports_indigenous_sports_grade:''?> </td>
                                                </tr>
												<tr>
                                                    <td> Yoga</td>
                                                    <td><?=(isset($scholasticDetail->yoga))?html_entity_decode($scholasticDetail->yoga):''?></td>
													<td> <?=(isset($scholasticDetail->yoga_grade))?$scholasticDetail->yoga_grade:''?></td>
                                                </tr>
                                               
                                            </tbody>
                                            
                                        </table>
										</div>
									</div>
                                    <label>Health Status</label>							
							
									<div class="row">
										<div class="col-md-11">
                                        <table class="table table-striped table-bordered table-hover " id="">
                                           
                                            <tbody>
                                                <tr>
                                                    <td>Height</td>
                                                    <td> <?=(isset($scholasticDetail->height))?html_entity_decode($scholasticDetail->height):''?></td>
													
                                                </tr>
												<tr>
                                                    <td> Weight</td>
                                                    <td><?=(isset($scholasticDetail->weight))?html_entity_decode($scholasticDetail->weight):''?></td>
													
                                                </tr>
                                               <tr>
                                                    <td> Blood Group</td>
                                                    <td><?=(isset($scholasticDetail->blood_group))?html_entity_decode($scholasticDetail->blood_group):''?></td>
													
                                                </tr>
                                                <tr>
                                                    <td> Vision(L)</td>
                                                    <td><?=(isset($scholasticDetail->vision_l))?html_entity_decode($scholasticDetail->vision_l):''?></td>
													
                                                </tr>
                                                <tr>
                                                    <td> Vision(R)</td>
                                                    <td><?=(isset($scholasticDetail->vision_r))?html_entity_decode($scholasticDetail->vision_r):''?></td>
													
                                                </tr>
                                                <tr>
                                                    <td> Dental Hygiene</td>
                                                    <td><?=(isset($scholasticDetail->dental_hygiene))?html_entity_decode($scholasticDetail->dental_hygiene):''?></td>
													
                                                </tr>
                                            </tbody>
                                            
                                        </table>
										</div>
									</div>
                                     <label>Self Awareness</label>							
							
									<div class="row">
										<div class="col-md-11">
                                        <table class="table table-striped table-bordered table-hover " id="">
                                           
                                            <tbody>
                                                <tr>
                                                    <td>My Goals</td>
                                                    <td> <?=(isset($scholasticDetail->my_goals))?html_entity_decode($scholasticDetail->my_goals):''?></td>
													
                                                </tr>
												<tr>
                                                   <td>My Strengths</td>
                                                    <td><?=(isset($scholasticDetail->my_strengths))?html_entity_decode($scholasticDetail->my_strengths):''?></td>
													
                                                </tr>
                                               <tr>
                                                    <td>My Interests and Hobbies</td>
                                                    <td><?=(isset($scholasticDetail->my_interests_hobbies))?html_entity_decode($scholasticDetail->my_interests_hobbies):''?></td>
													
                                                </tr>
                                                <tr>
                                                    <td>Resposibilities Discharged / Exceptional Achievements</td>
                                                    <td><?=(isset($scholasticDetail->resposibilities_discharged_exceptional_achievements))?html_entity_decode($scholasticDetail->resposibilities_discharged_exceptional_achievements):''?></td>
													
                                                </tr>
                                               
                                            </tbody>
                                            
                                        </table>
										</div>
									</div>
							        <? endif;?>
							        <? endif;?>
									<!-- start: Graphs -->
									<!--<div class="row">
										<div class="col-md-1">
										</div>
										<div class="col-md-10">
											<div class="flot-container">
                                              
                                               <div id="placeholder2" class="flot-placeholder"></div>
												<p id="choices"></p>
											</div>
										</div>
									</div>-->
									<!-- end: Graphs -->
                             
								</div>
								<!-- end: Panel Body -->
							</div>		
						</div>
					</div>
					<!-- end:  PANEL -->
					<!-- end: PAGE CONTENT-->
					
				</div>	
	

			</div>
			

  
  			
 <!-- Footer Start-->
 <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
 <!-- Footer End-->

</div>
  <!-- Main End -->

 
</body>

</html>