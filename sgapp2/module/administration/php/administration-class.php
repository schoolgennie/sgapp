<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');

isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['class_id'])?$class_id=$_GET['class_id']:$class_id='0';
isset($_GET['student_id'])?$student_id=$_GET['student_id']:$student_id='0';
isset($_GET['faculty_id'])?$faculty_id=$_GET['faculty_id']:$faculty_id='0';
isset($_GET['p'])?$p=$_GET['p']:$p='1';



#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

#fetch faculty list
$facultyList=get_all_record_by_query('faculty','school_id="'.$school_id.'" and (faculty_is_active=1 or faculty_is_active=2)');

#fetch subject list
$subjectList=get_all_record_by_query('subject','school_id="'.$school_id.'" and subject_is_active=1');

#handle actions here.
switch ($action):
	case'list':
		#fetch class list
         $classList=get_all_record_by_query('class','school_id="'.$school_id.'"  order by class_is_active desc');
		break;
	case'insert':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Create'):
		    # add validations
			$validation=new user_validation();
			$validation->add('class_name', 'req','class name');		
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered class aleady exist or not
					$checkClass=get_object_by_query('class','class_name="'.$_POST['class_name'].'" and school_id="'.$school_id.'"');
					#if exist
					if($checkClass):
						$login_session->pass_msg[]=($checkClass->class_is_active==0)?'Activate Class !! Class already exists ':'Class already exists !! ';
						$login_session->set_pass_msg();
						$login_session->set_success();
						Redirect(make_url('administration-class'));
					else:
						$not=array('submit');
						$data=$_POST;
						$data['school_id']=$school_id;
						insert_record_in_table('class',$data,$not);
						Redirect(make_url('administration-class'));
					endif;	
			 else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('administration-class')); 
			 endif;			
			
		endif;	
		break;

	default:break;
endswitch;



			
?>
