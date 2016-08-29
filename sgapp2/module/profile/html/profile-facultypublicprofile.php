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
						Faculty Information
						</div>
							<div class="row">
								<div class="3u profile-box-content">
									<ul>
									<li>
									<div class="image img"> 
									<img src="<?=($facultyDetails->faculty_image)?createImazeSize(get_small('faculty'),$facultyDetails->faculty_image,178,178):'images/noimage.png'?>" /> 
									</div>
									</li>
									<span><?=ucfirst($facultyDetails->faculty_first_name.' '.$facultyDetails->faculty_last_name)?></span>
									<li>
									</li>
									</ul>
								</div>
								<div class="9u profile-box-content">
											<ul>
											   <li> <span>Designation </span>
													<?=$fcultyDesignationArray[$facultyDetails->faculty_designation]?>
												</li>
                                                <? if($inchargeClass->class_name):?>
												<li> <span>Class In-Charge </span>
													<?=$inchargeClass->class_name?>
												</li>
                                                <? endif;?>
                                                <li> <span>With School Since </span>
													<?=$facultyDetails->faculty_with_school_since?>
												</li>
                                                <li> <span> Total Experience </span>
													<?=$facultyDetails->faculty_years_of_experience?>Yrs
												</li>
                                                <li> <span>Email Official </span>
													<?=$facultyDetails->faculty_email_official?>
												</li>
                                               
											</ul>
										</div>
							</div>
						
					</div>
				</div>
</div>

</body>
</html>
