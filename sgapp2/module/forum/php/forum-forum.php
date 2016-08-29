<?
$userType=($login_session->get_usertype())?$login_session->get_usertype():'';
check_logged_in_for_myaccount($userType);

isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['topic_id'])?$topic_id=$_GET['topic_id']:$topic_id='0';

if($login_session->get_usertype()==$userTypeArray[0]):# school
   #school unique id
   $school_id=$login_session->get_user_id();

elseif($login_session->get_usertype()==$userTypeArray[1]):# faculty
   #fetch faculty details
   $facultyDetail=get_object_by_query('faculty','faculty_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$facultyDetail->school_id;

elseif($login_session->get_usertype()==$userTypeArray[2]):# student
   #fetch student details
   $studentDetail=get_object_by_query('student','student_id="'.$login_session->get_user_id().'"');
   #school unique id
   $school_id=$studentDetail->school_id;
endif;

#create default category
$forumCategoryCount=get_object_by_query_count('forum_category','school_id="'.$school_id.'"');
if(!$forumCategoryCount):
            $data['forum_category']='General Discussion';
			$data['school_id']=$school_id;
			$data['forum_category_creater_id']=$school_id;
			$data['forum_category_create_date']=date_format_inserted(date('d-m-Y'));
			insert_record_in_table('forum_category',$data);		
endif;

# fetch forum category list
$forumCategoryList=get_all_record_by_query('forum_category','school_id="'.$school_id.'"');
$forum_category_id=(isset($_GET['forum_category_id']) && $_GET['forum_category_id']!='')?$_GET['forum_category_id']:$forumCategoryList[0]->forum_category_id;


#fetch school details
$schoolDetail=get_object_by_query('school','school_id='.$school_id);

if($forum_category_id):
  # get category details

     $categoryDetails =get_object_by_query('forum_category','forum_category_id="'.$forum_category_id.'" and school_id="'.$school_id.'"');
  
  #authenticate user
  if(!$categoryDetails): #if no
            $login_session->pass_msg[]='url does not exist';
	        $login_session->set_pass_msg();
	        $login_session->set_success();
	        Redirect(make_url('forum-forum'));
  endif;
endif;

#handle actions here.
switch ($action):
	case'list':
		#fetch class list
         $topicList=get_all_object_by_query('forum_topic','school_id="'.$school_id.'" order by forum_topic_id desc',true,1,2);
		break;
	case'insert':
	  
	     # add topic
		if(isset($_POST['submit']) && $_POST['submit']=='Post'):
		   # add validations
			$validation=new user_validation();
			$validation->add('forum_topic', 'req','topic');	
				
					
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			       
						$not=array('submit');
						$data=$_POST;
						$data['school_id']=$school_id;
						$data['forum_topic_creater_type']=$login_session->get_usertype();
						$data['forum_category_id']=$forum_category_id;
						$data['forum_topic_creater_id']=$login_session->get_user_id();
						$data['forum_topic_create_date']=date_format_inserted(date('d-m-Y'));
						insert_record_in_table('forum_topic',$data,$not);
						//$login_session->pass_msg[]='New topic has been added successfully';
						//$login_session->set_pass_msg();
						//$login_session->set_success();
						Redirect(make_url('forum-forum','forum_category_id='.$forum_category_id));
						
			else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('forum-forum', 'forum_category_id='.$forum_category_id)); 
			 endif;			
			
		endif;	
		break;
	case'insertCategory':
	    #check user type
		if($login_session->get_usertype()!=$userTypeArray[0]):
				$login_session->pass_msg[]='You have no permission to access this section';
				$login_session->set_pass_msg();
				$login_session->set_success();
				Redirect(make_url('forum-forum'));
		  
		endif;
	     # add category
		if(isset($_POST['submit']) && $_POST['submit']=='Create'):
		   # add validations
			$validation=new user_validation();
			$validation->add('forum_category', 'req','category');	
				
					
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
			       
						$not=array('submit');
						$data=$_POST;
						$data['school_id']=$school_id;
						$data['forum_category_creater_id']=$login_session->get_user_id();
						$data['forum_category_create_date']=date_format_inserted(date('d-m-Y'));
						insert_record_in_table('forum_category',$data,$not);
						//$login_session->pass_msg[]='New category has been added successfully';
						//$login_session->set_pass_msg();
						//$login_session->set_success();
						Redirect(make_url('forum-forum','forum_category_id='.$forum_category_id));
						
			else:
					   
						$login_session->pass_msg=$valid->error;
						$login_session->set_pass_msg();
						Redirect(make_url('forum-forum','forum_category_id='.$forum_category_id)); 
			 endif;			
			
		endif;	
		break;	
	
    case'deleteCategory':
		#delete category
		 #check user type
		if($login_session->get_usertype()!=$userTypeArray[0]):
				$login_session->pass_msg[]='You have no permission to access this section';
				$login_session->set_pass_msg();
				$login_session->set_success();
				Redirect(make_url('forum-forum'));
		  
		endif;
		if(get_object_by_query('forum_category','forum_category_id="'.$_GET['categoryId'].'" and school_id="'.$school_id.'"')->forum_category!='General Discussion'):
		delete_record_from_table('forum_category',"forum_category_id='".$_GET['categoryId']."' and school_id='".$school_id."'");
		endif;
		//$login_session->pass_msg[]='Category has been deleted successfully.';
	    //$login_session->set_pass_msg();
	   // $login_session->set_success();
		if($_GET['categoryId']==$forum_category_id):
	    Redirect(make_url('forum-forum'));
		else:
		Redirect(make_url('forum-forum','forum_category_id='.$forum_category_id));
		endif;
		break;		
	case'delete':
		#delete topic
		delete_record_from_table('forum_topic',"forum_topic_id='".$topic_id."' and school_id='".$school_id."'");
		$login_session->pass_msg[]='Topic and its all comment has been deleted successfully.';
	    $login_session->set_pass_msg();
	    $login_session->set_success();
	    Redirect(make_url('forum-forum'));
		break;
		
	
 
	default:break;
endswitch;
?>
