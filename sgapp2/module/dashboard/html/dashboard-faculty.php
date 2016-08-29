<!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
</head>
<body>
<!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<!-- start: MAIN CONTAINER -->
<div class="main-container">
  <!--Navigation Start -->
  <? include_once(DIR_FS_SITE_INCLUDE.'facultyNav.php'); ?>
  <!--Navigation End -->
  <div class="main-content">
    <?php display_form_error();?>
    <div class="container">
      <!-- start: PAGE HEADER -->
      <div class="row">
        <div class="col-sm-12">
         <div class="page-header">
            <h1>Dashboard<small> Faculty</small></h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <div class="row">
        <div class="col-sm-12"></div>
      </div>
      
      <div class="row">
        <div class="col-sm-8">
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-stats"></i> Notice Board
              <div class="panel-tools"> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
            </div>
            <div class="panel-body">
              <div id="accordion" class="panel-group accordion-custom notice-board">
                <div class="row">
                  <? if($dashboardNoticeList):?>
                  <? foreach($dashboardNoticeList as $k=>$v):?>
                  <div class="col-sm-6" style="margin-top:5px;">
                    <div class="panel panel-default">
                      <div class="panel-heading"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$v->noticeboard_id?>"> 
                        <?=limitText($v->notice_title,30); ?>
                        <i class="notice-date">
                        <?=ToIndianDate($v->notice_date) ?>
                        </i> </a> </div>
                      <div id="collapse<?=$v->noticeboard_id?>" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <p>
                            <?=limitText(html_entity_decode($v->notice),200); ?>
                          </p>
                          <a class="view-more" href="<?=make_long_url('noticeboard-noticeboard','detail','detail','noticeboard_id='.$v->noticeboard_id)?>"> More Details <i class="clip-arrow-right-2"></i> </a> </div>
                      </div>
                    </div>
                  </div>
                  <? endforeach;?>
                  <? else:?>
                  <h2>No Notice. </h2>
                  <? endif;?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-heading"> <i class="clip-pie"></i> Recent Messages
                  <div class="panel-tools"> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
                </div>
                <div class="panel-body messages">
                  <? if($dashboardMessageSubjectList):?>
                  <ul class="messages-list" style="height:auto; width:100%;">
                    <? foreach($dashboardMessageSubjectList as $k=>$v):?>
                    <? $unreadMessageCount=get_object_by_query_count('message',"message_subject_id='".$v->message_subject_id."' and message_receiver_type='".$userType."' and message_receiver_id='".$userId."' and message_read_status=0");?>
                    <? $getUserInfo=getUserInfo($v->message_subject_sender_type,$v->message_subject_sender_id);?>
                    <li class="<?=($unreadMessageCount)?'messages-item active':'messages-item'?>"> <a href="<?=make_url('message-message','id='.$v->message_subject_id)?>">
                      <?=($unreadMessageCount)?'<span class="messages-item-star badge badge-danger " style="opacity:1;color:#FFFFFF;">'.$unreadMessageCount.'</span>':''?>
                      <img alt="" src="<?=($getUserInfo['image'])?createImazeSize(get_small($v->message_subject_sender_type),$getUserInfo['image'],40,40):"design/images/avatar-2.jpg"?>" class="messages-item-avatar"> <span class="messages-item-from">
                      <?=LimitText($getUserInfo['name'],12)?>
                      </span>
                      <div class="messages-item-time"> <span class="text">
                        <?=date('d M Y',strtotime($v->message_subject_ondate))?>
                        </span> </div>
                      <span class="messages-item-subject">
                      <?=$v->message_subject_sender_type?>
                      </span> <span class="messages-item-preview">
                      <?=$v->message_subject?>
                      . </span> </a> </li>
                    <? endforeach;?>
                  </ul>
                  <a class="view-more" href="<?=make_url('message-message');?>"> View All Messages <i class="clip-arrow-right-2"></i> </a>
                  <? else:?>
                  <h2>No Message.</h2>
                  <? endif;?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- end: PAGE CONTENT-->
    </div>
  </div>
  <!-- Footer Start-->
  <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
  <!-- Footer End-->
</div>
<!-- Main End -->
</body>
</html>
