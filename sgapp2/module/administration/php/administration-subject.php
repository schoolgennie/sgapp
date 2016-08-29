<?
check_logged_in_for_myaccount('school');
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['subject_id'])?$subject_id=$_GET['subject_id']:$subject_id='0';
#school unique id
$school_id=$login_session->get_user_id();
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

if($subject_id):
  # get subject details
  $subjectDetails =get_object_by_query('subject','subject_id="'.$subject_id.'" and school_id="'.$school_id.'"');
  #authenticate user
  if(!$subjectDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('administration-subject'));
  endif;
endif;

#handle actions here.
switch ($action):
	case'list':
		#fetch class list
         $subjectList=get_all_object_by_query('subject','school_id="'.$school_id.'" order by subject_is_active desc');
		break;
	case'insert':
	     # add class
		if(isset($_POST['submit']) && $_POST['submit']=='Create'):
		   # add validations
			$validation=new user_validation();
			$validation->add('subject_name', 'req','subject name');		
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			        #check entered subject aleady exist or not
					$checkSubject=get_object_by_query('subject','subject_name="'.$_POST['subject_name'].'" and school_id="'.$school_id.'"');
					#if exist
					if($checkSubject):
						$login_session->pass_msg[]='Entered subject already exist';
						$login_session->set_pass_msg();
						$login_session->set_success();
						Redirect(make_long_url('administration-subject'));
					else:
						$not=array('submit');
						$data=$_POST;
						$data['school_id']=$school_id;
						insert_record_in_table('subject',$data,$not);
						Redirect(make_url('administration-subject'));
					endif;	
			else:
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_long_url('administration-subject')); 
			 endif;			
			
		endif;	
		break;
	default:break;
endswitch;
?>
