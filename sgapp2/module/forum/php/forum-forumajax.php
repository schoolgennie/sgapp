<?php 
$userType=($login_session->get_usertype())?$login_session->get_usertype():'';
check_logged_in_for_myaccount($userType);
isset($_POST['p'])?$p=$_POST['p']:$p='1';
isset($_POST['forum_category_id'])?$forum_category_id=$_POST['forum_category_id']:$forum_category_id='';
isset($_POST['topic_id'])?$topic_id=$_POST['topic_id']:$topic_id='';
isset($_POST['forum_comment_id'])?$forum_comment_id=$_POST['forum_comment_id']:$forum_comment_id='';
isset($_POST['forum_topic_id'])?$forum_topic_id=$_POST['forum_topic_id']:$forum_topic_id='';







function forumTopicComeentCreaterUserInfo($type,$id)
{
global $fcultyDesignationArray;
$result=array();
if($type=='school'):# school
   #fetch school details
   $detail=get_object_by_query('school','school_id="'.$id.'"');
   $result['name']=$detail->school_name;
   $result['type']='School';
   $result['image']=$detail->school_image;
elseif($type=='faculty'):# faculty
   #fetch faculty details
   $detail=get_object_by_query('faculty','faculty_id="'.$id.'"');
   $result['name']=$detail->faculty_first_name.' '.$detail->faculty_last_name;
   $result['type']=$fcultyDesignationArray[$detail->faculty_designation];
   $result['image']=$detail->faculty_image;
elseif($type=='student'):# student
   #fetch student details
   $detail=get_object_by_query('student','student_id="'.$id.'"');
   $result['name']=$detail->student_first_name.' '.$detail->student_last_name;
   $result['type']='Student';
   $result['image']=$detail->student_image;
endif;
return $result;
}

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
 
#loged in person info 
$logedInPersonInfo=forumTopicComeentCreaterUserInfo($login_session->get_usertype(),$login_session->get_user_id());
$logedInPersonImage=($logedInPersonInfo['image'])?"upload/photo/".$login_session->get_usertype()."/small/".$logedInPersonInfo['image']:"images/1.png";


if($topic_id):
  # get topic details
  $topicDetails =get_object_by_query('forum_topic','forum_topic_id="'.$topic_id.'" and school_id="'.$school_id.'"');
  #authenticate user
  if(!$topicDetails): #if no
            echo '0~!url does not exist';
	        exit;
  endif;
endif;



