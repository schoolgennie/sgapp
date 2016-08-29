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
                                     <?  $dataValues=array_filter(array_values($data));?>
                                        <? $res.='"'.$v->subject_name.'":{label:"'.$v->subject_name.'"';?>
                                            <? $res.=',data: ['?>
                                             <? foreach($data as $kk=>$vv):?>
                                                <? if($kk==1 && !$vv):?>
                                                <? $res.='['.$kk.','.$$dataValues[0].'],';?>
                                                <? endif;?>
												<? if($vv):?>
                                                 <? $res.='['.$kk.','.$vv.'],';?>
                                                <? endif;?>
                                                <? if($kk==count($data) && !$vv):?>
                                                <? $res.='['.$kk.','.end($dataValues).' ],';?>
                                                <? endif;?>
                                            <? endforeach;?> 
                                           <? $res=substr($res, 0, -1);?>
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
			 //$("#subjectList").html('<label>Subject </label>'+output[0]);
			  $("#studentList").html('<label>Student <span class="symbol required"></span></label>'+output[1]);
			
		}   
	});
}
function getSubjectList(class_id,studendId,subjectId)
{
	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=reports-reportajax",
		data:"mode=getSubjectList&class_id="+class_id+"&studendId="+studendId+"&subjectId="+subjectId,
		
		success: function(output)
		 {
	
			 $("#subjectList").html('<label>Subject </label>'+output);
			
		}   
	});
}
<!--report type-->

</script>
<? if(isset($classId) && $classId!=''):?>
<script>
			jQuery(document).ready(function() {
				getStudentAndSubjectList(<?=$classId?>,<?=$student_id?><?=($subject_id && $subject_id!='')?','.$subject_id:''?>);
				getSubjectList(<?=$classId?>,<?=$student_id?><?=($subject_id && $subject_id!='')?','.$subject_id:''?>);
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
										
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="panel-body">
								
									<!-- start: Selection -->
                                          <? if($login_session->get_usertype()==$userTypeArray[0] || $login_session->get_usertype()==$userTypeArray[1]):# school or faculty?>
                                            <form name="frmReport" id="frmReport" action="<?=make_url('reports-reports')?>" method="post">
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
														<div class="form-group" id="subjectList">
															<label>Subject </label>
															<select id="subject_id" name="subject_id" class="form-control" >
																<option value="">--Subject--</option>
															</select>	
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="radio-inline">
																<input type="radio" class="purple" value="month" checked="checked" name="reportType" > Monthly
															</label>
															<?php /*?><label class="radio-inline">
																<input type="radio" class="purple" value="year"  name="reportType" <?=(isset($reportType) && $reportType=='year')?'checked':''?> > Yearly
															</label><?php */?>	
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
                                            <form name="frmReport" id="frmReport" action="<?=make_url('reports-reports')?>" method="post">
											<div class="alert alert-block alert-info fade in">
												<div class="row">
													
													
													<div class="col-md-2">
														<div class="form-group">
															<label>Subject </label>
															<select id="subject_id" name="subject_id" class="form-control">
																<option value="">--Subject--</option>
                                                                 <? foreach($studentSubjectList as $k=>$v):?>
                                                                <option value="<?=$v->subject_id?>" <?=(isset($subject_id) && $v->subject_id==$subject_id)?'selected':''?> >
																<?=$v->subject_name?>
                                                                </option>
                                                                <? endforeach;?>
															</select>	
														</div>
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label class="radio-inline">
																<input type="radio" class="purple" value="month" checked="checked" name="reportType"> Monthly
															</label>
															<?php /*?><label class="radio-inline">
																<input type="radio" class="purple" value="year"  name="reportType" <?=(isset($reportType) && $reportType=='year')?'checked':''?>> Yearly
															</label><?php */?>	
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
                                          <? endif;?>
									
							     <? #handle sections here.
                                 switch ($section):
		                            case 'month':
									 #html code here.
									 ?>
                                     
                                      <? //print_r($res);?>
									  <!-- start: Selection -->
									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-6">
											
												<ul class="pagination" style="margin:0">
													<li>
														<a href="<?=make_url('reports-reports',$next);?>">
															Prev Month
														</a>
													</li>
													<li>
														<a href="<?=make_url('reports-reports',$current);?>">
															Current Month
														</a>
													</li>
                                                    <? if(date('m',strtotime($todate))!=date('m') && strtotime($todate)<=time()):?>
													<li>
														<a href="<?=make_url('reports-reports',$previous);?>">
															Next Month
														</a>
													</li>
                                                    <? endif;?>
												</ul>
											
										</div>	
										<div class="col-md-3">
												
										</div>
										
									</div>
									<!-- start: Report -->	
									
									<div class="row">
										<div class="col-md-6">
											<h2>Student Report Card</h2>
											<p>Name:<?=$studentDetail->student_first_name.' '.$studentDetail->student_last_name?></p>
											
										</div>
										<div class="col-md-6">
											<h2>Month:<?=date('M',strtotime($todate));?></h2>
											<p>Class:<?=get_object_by_query('class','class_id='.$classId)->class_name;?></p>
										</div>
									</div>
									
      		                          <div class="row">
										<div class="col-md-11">
                                        <table class="table table-striped table-bordered table-hover " id="">
                                            <thead>
                                                <tr>
                                                    <th>Subject</th>
                                                    <? for($i=0;$i<=$days;$i++):?>
                                                    <th ><?=date('d',strtotime('+'.$i.' days',strtotime($fromDate)));?></th>
                                                    <? endfor;?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? foreach($subjectListArray as $k=>$v):?>
                                                <tr>
                                                    <td> <?=$v->subject_name?></td>
                                                    <? for($i=0;$i<=$days;$i++):?>
                                                    <td><?=getStudentMarks($classId,$student_id,$v->subject_id,date('d-m-Y',strtotime('+'.$i.' days',strtotime($fromDate))));?></td>
                                                    <? endfor;?>
                                                </tr>
                                                <? endforeach;?>
                                            </tbody>
                                        </table>
										</div>
									</div>
									<!-- end: Report -->
							
									<!-- start: Graphs -->
									<div class="row">
										<div class="col-md-1">
										</div>
										<div class="col-md-10">
											<div class="flot-container">
                                              
                                               <div id="placeholder2" class="flot-placeholder"></div>
												<p id="choices"></p>
											</div>
										</div>
									</div>
									<!-- end: Graphs -->
                                    <? 
								    break;
								    case 'year':
								    #html code here.
							        ?>
                                    
                                    <? 
									break;
									default:break;
							    endswitch;
							    ?>
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