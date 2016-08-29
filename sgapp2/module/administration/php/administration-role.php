<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');

isset($_REQUEST['faculty_designation_id'])?$faculty_designation_id=$_REQUEST['faculty_designation_id']:$faculty_designation_id='0';


#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

if($faculty_designation_id):
  # get designation details
  $designationDetails =get_object_by_query('faculty_designation','faculty_designation_id="'.$faculty_designation_id.'" and school_id="'.$school_id.'"');
  #authenticate user
  if(!$designationDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('administration-role'));
  endif;
endif;

#fetch designation list
$designationList=get_all_record_by_query('faculty_designation as a left join faculty_designation_access_rights as b on a.faculty_designation_id=b.faculty_designation_id',' a.school_id="'.$school_id.'"','a.*,b.faculty_designation_access_rights_id,b.faculty_designation_access_module');


# add designation
if(isset($_POST['submit']) && $_POST['submit']=='Create'):
   # add validations
	$validation=new user_validation();
	$validation->add('faculty_designation', 'req','designation name');	
	# check validations.
	$valid= new valid();
	if($valid->validate($_POST, $validation->get())):
			#check entered designation aleady exist or not
			$checkDesignation=get_object_by_query('faculty_designation','faculty_designation="'.$_POST['faculty_designation'].'" and school_id="'.$school_id.'"');
			#if exist
			if($checkDesignation):
				$login_session->pass_msg[]='Entered designation already exist';
				$login_session->set_pass_msg();
				$login_session->set_success();
				Redirect(make_url('administration-role'));
			else:
				#create faculty designation
				$data['school_id']=$school_id;
				$data['faculty_designation']=$_POST['faculty_designation'];
				$data['faculty_designation_ondate']=date_format_inserted(date('d-m-Y'));
				insert_record_in_table('faculty_designation',$data);
				#create faculty designation access rights
				  $maxid=get_object_by_query('faculty_designation','school_id="'.$school_id.'"','Max(faculty_designation_id) as id')->id;
				  $data1['school_id']=$school_id;
				  $data1['faculty_designation_id']=$maxid;
				  $data1['faculty_designation_access_module']=implode(',',$facultyDefaultAccessRightArray).','.implode(',',$_POST['faculty_designation_access_module']);
				  insert_record_in_table('faculty_designation_access_rights',$data1);
				  Redirect(make_url('administration-role'));
			endif;	
	else:
				$login_session->pass_msg=$valid->error;
				$login_session->set_pass_msg();
				Redirect(make_url('administration-role')); 
	 endif;			
endif;	
# update designation
if(isset($_POST['submit']) && $_POST['submit']=='Apply'):
   # add validations
	$validation=new user_validation();
	$validation->add('faculty_designation', 'req','designation name');	
	# check validations.
	$valid= new valid();
	if($valid->validate($_POST, $validation->get())):
			#check entered designation aleady exist or not
			$checkDesignation=get_object_by_query('faculty_designation','faculty_designation="'.$_POST['faculty_designation'].'" and school_id="'.$school_id.'" and faculty_designation_id!="'.$faculty_designation_id.'"');
			#if exist
			if($checkDesignation):
				$login_session->pass_msg[]='Entered designation already exist';
				$login_session->set_pass_msg();
				$login_session->set_success();
				Redirect(make_url('administration-role'));
			else:
				#update faculty designation
				if(!array_key_exists($designationDetails->faculty_designation,$defaultDesignationArray)):
				$data['faculty_designation']=$_POST['faculty_designation'];
				$where="faculty_designation_id='".$faculty_designation_id."' and school_id='".$school_id."'";																																																																																			
				update_record_in_table('faculty_designation',$where,$data);
				endif;
				
				#update faculty designation modules access rights
				  if($designationDetails->faculty_designation=='students'):
				  $faculty_designation_access_module=implode(',',$studentDefaultAccessRightArray);
				  $accessable_module_list=$faculty_designation_access_module.','.implode(',',$_POST['faculty_designation_access_module']);
				  else:
				  $faculty_designation_access_module=implode(',',$facultyDefaultAccessRightArray);
				  $accessable_module_list=$faculty_designation_access_module.','.implode(',',$_POST['faculty_designation_access_module']);
				  endif;
				  $data1['faculty_designation_access_module']=$accessable_module_list;
				  $where="faculty_designation_id='".$faculty_designation_id."' and school_id='".$school_id."'";	
				  update_record_in_table('faculty_designation_access_rights',$where,$data1);
				
				Redirect(make_url('administration-role'));
			endif;	
	else:
				$login_session->pass_msg=$valid->error;
				$login_session->set_pass_msg();
				Redirect(make_url('administration-role')); 
	 endif;			
endif;	
#delete
if(isset($_GET['sta']) && $_GET['sta']=='delete'):
    #if not defaut designation
	if(!array_key_exists($designationDetails->faculty_designation,$defaultDesignationArray)):
	  delete_record_from_table('faculty_designation','faculty_designation_id="'.$faculty_designation_id.'"');
	  Redirect(make_url('administration-role')); 
	endif;
endif;
?>