if(isset($_POST['mode'])):

	switch($_POST['mode']) {

	
	   case 'getForumToplicList':
	   $result='';
	   
	     
$topicList=get_all_object_by_query('forum_topic','school_id="'.$school_id.'" and forum_category_id="'.$forum_category_id.'" order by forum_topic_id desc',true,$p,3);
if($topicList->GetNumRows()>0):
while($topicListing=$topicList->GetObjectFromRecord()): 
$topicUserInfo=forumTopicComeentCreaterUserInfo($topicListing->forum_topic_creater_type,$topicListing->forum_topic_creater_id);
             $result.='<div class="forum" id="forumTopicDiv'.$topicListing->forum_topic_id.'">';
                # form topic start
                $result.='<div class="box-container">';
				$result.='<div class="row">';
                  $result.='<div class="1u">';
				   $topicCreaterImage=($topicUserInfo['image'])?"upload/photo/".$topicListing->forum_topic_creater_type."/small/".$topicUserInfo['image']:"images/1.png";
                    $result.='<div class="image"><img src='.$topicCreaterImage.' width="40" height="41"/></div>';
                  $result.='</div>';
                  $result.='<div class="10u">';
                      $result.='<a href="'.make_url('profile-'.$topicListing->forum_topic_creater_type.'publicprofile','id='.$topicListing->forum_topic_creater_id).'" style="color:#3B5998; font-size:13px;" rel="day_view"><b>'.$topicUserInfo['name'].' </b></a>
					  <a href="" style="color:#494951; font-size:12px;"><b>'. ucfirst($topicUserInfo['type']).' </b></a>
					  <a href="" style="color:gray; font-size:11px; padding-left:10px;"><b> '.ToIndianDate($topicListing->forum_topic_create_date).' </b></a> ';
					  $result.='</div>';
					  $result.='<div class="1u">';
                    if($login_session->get_usertype()==$userTypeArray[0] || ($topicListing->forum_topic_creater_type==$login_session->get_usertype() && $topicListing->forum_topic_creater_id==$login_session->get_user_id())):
	                $result.='<img align="right" src="images/cross.png" title="Delete" width="10" height="10" onclick="deleteTopic('.$topicListing->forum_topic_id.')"/>';
	               endif;
                    $result.='</div>';
					 $result.='</div>'; 
					$result.='<div class="row">';
                  $result.='<div class="12u">';
                      $result.='<p> '.html_entity_decode($topicListing->forum_topic).' </p>';
                    $result.='</div>';
					$result.='</div>';
					$result.='</div>';
                    
                 # form topic start
                 # forum comment listing start
                 # less comment listing  start
                $result.='<div id="viewLess'.$topicListing->forum_topic_id.'">';
                  $commentList=get_all_record_by_query('forum_comment','school_id="'.$school_id.'" and forum_topic_id="'.$topicListing->forum_topic_id.'" limit 3');
                  if($commentList):
				   $countRecords=get_all_record_by_query('forum_comment','school_id="'.$school_id.'" and forum_topic_id="'.$topicListing->forum_topic_id.'"');
				  if(count($countRecords)>3):
                  $result.='<div align="right" onClick="classToggle('.$topicListing->forum_topic_id.')">View more Replies...</div>';
				  endif;
                  foreach($commentList as $k=>$v):
				  $commentUserInfo=forumTopicComeentCreaterUserInfo($v->forum_comment_creater_type,$v->forum_comment_creater_id);
                  $result.='<div class="row box-container"  id="forumCommentDiv'.$v->forum_comment_id.'">';
                   $result.=' <div class="1u">';
				     $commentCreaterImage=($commentUserInfo['image'])?"upload/photo/".$v->forum_comment_creater_type."/small/".$commentUserInfo['image']:"images/1.png";
                     $result.=' <div class="image"><img src='.$commentCreaterImage.' height="32" width="32" /></div>';
                    $result.='</div>';
                   $result.=' <div class="10u">';
                        $result.='<a href="'.make_url('profile-'.$v->forum_comment_creater_type.'publicprofile','id='.$v->forum_comment_creater_id).'" style="color:#3B5998; font-size:11px;" rel="day_view"><b>'.$commentUserInfo['name'].' </b></a><a href="" style="color:#494951; font-size:11px;"><b> '.ucfirst($commentUserInfo['type']).'</b></a><a href="" style="color:gray; font-size:10px; padding-left:10px;"><b>On Date : '.ToIndianDate($v->forum_comment_create_date).' </b></a>';
                        $result.='<p>'.html_entity_decode($v->forum_comment).'</p>';
                     $result.=' </div>';
                     $result.=' <div class="1u">';
					 if($v->forum_comment_creater_type==$login_session->get_usertype() && $v->forum_comment_creater_id==$login_session->get_user_id()):
					 $result.='<img align="right" src="images/cross.png" title="Delete" width="10" height="10" onclick="deleteTopicComment('.$v->forum_comment_id.')"/>';
					 endif;
					 $result.=' </div>';
                    $result.='</div>';
                  
                  endforeach;
                  endif;
				  
                $result.='</div>';
                # less comment listing  start
                 # all comment listing  start
               $result.=' <div  style="display:none" id="viewAll'.$topicListing->forum_topic_id.'" >';
                  $commentList=get_all_record_by_query('forum_comment','school_id="'.$school_id.'" and forum_topic_id="'.$topicListing->forum_topic_id.'"');
                  if($commentList):
                  $result.='<div align="right" onClick="classToggle('.$topicListing->forum_topic_id.')">View Less Replies...</div>';
                  foreach($commentList as $k=>$v):
				  $commentUserInfo=forumTopicComeentCreaterUserInfo($v->forum_comment_creater_type,$v->forum_comment_creater_id);
                  $result.='<div   id="forumCommentDiv'.$v->forum_comment_id.'">';
				  $result.='<div class="row">';
                    $result.='<div class="1u">';
					 $commentCreaterImage=($commentUserInfo['image'])?"upload/photo/".$v->forum_comment_creater_type."/small/".$commentUserInfo['image']:"images/1.png";
                     $result.=' <div class="" ><img src='.$commentCreaterImage.' height="32" width="32" /></div>';
                   $result.=' </div>';
                   $result.=' <div class="10u">';
                   $result.='<p><a href="'.make_url('profile-'.$v->forum_comment_creater_type.'publicprofile','id='.$v->forum_comment_creater_id).'" style="color:#3B5998; font-size:11px;" rel="day_view"><b>'.$commentUserInfo['name'].' </b></a><a href="" style="color:#494951; font-size:11px;"><b> '.ucfirst($commentUserInfo['type']).'</b></a><a href="" style="color:gray; font-size:10px; padding-left:10px;"><b>On Date : '.ToIndianDate($topicListing->forum_topic_create_date).' </b></a> </p>';
                        $result.='<p>'.html_entity_decode($v->forum_comment).' </p>';
                      $result.='</div>';
                      $result.=' <div class="1u">';
					 if($v->forum_comment_creater_type==$login_session->get_usertype() && $v->forum_comment_creater_id==$login_session->get_user_id()):
					 $result.='<img align="right" src="images/cross.png" title="Delete" width="10" height="10" onclick="deleteTopicComment('.$v->forum_comment_id.')"/>';
					 endif;
					 $result.=' </div>';
                    $result.='</div>';
                  $result.='</div>';
                  endforeach;
                  endif;
				
                $result.='</div>';
				  # post comment forum start
				  $result.=' <div class="row box-container" style=" background:#edeff4; ">';
				     # post comment forum start
				   $result.='<div class="1u">';
                     $result.=' <img src='.$logedInPersonImage.' height="32" />';
                    $result.='</div>';
                   // $result.=' <form name="frm" id="frm" action="'.make_long_url('forumComment','insert','list', 'topic_id='.$topicListing->forum_topic_id).'" method="post">';
                    $result.='<div class="9u">';
                    $result.='<input style="width:100%" name="forum_comment" id="forum_comment'.$topicListing->forum_topic_id.'" type="text" class="reply"  size="" />';
                    $result.='</div>';
					$result.='<div class="2u">';
					 $result.='<input name="submit" align="right" class="small-button" type="submit" value="Reply" onclick="addTopicComment('.$topicListing->forum_topic_id.')"/>';
                    $result.='</div>';
                    //$result.='</form>';
                   $result.='</div>';
				 # post comment forum end
				
				 # post comment forum end
				
                # all comment listing  start
              
                # forum comment listing end
              
  endwhile;
  endif;

	 echo $result;exit;


	   break;
	   case 'addTopicComment':
	         # add validations
			$validation=new user_validation();
			$validation->add('forum_comment', 'req','comment');		
			# check validations.
			$valid= new valid();
			if($valid->validate($_POST, $validation->get())):
	   
	   
	                    $not=array('mode','topic_id');
						$data=$_POST;
						$data['school_id']=$school_id;
						$data['forum_topic_id']=$topic_id;
						$data['forum_comment_creater_type']=$login_session->get_usertype();
						$data['forum_comment_creater_id']=$login_session->get_user_id();
						$data['forum_comment_create_date']=date_format_inserted(date('d-m-Y'));
						insert_record_in_table('forum_comment',$data,$not);
						$maxid=get_object_by_query('forum_comment','school_id="'.$school_id.'"','Max(forum_comment_id) as id')->id;
						//print_r($maxid);
						
                  $result.='<div class=""  id="forumCommentDiv'.$maxid.'">';
                    $result.='<div class="row box-container">';
					
                     $result.=' <div class="1u" ><img src='.$logedInPersonImage.' height="32" width="32" /></div>';
                  
                   $result.=' <div class="10u">';
                      
                        $result.='<p><a href="" style="color:#3B5998; font-size:11px;"><b>'.$logedInPersonInfo['name'].' </b></a><a href="" style="color:#494951; font-size:11px;"><b> '.ucfirst($logedInPersonInfo['type']).'</b></a><a href="" style="color:gray; font-size:10px; padding-left:10px;"><b>On Date :'.ToIndianDate(date_format_inserted(date('d-m-Y'))).' </b></a> </p>';
                        $result.='<p> '.html_entity_decode($_POST['forum_comment']).'</p>';
                      $result.='</div>';
                      $result.=' <div class="1u">';
					 
					 $result.='<img align="right" src="images/cross.png" title="Delete" width="10" height="10" onclick="deleteTopicComment('.$maxid.')"/>';
					
					 $result.=' </div>';
                    $result.='</div>';
                  $result.='</div>';
						
						
						echo '1~!'.$result;exit;
			else:
			 
			  echo '0';exit;
			endif;			
						
	   break;
	   
	   case 'deleteTopicComment':
           if(delete_record_from_table('forum_comment',"forum_comment_id='".$forum_comment_id."' and school_id='".$school_id."'")):
		    echo '1~!Comment has been deleted';
		  else:
		    echo '0~!Wrong Action';
		  endif;
		    exit;
      break;
	  
	  case 'deleteForumTopic':
           if(delete_record_from_table('forum_topic',"forum_topic_id='".$forum_topic_id."' and school_id='".$school_id."'")):
		    echo '1~!Topic and its all comment has been deleted successfully';
		  else:
		    echo '0~!Wrong Action';
		  endif;
		  exit;
	  break;	  
	}				

endif;		


?>				
<script type="text/javascript">
         jQuery(document).ready(function(){ $("a[rel='day_view']").colorbox({width:"720px", height:"500px",overflow:"hidden", iframe:true,previous:false,next:false}); });
         
</script>