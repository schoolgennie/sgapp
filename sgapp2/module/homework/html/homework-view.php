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
 
 		
  



</head>
<body>

 <!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->

<!-- start: MAIN CONTAINER -->
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
								<h1>Homework</h1>
							</div>
						</div>
					</div>
					<!-- end: PAGE HEADER -->
                    
				<div class="row">
						<div class="col-md-12">
							<!-- start: TABLE WITH IMAGES PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Homework
									
									
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="fa fa-resize-full"></i>
										</a>
									</div>
								</div>					
								<div class="panel-body">
                                 <div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								
									<ul class="pagination" style="margin:0">
										<li>
											<a href="<?=make_url('homework-view','ondate='.$previous)?>">
												Prev
											</a>
										</li>
										<li>
											<a style="padding:0">
                                            <form name="homeworkFrm" action="<?=make_url('homework-view');?>" method="post" id="homeworkFrm">
											<input name="ondate" onChange="this.form.submit()" class="form-control date-picker input-sm" style="border:0;height: 29px;text-align:center;"  type="text" data-date-viewmode="years" data-date-format="dd-mm-yyyy" value="<?=date('d-m-Y',strtotime($ondate))?>">
                                            </form> 
											
											</a>
										</li>
										<li>
											<a href="<?=make_url('homework-view','ondate='.$next)?>">
												Next
											</a>
										</li>
									</ul>
								
							</div>	
							<div class="col-md-4">
									
							</div>
							
						</div>
									<? if($studentSubjectList):?>
									
									<table class="table table-hover">
										<thead>
											<tr>
                                                <th class="center"></th>
												<th>Faculty</th>
												<th>Subject</th>
												<th class="col-md-8">Homework</th>
												<th> Attachments</th>
											</tr>
										</thead>
										
           
										<tbody>
											
           										<? foreach($studentSubjectList as $k=>$v):?>
												<tr >
												<td class="center"><a data-toggle="modal"  href="<?='#ddd'.$v->faculty_id?>"> <img src="<?=($v->faculty_image)?createImazeSize(get_small('faculty'),$v->faculty_image,30,30):'design/images/avatar-1-small.jpg';?>" alt="image" /> </a></td>
												<td><?=html_entity_decode($v->faculty_first_name.' '.$v->faculty_last_name);?></td>
												<td><?=html_entity_decode($v->subject_name);?>
												</td>
												<td class="hidden-xs">
												 <? $homeWork=get_object_by_query('home_work','faculty_management_id="'.$v->faculty_management_id.'" and ondate="'.$ondate.'"');?>
												<? if($homeWork):?>
                                                    <?=$homeWork->home_work?>
                                                <? else:?>
                                                    No Home Work
                                                <? endif;?>
												</td>
												
												
												<td >
                                                <? if($homeWork->home_work_attachment):?>
												<a class="btn btn-download btn-sm btn-squared tooltips" data-placement="top" data-original-title="File Name 1" onClick="window.location.href='<?=make_url('homework-view','download='.$homeWork->home_work_attachment)?>'"  >
														<i class="clip-attachment"></i>
												</a>
                                                <? endif;?>
												</td>
											</tr>
                                              <div class="modal fade" id="<?='ddd'.$v->faculty_id?>" tabindex="-1" role="dialog" aria-hidden="true">
		                                        <div class="modal-content">
                                                <? include 'http://test.schoolgennie.com/?page=profile-facultypublicprofile&id=1';?>
                                                </div>
                                              </div>  
												<? endforeach;?>
										</tbody>
									</table>
									
									<? endif;?>
								
								</div>
							</div>
							<!-- end: TABLE WITH IMAGES PANEL -->
						</div>
					</div>					
              
				</div>
		</div>	
 <!-- Footer Start-->
 <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
 <!-- Footer End-->

</div>
  <!-- Main End -->

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

</body>
</html>


