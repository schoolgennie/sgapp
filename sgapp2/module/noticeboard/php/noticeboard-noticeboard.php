<?
include_once(DIR_FS_SITE_INCLUDE.'commonModule.php');
$action=isset($_GET['action'])?$_GET['action']:'list';
$section=isset($_GET['section'])?$_GET['section']:'list';
$noticeboard_id=isset($_GET['noticeboard_id'])?$_GET['noticeboard_id']:'';
$senderType=isset($_POST['senderType'])?$_POST['senderType']:'';
$classList=get_all_record_by_query('class','class_is_active=1');



#handle actions here.
switch ($action):
	case'list':	
		#fetch notice list
		$noticeList=get_all_record_by_query('noticeboard','school_id="'.$school_id.'"  order by noticeboard_id desc');
    break;
	case'insert':
		#add notice
		if(isset($_POST['submit']) && $_POST['submit']=='Submit' && $login_session->get_usertype()==$userTypeArray[0]):
		//sendSms(9988198254,SITE_NAME.' Notice','c');exit;
			   # add validations
				$validation=new user_validation();
				$validation->add('notice_title', 'req','title');	
				$validation->add('notice', 'req','Description');		
				# check validations.
				$valid= new valid();
				if($valid->validate($_POST, $validation->get())):
				$code=generateCode(6);
							$not=array('submit','sendEmail','sendSms','senderType');
							$data=$_POST;
							$data['school_id']=$school_id;
							$data['notice_date']=date('Y-m-d');
							if(upload_file('noticeBoard', $_FILES['notice_attachment'],$code.'_')):
							$data['notice_attachment']=$code.'_'.$_FILES['notice_attachment']['name'];
							endif;
							insert_record_in_table('noticeboard',$data,$not);
							#send email ans sms
							$noticeTitle=$_POST['notice_title'];
							$notice=$_POST['notice'];
							include(DIR_FS_SITE_INCLUDE_EMAIL.'noticeBoardEmail.php');
							#student list
							if(!$senderType || $senderType!='faculty'):
							if($senderType && $senderType!='parents'):
							  
							  $studentList=get_all_record_by_query('student','student_is_active!=0 and class_id="'.$senderType.'"');
							else:
							
							  $studentList=get_all_record_by_query('student','student_is_active!=0');
							endif;
							  foreach($studentList as $k=>$v):
							   #send mail
							   if(isset($_POST['sendEmail']) && $v->student_email_id):
								 send_email(SITE_NAME.': '.$noticeTitle, $v->student_email_id, ADMIN_EMAIL, SITE_NAME, $contents);
							   endif;
							   #send sms
							   if(isset($_POST['sendSms']) && $v->student_contact && (get_object_by_query('school','school_id='.$school_id)->school_message_limit-get_object_by_query('school_sms_count','school_id='.$school_id)->school_sms_count)>0):
								  sendSms('91'.$v->student_contact,'WebSMS',LimitText($_POST['notice_title'],150));
							   endif; 	 
							  endforeach;
							 endif;
							#faculty list
							if(!$senderType || $senderType=='faculty'):
							
							$facultyList=get_all_record_by_query('faculty','faculty_is_active!=0 and school_id="'.$school_id.'"'); 
							  foreach($facultyList as $k=>$v):
							   #send mail
							   if(isset($_POST['sendMail']) && $v->faculty_email_id):
								 send_email(SITE_NAME.': '.$noticeTitle, $v->faculty_email_id, ADMIN_EMAIL, SITE_NAME, $contents);
							   endif;
							   #send sms
							   if(isset($_POST['sendSms']) && $v->faculty_mobile  && (get_object_by_query('school','school_id='.$school_id)->school_message_limit-get_object_by_query('school_sms_count','school_id='.$school_id)->school_sms_count)>0):
								  sendSms('91'.$v->faculty_mobile,'WebSMS',LimitText($_POST['notice_title'],150));
							   endif; 	 
							  endforeach;
							 endif; 
							
							Redirect(make_url('noticeboard-noticeboard'));
							
				 else:
							$login_session->pass_msg=$valid->error;
							$login_session->set_pass_msg();
							Redirect(make_url('noticeboard-noticeboard')); 
				 endif;	
		endif;
		break;
	   case'download':
		#download 
		download_file('upload/photo/noticeBoard/'.$_GET['file']);
	    Redirect(make_url('noticeboard-noticeboard'));
		break;	
	   case'detail':
		#notice detail
		$noticeDetail=get_object_by_query('noticeboard','noticeboard_id="'.$noticeboard_id.'"');
		break;		
 
	default:break;
endswitch;
		
?>
