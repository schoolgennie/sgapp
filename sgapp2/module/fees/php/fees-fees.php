<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');

$action=isset($_GET['action'])?$_GET['action']:'list';
$section=isset($_GET['section'])?$_GET['section']:'list';
$fee_category_id=isset($_GET['fee_category_id'])?$_GET['fee_category_id']:'';
$fee_waiver_category_id=isset($_GET['fee_waiver_category_id'])?$_GET['fee_waiver_category_id']:'';
$fee_collection_type_id=isset($_GET['fee_collection_type_id'])?$_GET['fee_collection_type_id']:'';
$class=isset($_GET['class'])?$_GET['class']:'';
$fee_structure_id=isset($_GET['fee_structure_id'])?$_GET['fee_structure_id']:'';

if($class):
#fetch studet list
$studentList=get_all_record_by_query('student','class_id="'.$class.'" and student_is_active!=0');
endif;
$student_id_field=array();

#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);
#fetch fee category list
$feeCategoryList=get_all_record_by_query('fee_category');
#fetch fee waiver category list
$feeWaiverCategoryList=get_all_record_by_query('fee_waiver_category');
#fetch fee collection type list
$feeCollectionTypetList=get_all_record_by_query('fee_collection_type order by fee_collection_type_start_date');
#fetch class  list
$classList=get_all_record_by_query('class');
#fetch fee Fine details
$feeFineDetails=get_object_by_query('fee_fine');
#handle actions here.
switch ($action):
	case'list':
		#fetch class list
         $classList=get_all_record_by_query('class','school_id="'.$school_id.'"  order by class_is_active desc');
		break;
	case'insertFeeCategory':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Create'):
		
		    # add validations
			$validation=new user_validation();
			$validation->add('fee_category', 'req','category');	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered category aleady exist or not
					$checkCategory=get_object_by_query('fee_category','fee_category="'.$_POST['fee_category'].'"');
					#if exist
					if($checkCategory):
						$login_session->pass_msg[]='Category already exists !! ';
						$login_session->set_pass_msg();
						$login_session->set_success();
						Redirect(make_url('fees-fees'));
					else:
						$not=array('submit');
						$data=$_POST;
						insert_record_in_table('fee_category',$data,$not);
						Redirect(make_url('fees-fees'));
					endif;	
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('fees-fees')); 
			 endif;			
			
		endif;	
		break;
	case'updateFeeCategory':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
		    # add validations
			$validation=new user_validation();
			$validation->add('fee_category', 'req','category');	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered category aleady exist or not
					$checkCategory=get_object_by_query('fee_category','fee_category="'.$_POST['fee_category'].'" and fee_category_id!="'.$fee_category_id.'"');
					#if exist
					if($checkCategory):
						$login_session->pass_msg[]='Category already exists !! ';
						$login_session->set_pass_msg();
						$login_session->set_success();
						Redirect(make_url('fees-fees'));
					else:
						$not=array('submit');
						$data=$_POST;
						$where="fee_category_id='".$fee_category_id."'";																																																																																			
						update_record_in_table('fee_category',$where,$data,$not);
						Redirect(make_url('fees-fees'));
					endif;	
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('fees-fees')); 
			 endif;			
			
		endif;	
		break;
	case'insertFeeWaiverCategory':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Create'):
		
		    # add validations
			$validation=new user_validation();
			$validation->add('fee_waiver_category', 'req','waiver category');	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered category aleady exist or not
					$checkCategory=get_object_by_query('fee_waiver_category','fee_waiver_category="'.$_POST['fee_waiver_category'].'"');
					#if exist
					if($checkCategory):
						$login_session->pass_msg[]='Category already exists !! ';
						$login_session->set_pass_msg();
						$login_session->set_success();
						Redirect(make_url('fees-fees'));
					else:
						$not=array('submit');
						$data=$_POST;
						insert_record_in_table('fee_waiver_category',$data,$not);
						Redirect(make_url('fees-fees'));
					endif;	
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('fees-fees')); 
			 endif;			
			
		endif;	
		break;
	case'updateFeeWaiverCategory':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
		    # add validations
			$validation=new user_validation();
			$validation->add('fee_waiver_category', 'req','waiver category');	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered category aleady exist or not
					$checkCategory=get_object_by_query('fee_waiver_category','fee_waiver_category="'.$_POST['fee_waiver_category'].'" and fee_waiver_category_id!="'.$fee_waiver_category_id.'"');
					#if exist
					if($checkCategory):
						$login_session->pass_msg[]='Category already exists !! ';
						$login_session->set_pass_msg();
						$login_session->set_success();
						Redirect(make_url('fees-fees'));
					else:
						$not=array('submit');
						$data=$_POST;
						$where="fee_waiver_category_id='".$fee_waiver_category_id."'";																																																																																			
						update_record_in_table('fee_waiver_category',$where,$data,$not);
						Redirect(make_url('fees-fees'));
					endif;	
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('fees-fees')); 
			 endif;			
			
		endif;	
		break;	
    case'insertFeeFine':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Save'):
		
		    # add validations
			$validation=new user_validation();
			$validation->add('fee_fine_amount', 'req','amount');	
			$validation->add('fee_fine_amount', 'num','amount');	
			$validation->add('fee_fine_duration', 'req','duration');
			$validation->add('fee_fine_max', 'num','maximum fine');	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
					#if not exist
					if(!$feeFineDetails):
						$not=array('submit');
						$data=$_POST;
						insert_record_in_table('fee_fine',$data,$not);
						Redirect(make_url('fees-fees'));
					endif;	
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('fees-fees')); 
			 endif;			
			
		endif;	
		break;
	case'updateFeeFine':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
		    # add validations
			$validation=new user_validation();
			$validation->add('fee_fine_amount', 'req','amount');	
			$validation->add('fee_fine_amount', 'num','amount');	
			$validation->add('fee_fine_duration', 'req','duration');
			$validation->add('fee_fine_max', 'num','maximum fine');		
			
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			     
						$not=array('submit','fee_fine_id');
						$data=$_POST;
						$where="fee_fine_id='".$_POST['fee_fine_id']."'";																																																																																			
						update_record_in_table('fee_fine',$where,$data,$not);
						Redirect(make_url('fees-fees'));
					
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('fees-fees')); 
			 endif;			
			
		endif;	
		break;		
	case'insertFeeCollection':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Create'):
		    # add validations
			$validation=new user_validation();
			$validation->add('fee_collection_type', 'req','fee collection type');	
			$validation->add('fee_collection_type_start_date', 'req','start date');	
			$validation->add('fee_collection_type_start_date', 'checkDate','start date');	
			$validation->add('fee_collection_type_end_date', 'req','End date');	
			$validation->add('fee_collection_type_end_date', 'checkDate','End date');	
			$validation->add('fee_collection_type_due_date', 'req','Due date');	
			$validation->add('fee_collection_type_due_date', 'checkDate','Due date');	
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered fee collection type aleady exist or not
					$check=get_object_by_query('fee_collection_type','fee_collection_type="'.$_POST['fee_collection_type'].'"');
					#if exist
					if($check):
						$login_session->pass_msg[]='fee collection type already exists !! ';
						$login_session->set_pass_msg();
						$login_session->set_success();
						Redirect(make_url('fees-fees'));
					else:
						$not=array('submit','fee_collection_type_start_date','fee_collection_type_end_date','fee_collection_type_due_date');
						$data=MakeDataArray($_POST, $not);
						$data['fee_collection_type_start_date']=defaultDatabaseDateFormat($_POST['fee_collection_type_start_date']);
						$data['fee_collection_type_end_date']=defaultDatabaseDateFormat($_POST['fee_collection_type_end_date']);
						$data['fee_collection_type_due_date']=defaultDatabaseDateFormat($_POST['fee_collection_type_due_date']);
						insert_record_in_table('fee_collection_type',$data);
						Redirect(make_url('fees-fees'));
					endif;	
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('fees-fees')); 
			 endif;			
			
		endif;	
		break;
	case'updateFeeCollection':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
		
		    # add validations
			$validation=new user_validation();
			$validation->add('fee_collection_type', 'req','fee collection type');	
			$validation->add('fee_collection_type_start_date', 'req','start date');	
			$validation->add('fee_collection_type_start_date', 'checkDate','start date');	
			$validation->add('fee_collection_type_end_date', 'req','End date');	
			$validation->add('fee_collection_type_end_date', 'checkDate','End date');	
			$validation->add('fee_collection_type_due_date', 'req','Due date');	
			$validation->add('fee_collection_type_due_date', 'checkDate','Due date');
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered category aleady exist or not
					$check=get_object_by_query('fee_collection_type','fee_collection_type="'.$_POST['fee_collection_type'].'" and fee_collection_type_id!="'.$fee_collection_type_id.'"');
					#if exist
					if($check  || $_POST['fee_collection_type']=='One Time Fee'):
						$login_session->pass_msg[]='fee collection type already exists !! ';
						$login_session->set_pass_msg();
						$login_session->set_success();
						Redirect(make_url('fees-fees'));
					else:
						$not=array('submit','fee_collection_type_start_date','fee_collection_type_end_date','fee_collection_type_due_date');
						$data=MakeDataArray($_POST, $not);
						$data['fee_collection_type_start_date']=defaultDatabaseDateFormat($_POST['fee_collection_type_start_date']);
						$data['fee_collection_type_end_date']=defaultDatabaseDateFormat($_POST['fee_collection_type_end_date']);
						$data['fee_collection_type_due_date']=defaultDatabaseDateFormat($_POST['fee_collection_type_due_date']);
						$where="fee_collection_type_id='".$fee_collection_type_id."'";																																																																																			
						update_record_in_table('fee_collection_type',$where,$data);
						Redirect(make_url('fees-fees'));
					endif;	
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('fees-fees')); 
			 endif;			
			
		endif;	
		break;	
	case'insertFeeStructure':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Save'):
		//print_r($_POST);exit;
		    # add validations
			$validation=new user_validation();
			$validation->add('fee_category_id', 'arrayNoElementBlank','fee category');	
			$validation->add('fee_structure_amount', 'arrayNoElementBlank','fee amount');
			$validation->add('fee_structure_frequency', 'arrayNoElementBlank','frequency');
			$validation->add('fee_collection_type_id', 'req','fee collection');
			$validation->add('class_id', 'req','class');
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			       foreach($_POST['fee_category_id'] as $k=>$v):
						$data['fee_category_id']=$v;
						$data['fee_structure_amount']=$_POST['fee_structure_amount'][$k];
						$data['fee_structure_frequency']=$_POST['fee_structure_frequency'][$k];
						$data['fee_structure_notes']=$_POST['fee_structure_notes'][$k];
						$data['fee_collection_type_id']=$_POST['fee_collection_type_id'];
						$data['class_id']=$_POST['class_id'];
						if(insert_record_in_table('fee_structure',$data)):
						$maxid=get_object_by_query('fee_structure','','Max(fee_structure_id) as id')->id;
						foreach($_POST['student_id'][$k] as $studentk=>$studentv):
							$data1['fee_structure_id']=$maxid;
							$data1['student_id']=$studentv;
							insert_record_in_table('fee_collection_management',$data1);
						endforeach;
						endif;
					endforeach;
					
					Redirect(make_url('fees-fees','class='.$class));
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('fees-fees','class='.$class)); 
			 endif;			
			
		endif;	
		break;
    case'updateFeeStructure':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
	
		    # add validations
			$validation=new user_validation();
			$validation->add('fee_category_id', 'req','fee category');	
			$validation->add('fee_structure_amount', 'req','fee amount');
			
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			     
					    $data['fee_category_id']=$_POST['fee_category_id'];
						$data['fee_structure_amount']=$_POST['fee_structure_amount'];
						$data['fee_structure_notes']=$_POST['fee_structure_notes'];
						$where="fee_structure_id='".$fee_structure_id."'";																																																																																			
						if(update_record_in_table('fee_structure',$where,$data)):
						delete_record_from_table('fee_collection_management','fee_structure_id='.$fee_structure_id);
						foreach($_POST['student_id'][$fee_structure_id] as $studentk=>$studentv):
							$data1['fee_structure_id']=$fee_structure_id;
							$data1['student_id']=$studentv;
							insert_record_in_table('fee_collection_management',$data1);
						endforeach;
						endif;
					Redirect(make_url('fees-fees','class='.$class));
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('fees-fees','class='.$class)); 
			 endif;			
			
		endif;	
		break;
	default:break;
endswitch;



			
?>
