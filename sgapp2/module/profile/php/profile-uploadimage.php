<?
#user type
$userType=($login_session->get_usertype())?$login_session->get_usertype():'';
check_logged_in_for_myaccount($userType);
$code=generateCode(6);
if(isset($_FILES) && $_FILES['image']['name']!=''):
    #check uploded file type is image
	$imageType=explode('/',$_FILES['image']['type']);
	if($imageType[0]!='image'):
		$login_session->pass_msg[]='please upload image type file';
		$login_session->set_pass_msg();
		$login_session->set_success();
		Redirect(make_url($_GET['redirectTo']));
	    exit;
	endif;
   #upload image
	 if(upload_photo($_GET['type'], $_FILES['image'],$code.'_')):
	    $data[$_GET['type'].'_image']=$code.'_'.$_FILES['image']['name'];
		$where=$_GET['type']."_id='".$_GET['id']."'";																																																																																			
		update_record_in_table($_GET['type'],$where,$data);
	    Redirect(make_url($_GET['redirectTo']));
	   exit;
	 endif;	
endif;
?>
