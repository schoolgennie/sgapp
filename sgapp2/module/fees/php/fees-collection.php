<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');

isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['student_id'])?$student_id=$_GET['student_id']:$student_id='0';
isset($_GET['p'])?$p=$_GET['p']:$p='1';
isset($_GET['student_fee_history_id'])?$student_fee_history_id=$_GET['student_fee_history_id']:$student_fee_history_id='';
#school unique id
$school_id=$login_session->get_user_id();

#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

#fetch class list
$classList=get_all_record_by_query('class','school_id="'.$school_id.'" and class_is_active=1 order by class_position');

#fetch waiver category
$feeWaiverCategoryList=get_all_record_by_query('fee_waiver_category');


if($student_id):
  # get student details
  $studentDetails =get_object_by_query('student','student_id="'.$student_id.'" and school_id="'.$school_id.'"');
  #authenticate user
  if(!$studentDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('administration-student'));
  endif;
endif;

#handle actions here.
switch ($action):
	case'list':
		#search parameter
		$keyword=(isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='')?$_REQUEST['keyword']:'';
		$class=(isset($_REQUEST['class']) && $_REQUEST['class']!='')?$_REQUEST['class']:'';
		$where=($class)?" and class_id='".$class."'":'';
		$where.=($keyword)?" and (student_first_name LIKE '%".$_REQUEST['keyword']."%' or student_last_name LIKE '%".$_REQUEST['keyword']."%' or student_email_id LIKE '%".$_REQUEST['keyword']."%')":'';
		$qstring=($keyword)?'keyword='.$keyword:'';
		
		 #fetch class list
         $studentList=get_all_object_by_query('student','school_id="'.$school_id.'"'.$where.'  order by student_is_active desc');
		break;
   case'feeHistory':
		#fetch fee collection type list
		$feeCollectionType=(isset($_REQUEST['feeCollectionType']) && $_REQUEST['feeCollectionType']!='')?$_REQUEST['feeCollectionType']:'';
		$where=($feeCollectionType)?" and c.fee_collection_type_id='".$feeCollectionType."'":'';
		$feeCollectionTypetArray=get_all_record_by_query('fee_collection_management as a,fee_structure as b,fee_collection_type as c','a.student_id="'.$student_id.'" and b.fee_structure_id=a.fee_structure_id and c.fee_collection_type_id=b.fee_collection_type_id  group by c.fee_collection_type_id order by c.fee_collection_type_start_date');
        $feeCollectionTypetList=get_all_record_by_query('fee_collection_management as a,fee_structure as b,fee_collection_type as c','a.student_id="'.$student_id.'" and b.fee_structure_id=a.fee_structure_id and c.fee_collection_type_id=b.fee_collection_type_id '.$where.' group by c.fee_collection_type_id order by c.fee_collection_type_start_date');
		break;	
   case'payStudentFee':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Pay Now'):
		    # add validations
			$validation=new user_validation();
			$validation->add('student_fee_history_paid_amount', 'req','pay field ');	
			$validation->add('student_fee_history_paid_amount', 'num','pay field ');	
			$validation->add('student_fee_history_payment_mode', 'req','payment mode ');
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			     
						$not=array('submit','student_fee_history_cheque_date');
						$data=MakeDataArray($_POST, $not);
						$data['student_fee_history_cheque_date']=($_POST['student_fee_history_cheque_date'])?defaultDatabaseDateFormat($_POST['student_fee_history_cheque_date']):date('Y-m-d');
						$data['student_id']=$student_id;
						insert_record_in_table('student_fee_history',$data);
						Redirect(make_long_url('fees-collection','feeHistory','feeHistory','student_id='.$student_id));
			 else:
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('fees-collection','feeHistory','feeHistory','student_id='.$student_id)); 
			 endif;			
			
		endif;	
		break;	
	  case'updateStudentFee':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Update'):
		
		    # add validations
			$validation=new user_validation();
			$validation->add('student_fee_history_paid_amount', 'req','pay field ');	
			$validation->add('student_fee_history_paid_amount', 'num','pay field ');	
			$validation->add('student_fee_history_payment_mode', 'req','payment mode ');
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			    // print_r($_POST);exit;
						$not=array('submit','student_fee_history_cheque_date');
						$data=MakeDataArray($_POST, $not);
						$data['student_fee_history_cheque_date']=($_POST['student_fee_history_cheque_date'])?defaultDatabaseDateFormat($_POST['student_fee_history_cheque_date']):date('Y-m-d');
						$where="student_fee_history_id='".$student_fee_history_id."'";																																																																																			
						update_record_in_table('student_fee_history',$where,$data);
						Redirect(make_long_url('fees-collection','feeHistory','feeHistory','student_id='.$student_id));
			 else:
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('fees-collection','feeHistory','feeHistory','student_id='.$student_id)); 
			 endif;			
			
		endif;	
		break;				
	default:break;
endswitch;
?>
