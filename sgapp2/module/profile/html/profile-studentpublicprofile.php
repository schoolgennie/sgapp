<!DOCTYPE html >
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'cssJavascript.php'); ?>
</head>
<body>

<div class="row">
				<div class="12u">
					<div class="box-container">
						<div class="box-header"> 
						Student Information
						</div>
							<div class="row">
								<div class="3u profile-box-content">
									<ul>
									<li>
									<div class="image img"> 
									<img src="<?=($studentDetails->student_image)?createImazeSize(get_small('student'),$studentDetails->student_image,178,178):'images/noimage.png'?>" /> 
									</div>
									</li>
									<span><?=ucfirst($studentDetails->student_first_name.' '.$studentDetails->student_last_name)?></span>
									<li>
									</li>
									</ul>
								</div>
								<div class="9u profile-box-content">
											<ul>
											   <li> <span>Class </span>
													<?=get_object_by_query('class','class_id='.$studentDetails->class_id)->class_name;?>
												</li>
                                              
												<li> <span>Country </span>
													 <?=$studentDetails->student_country?>
												</li>
                                                 <li> <span>State </span>
													 <?=$studentDetails->student_state?>
												</li>
                                                <li> <span>City </span>
													 <?=$studentDetails->student_city?>
												</li>
                                                  <li> <span>Gender </span>
													 <?=$studentDetails->student_gender?>
												</li>
                                                
                                                <li> <span>With School Since </span>
													<?=$studentDetails->student_with_school_since?>
												</li>
                                              
                                              
											</ul>
										</div>
							</div>
						
					</div>
				</div>
</div>

</body>
</html>
