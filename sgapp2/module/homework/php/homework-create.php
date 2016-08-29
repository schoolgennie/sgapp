<?
check_logged_in_for_myaccount('faculty');
$ondate=isset($_REQUEST['ondate'])?date('Y-m-d',strtotime(str_replace('_','-',$_REQUEST['ondate']))):date('Y-m-d');

$previous=date('Y_m_d',strtotime('-1 day',strtotime($ondate)));
$next=date('Y_m_d',strtotime('+1 day',strtotime($ondate)));
#faculty unique id
$faculty_id=$login_session->get_user_id();
#fetch school details
$facultyDetail=get_object_by_query('faculty','faculty_id='.$faculty_id);
#school id
$school_id=$facultyDetail->school_id;

#fetch assigned classes list
$assignedClassList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$faculty_id.'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1 order by c.class_position');

# add home work
if(isset($_POST['submit']) && $_POST['submit']=='Submit'):
	foreach($_POST['home_work'] as $k=>$v):
	   #check value already exist or not
	   $checkValue=get_object_by_query('home_work','faculty_management_id="'.$k.'" and ondate=CURDATE()');
		if($checkValue):
			$dataUpdate=array();
			$dataUpdate['home_work']=$v;
			$code=generateCode(6);
			if(upload_photo_in_folder('home_work', $_FILES['home_work_attachment'.$k],$code.'_')):
			  delete_if_file_exists('home_work', $checkValue->home_work_attachment);
			  $dataUpdate['home_work_attachment']=$code.'_'.$_FILES['home_work_attachment'.$k]['name'];
			endif;
			$where="faculty_management_id='".$k."' and ondate=CURDATE()";																																																																																			
			update_record_in_table('home_work',$where,$dataUpdate);
		else:
			$data=array();
			$data['faculty_management_id']=$k;
			$data['home_work']=$v;
			$code=generateCode(6);
			if(upload_photo_in_folder('home_work', $_FILES['home_work_attachment'.$k],$code.'_')):
			  $data['home_work_attachment']=$code.'_'.$_FILES['home_work_attachment'.$k]['name'];
			endif;
			$data['ondate']=date('Y-m-d');
			insert_record_in_table('home_work',$data);
		endif;		
	endforeach;	
			Redirect(make_url('homework-create'));
endif;	
# download file
if(isset($_GET['download']) && $_GET['download']!=''):
       download_file('upload/photo/home_work/'.$_GET['download']);
endif;

?>
