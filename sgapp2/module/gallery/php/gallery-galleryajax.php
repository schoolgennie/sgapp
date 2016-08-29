<?
check_logged_in_for_myaccount('school');
$school_id=$login_session->get_user_id();
$code=generateCode(6);
if($login_session->get_usertype()==$userTypeArray[0]):
if(isset($_GET['mode'])):
	switch($_GET['mode']) 
	{
	  case 'uploadNewImage':
	     if(isset($_GET['album_id']) && $_GET['album_id']!='' && isset($_FILES) && $_FILES['album_image']['name']!=''):
			  if(upload_photo('school_album', $_FILES['album_image'],$code.'_')):
				$not=array('page','mode');
				$data=$_GET;
				$data['school_id']=$school_id;
				$data['album_image']=$code.'_'.$_FILES['album_image']['name'];
				$data['album_image_date']=date('Y-m-d');
				insert_record_in_table('album_images',$data,$not);
				exit;
			  endif;
        endif;
	  break; 
	  case 'editCaptionValue':
			 if(isset($_GET['album_image_caption']) && $_GET['album_image_caption']!=''):
					$not=array('page','album_image_id','mode');
					$data=$_GET;
					$where="album_image_id='".$_GET['album_image_id']."' and school_id='".$school_id."'";																																																																																			
					update_record_in_table('album_images',$where,$data,$not);
					echo $_GET['album_image_caption'];
			 endif;
			 exit;
      break;
	  case 'deleteImage':
           if(delete_record_from_table('album_images',"album_image_id='".$_GET['album_image_id']."' and school_id='".$school_id."'")):
		    echo '1';
		  endif;
		    exit;
      break;	  
	}			
endif;		
endif;
?>
