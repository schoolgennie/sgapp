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
						School Information
						</div>
							<div class="row">
								<div class="3u profile-box-content">
									<ul>
									<li>
									<div class="image img"> 
										<img src="<?=($schoolDetail->school_image)?createImazeSize(get_small('school'),$schoolDetail->school_image,178,178):'images/noimage.png'?>" /> 
									</div>
									</li>
									<span><?=$schoolDetail->school_name?></span>
									<li>
									</li>
									</ul>
								</div>
								<div class="9u profile-box-content">
											<ul>
											   <li> <span>Address </span>
													<?=$schoolDetail->school_address?>
												</li>
												<li> <span>Country </span>
													<?=$schoolDetail->school_country?>
												</li>
                                                <li> <span>State </span>
													<?=$schoolDetail->school_state?>
												</li>
                                                <li> <span> City </span>
													<?=$schoolDetail->school_city?>
												</li>
                                                <li> <span>Contact No. Primary </span>
													<?=$schoolDetail->school_phone1?>
												</li>
                                                <li> <span>Contact No. Secondary </span>
													<?=$schoolDetail->school_phone2?>
												</li>
                                                <li> <span>Fax </span>
													<?=$schoolDetail->school_fax?>
												</li>
                                                <li> <span>Email id </span>
													<?=$schoolDetail->school_email_official?>
												</li>
											</ul>
										</div>
							</div>
						
					</div>
				</div>
</div>

</body>
</html>
