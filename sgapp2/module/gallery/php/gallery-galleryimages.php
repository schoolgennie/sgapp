<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');

#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

#album id
$album_id=(isset($_REQUEST['id']) && $_REQUEST['id']!='')?$_REQUEST['id']:'';

# if album id exist
if($album_id):
	#fetch album details
	$albumDetails=get_object_by_query('album','album_id='.$album_id);
	#fetch album images
	$albumImages=get_all_record_by_query('album_images','album_id="'.$album_id.'" and school_id="'.$school_id.'" and album_image!=""');
endif;

$code=generateCode(6);
# if logged in user type is school
if($login_session->get_usertype()==$userTypeArray[0]):
# add album
if(isset($_POST['submit']) && $_POST['submit']=='Submit'):
	# add validations
	$validation=new user_validation();
	$validation->add('album_name', 'req','album name');					
	# check validations.
	$valid= new valid();
	if($valid->validate($_POST, $validation->get())):
			#check entered class aleady exist or not
			$checkClass=get_object_by_query('album','album_name="'.$_POST['album_name'].'" and school_id="'.$school_id.'"');
			#if exist
			if($checkClass):
				$login_session->pass_msg[]='Album name already exists !! ';
				$login_session->set_pass_msg();
				$login_session->set_success();
				Redirect(make_url('gallery-gallery'));
			else:
				$not=array('submit');
				$data=$_POST;
				$data['school_id']=$school_id;
				$data['album_date']=date('Y-m-d');
				insert_record_in_table('album',$data,$not);
				$maxid=get_object_by_query('album','school_id="'.$school_id.'"','Max(album_id) as id')->id;
				  if(upload_photo('school_album', $_FILES['album_image'],$code.'_')):
					$data1['school_id']=$school_id;
					$data1['album_id']=$maxid;
					$data1['album_image']=$code.'_'.$_FILES['album_image']['name'];
					$data1['album_image_date']=date('Y-m-d');
					insert_record_in_table('album_images',$data1);
				  endif;	
				Redirect(make_url('gallery-galleryimages','id='.$maxid));
			endif;	
	 else:
				$login_session->pass_msg=$valid->error;
				$login_session->set_pass_msg();
				Redirect(make_url('gallery-gallery')); 
	 endif;			
	
endif;	

# update album
if(isset($_POST['submit']) && $_POST['submit']=='Update'):
	# add validations
	$validation=new user_validation();
	$validation->add('album_name', 'req','album name');				
	# check validations.
	$valid= new valid();
	if($valid->validate($_POST, $validation->get())):
			#check entered class aleady exist or not
			$checkClass=get_object_by_query('album','album_name="'.$_POST['album_name'].'" and school_id="'.$school_id.'" and album_id!="'.$album_id.'"');
			#if exist
			if($checkClass):
				$login_session->pass_msg[]='Album name already exists !! ';
				$login_session->set_pass_msg();
				$login_session->set_success();
				Redirect(make_url('gallery-galleryimages','id='.$album_id));
			else:
				$not=array('submit');
				$data=$_POST;
				$where="album_id='".$album_id."' and school_id='".$school_id."'";																																																																																			
				update_record_in_table('album',$where,$data,$not);
				Redirect(make_url('gallery-galleryimages','id='.$album_id));
			endif;	
	 else:
				$login_session->pass_msg=$valid->error;
				$login_session->set_pass_msg();
				Redirect(make_url('gallery-galleryimages','id='.$album_id)); 
	 endif;			
endif;	
#delete album
if(isset($_GET['status']) && $_GET['status']=='delete'):
	delete_record_from_table('album',"album_id='".$album_id."' and school_id='".$school_id."'");
	Redirect(make_url('gallery-gallery'));
endif;
endif; 
?>
