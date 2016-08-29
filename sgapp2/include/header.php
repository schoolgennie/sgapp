<div class="navbar navbar-inverse navbar-fixed-top">
  <!-- start: TOP NAVIGATION CONTAINER -->
  <div class="container">
    <div class="navbar-header">
      <!-- start: RESPONSIVE MENU TOGGLER -->
      <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="clip-list-2"></span> </button>
      <!-- end: RESPONSIVE MENU TOGGLER -->
      <!-- start: LOGO -->
      <a class="navbar-brand" href=""> <img height="30px" src="upload/photo/school/logoImage/<?=$subDemainName?>.jpg" /> </a>
      <!-- end: LOGO -->
    </div>
    <? if($login_session->is_logged_in()): ?>
    <? $loogedInUserDetails=get_object_by_query($login_session->get_usertype(),$login_session->get_usertype().'_id="'.$login_session->get_user_id().'"');?>
    <div class="navbar-tools">
	
      <!-- start: TOP NAVIGATION MENU -->
      <ul class="nav navbar-right">
	  	<li>
			<a >  SMS Balance <span class="badge badge-warning"> <?=$smsCount=get_object_by_query('school','school_id='.$school_id)->school_message_limit-get_object_by_query('school_sms_count','school_id='.$school_id)->school_sms_count;?></span> </a>
	  	</li>
        <!-- start: NOTIFICATION DROPDOWN -->
        <? $headerNoticeList=get_all_record_by_query('noticeboard','school_id="'.$school_id.'"  order by noticeboard_id desc Limit 6');?>
        <li class="dropdown"> <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#"> <i class="clip-notification-2"></i> <span class="badge"> 0</span> </a>
          <ul class="dropdown-menu notifications">
            <li> <span class="dropdown-menu-title"> There are 0 new notices</span> </li>
            <li>
              <div class="drop-down-wrapper">
                <ul>
                  <? foreach($headerNoticeList as $kHeaderNotice=>$vHeaderNotice):?>
                  <li> <a href="<?=make_url('noticeboard-noticeboard')?>"> <span class="label label-primary"><i class="fa fa-user"></i></span> <span class="message">
                    <?=LimitText(html_entity_decode($vHeaderNotice->notice_title),50)?>
                    </span> <span class="time">
                    <? 
															$noticeDate=(time("now")-strtotime($vHeaderNotice->notice_date))/(60);
															if($noticeDate<1):
															  echo 'Just Now';
															elseif($noticeDate<60):
															  echo round($noticeDate).' min';
															elseif($noticeDate>60 && $noticeDate<(60*24)):
															  echo round($noticeDate/60).' hour'; 
															elseif($noticeDate>(60*24)):
															  echo date('d M',strtotime($vHeaderNotice->notice_date));   
															endif;  
															?>
                    </span> </a> </li>
                  <? endforeach;?>
                </ul>
              </div>
            </li>
            <li class="view-all"> <a href="<?=make_url('noticeboard-noticeboard')?>"> See all notices <i class="fa fa-arrow-circle-right"></i> </a> </li>
          </ul>
        </li>
        <!-- end: NOTIFICATION DROPDOWN -->
        <!-- start: MESSAGE DROPDOWN -->
        <? $headerLatestMessageList=get_all_record_by_query('message','message_receiver_type="'.$login_session->get_usertype().'" and message_receiver_id="'.$login_session->get_user_id().'" order by message_id desc,message_read_status asc Limit 4');?>
        <? $headerUnreadMessageList=get_all_record_by_query('message','message_receiver_type="'.$login_session->get_usertype().'" and message_receiver_id="'.$login_session->get_user_id().'" and message_read_status=0');?>
        <li class="dropdown"> <a class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#"> <i class="clip-bubble-3"></i> <span class="badge">
          <?=count($headerUnreadMessageList)?>
          </span> </a>
          <ul class="dropdown-menu posts">
            <li> <span class="dropdown-menu-title"> You have
              <?=count($headerUnreadMessageList)?>
              messages</span> </li>
            <li>
              <div class="drop-down-wrapper">
                <ul>
                  <? foreach($headerLatestMessageList as $kHeader=>$vHeader):?>
                  <? $headerSenderInfo=getUserInfo($vHeader->message_sender_type,$vHeader->message_sender_id);?>
                  <li> <a href="javascript:;">
                    <div class="clearfix">
                      <div class="thread-image"> <img alt="" src="<?=($headerSenderInfo['image'])?createImazeSize(get_small($vHeader->message_sender_type),$headerSenderInfo['image'],40,40):"design/images/avatar-2.jpg"?>"> </div>
                      <div class="thread-content"> <span class="author">
                        <?=ucwords($headerSenderInfo['name'])?>
                        </span> <span class="preview" onclick="window.location.href='<?=make_url('message-message','id='.$vHeader->message_subject_id)?>'">
                        <?=LimitText(html_entity_decode($vHeader->message),100)?>
                        </span> <span class="time">
                        <? 
															$headerMin=(time("now")-strtotime($vHeader->message_ondate))/(60);
															if($headerMin<1):
															  echo 'Just Now';
															elseif($headerMin<60):
															  echo round($headerMin).' min';
															elseif($headerMin>60 && $headerMin<(60*24)):
															  echo round($headerMin/60).' hour'; 
															elseif($headerMin>(60*24)):
															  echo date('d M',strtotime($vHeader->message_ondate));   
															endif;  
															?>
                        </span> </div>
                    </div>
                    </a> </li>
                  <? endforeach;?>
                </ul>
              </div>
            </li>
            <li class="view-all"> <a href="<?=make_url('message-message')?>"> See all messages <i class="fa fa-arrow-circle-right"></i> </a> </li>
          </ul>
        </li>
        <!-- end: MESSAGE DROPDOWN -->
        <!-- start: USER DROPDOWN -->
        <li class="dropdown current-user"> <a data-toggle="dropdown" class="dropdown-toggle" href="<?=make_url($userLoginTypeArray[$login_session->get_usertype()])?>">
          <? $loogedInUserImage=$login_session->get_usertype().'_image';?>
          <img src="<?=($loogedInUserDetails->$loogedInUserImage)?createImazeSize(get_small($login_session->get_usertype()),$loogedInUserDetails->$loogedInUserImage,30,30):'design/images/avatar-1-small.jpg'?>"  class="circle-img" alt=""> <span class="username">
          <?=$login_session->get_username()?>
          </span> <i class="clip-chevron-down"></i> </a>
          <ul class="dropdown-menu">
            <li> <a href="<?=make_url($userLoginTypeArray[$login_session->get_usertype()])?>"> <i class="clip-user-2"></i> &nbsp;My Profile </a> </li>
            <li> <a href="<?=make_url('message-message')?>"> <i class="clip-bubble-4"></i> &nbsp;My Messages (<?=count($headerUnreadMessageList)?>) </a> </li>
            <li class="divider"></li>
            <li> <a href="<?=make_url('logout-logout')?>"> <i class="clip-exit"></i> &nbsp;Log Out </a> </li>
          </ul>
        </li>
        <!-- end: USER DROPDOWN -->
      </ul>
      <!-- end: TOP NAVIGATION MENU -->
    </div>
    <? endif;?>
  </div>
  <!-- end: TOP NAVIGATION CONTAINER -->
</div>
<? 

check_remember_me();
check_logOff_Time();
change_password_status_check();		
?>
