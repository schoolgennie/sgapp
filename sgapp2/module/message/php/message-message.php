<?
#user type
$userType=($login_session->get_usertype())?$login_session->get_usertype():'';
check_logged_in_for_myaccount($userType);

#logged in user id
$userId=$login_session->get_user_id();

if($login_session->get_usertype()==$userTypeArray[0]):# school
   #school unique id
   $school_id=$login_session->get_user_id();
   #get class list
   $classList=get_all_record_by_query('class','school_id="'.$school_id.'" and class_is_active=1');
elseif($login_session->get_usertype()==$userTypeArray[1]):# faculty
   #fetch faculty details
   $facultyDetail=get_object_by_query('faculty','faculty_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$facultyDetail->school_id;
   #get class list
   $classList=get_all_record_by_query('faculty_management as a ,subject as b,class as c','a.faculty_id="'.$login_session->get_user_id().'" and  b.subject_id=a.subject_id and c.class_id=a.class_id and b.subject_is_active=1 and c.class_is_active=1 and a.faculty_management_is_active=1 group by a.class_id order by c.class_position');
elseif($login_session->get_usertype()==$userTypeArray[2]):# student
   #fetch student details
   $studentDetail=get_object_by_query('student','student_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$studentDetail->school_id;
endif;
#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);
#message subject list
$messageSubjectList=get_all_record_by_query('message_subject','school_id="'.$school_id.'" and ((message_subject_sender_type="'.$userType.'" and message_subject_sender_id="'.$userId.'" and message_subject_sender_status=1) or (message_subject_receiver_type="'.$userType.'" and message_subject_receiver_id="'.$userId.'" and message_subject_receiver_status=1)) order by message_subject_id desc');


$id=(isset($_GET['id']) && $_GET['id']!='')?$_GET['id']:$messageSubjectList[0]->message_subject_id;

if($id):
# check message subject detail exist
$messageSubjectDeatil=get_object_by_query('message_subject','school_id="'.$school_id.'" and message_subject_id="'.$id.'" and ((message_subject_sender_type="'.$userType.'" and message_subject_sender_id="'.$userId.'" and message_subject_sender_status=1) or (message_subject_receiver_type="'.$userType.'" and message_subject_receiver_id="'.$userId.'" and message_subject_receiver_status=1))');

if(!$messageSubjectDeatil):
  Redirect(make_url('message-message'));exit;
endif;

# fetch message list
$messageList=get_all_record_by_query('message','school_id="'.$school_id.'" and message_subject_id="'.$id.'" order by message_id desc');
endif;

  # add message subject
		if(isset($_POST['submit']) && $_POST['submit']=='Send'):
		
		   # add validations
			$validation=new user_validation();
			$validation->add('message_subject_receiver_type', 'req','Recepient');	
			$validation->add('message_subject_receiver_id', 'req','Recepient Name');	
			$validation->add('message_subject', 'req','subject');	
			$validation->add('message', 'req','message');		
					
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			            # enter message subject details
						$not=array('submit','message','class');
						$data=$_POST;
						$data['school_id']=$school_id;
						$data['message_subject_receiver_type']=($_POST['message_subject_receiver_type']=='students')?'student':'faculty';
						$data['message_subject_sender_type']=$userType;
						$data['message_subject_sender_id']=$login_session->get_user_id();
						//print_r($data);exit;
						insert_record_in_table('message_subject',$data,$not);
						$maxid=get_object_by_query('message_subject','school_id="'.$school_id.'"','Max(message_subject_id) as id')->id;
						# enter message  details
						
						$data1['school_id']=$school_id;
						$data1['message_subject_id']=$maxid;
						$data1['message_receiver_type']=($_POST['message_subject_receiver_type']=='students')?'student':'faculty';
						$data1['message_receiver_id']=$_POST['message_subject_receiver_id'];;
						$data1['message_sender_type']=$userType;
						$data1['message_sender_id']=$login_session->get_user_id();
						$data1['message']=$_POST['message'];
						insert_record_in_table('message',$data1);
						Redirect(make_url('message-message'));
						
			else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('message-message')); 
			 endif;			
			
		endif;	
?>
