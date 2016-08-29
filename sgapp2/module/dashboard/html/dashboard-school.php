<!DOCTYPE html >
<html >
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link rel="stylesheet" href="design/plugins/fullcalendar/fullcalendar/fullcalendar.css">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/flot/jquery.flot.js"></script>
<script src="design/plugins/flot/jquery.flot.pie.js"></script>
<script src="design/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="design/plugins/jquery.sparkline/jquery.sparkline.js"></script>
<script src="design/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="design/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script src="design/plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
<script src="design/js/index.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
			jQuery(document).ready(function() {
				Index.init();
			});
		</script>
</head>
<body>
<!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<!-- start: MAIN CONTAINER -->
<div class="main-container">
  <!--Navigation Start -->
  <? include_once(DIR_FS_SITE_INCLUDE.'schoolNav.php'); ?>
  <!--Navigation End -->
  <div class="main-content">
    <?php display_form_error();?>
    <div class="container">
      <!-- start: PAGE HEADER -->
      <div class="row">
        <div class="col-sm-12">
          <div class="page-header">
            <h1>Dashboard<small> Administrator</small></h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->
      <!-- start: PAGE CONTENT -->
      <div class="row">
        <div class="col-sm-12"></div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="core-box">
            <div class="heading"> <i class="clip-settings circle-icon circle-green"></i>
              <h2>School Administration</h2>
            </div>
            <div class="content"> As an admin you have all priviledges on SchoolGennie resources and configurations. You have access to manage class, subject, student and faculty module. </div>
<?php /*?>            <a class="view-more" href="#"> View More <i class="clip-arrow-right-2"></i> </a> 
<?php */?>			</div>
        </div>
        <div class="col-sm-4">
          <div class="core-box">
            <div class="heading"> <i class="clip-user-block  circle-icon circle-teal"></i>
              <h2>Manage Roles</h2>
            </div>
            <div class="content"> For Role bases access, new Roles can be created and assigned access to required modules. Faculty can be assigned new roles with limited access to modules. </div>
           </div>
        </div>
        <div class="col-sm-4">
          <div class="core-box">
            <div class="heading"> <i class="clip-grid-2 circle-icon circle-bricky"></i>
              <h2>Features</h2>
            </div>
            <div class="content"> Admin has full access to features like Gallery, Notice Board, Message and Reports. Admin can create new photo albums, send notices and send message to anyone. </div>
            </div>
        </div>
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
      <div class="row">
        <div class="col-sm-7">
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-users-2"></i> Faculty List
              <div class="panel-tools"> <a class="btn btn-xs btn-link panel-close" href="#"> <i class="fa fa-times"></i> </a> </div>
            </div>
            <div class="panel-body panel-scroll" style="height:300px">
              <table class="table table-striped table-hover" id="sample-table-1">
                <thead>
                  <tr>
                    <th class="center">Photo</th>
                    <th>Full Name</th>
                    <th class="hidden-xs">Email</th>
                    <th>Phone</th>
                  </tr>
                </thead>
                <tbody>
                  <? if($dashboardFacultyList):?>
                  <? foreach($dashboardFacultyList as $facultyKey=>$facultyValue):?>
                  <tr>
                    <td class="center"><img src="<?=($facultyValue->faculty_image)?createImazeSize(get_small('faculty'),$facultyValue->faculty_image,50,50):'design/images/avatar-2.jpg'?>" alt="image"/> </td>
                    <td><?=$facultyValue->faculty_first_name.' '.$facultyValue->faculty_last_name?></td>
                    <td class="hidden-xs"><a href="<?=$facultyValue->faculty_email_official?>" rel="nofollow" target="_blank">
                      <?=$facultyValue->faculty_email_official?>
                      </a></td>
                    <td ><?=$facultyValue->faculty_mobile?>
                    </td>
                  </tr>
                  <? endforeach;?>
                  <? else:?>
                <h2>No Faculty.</h2>
                <? endif;?>
                </tbody>
                
              </table>
            </div>
          </div>
        </div>
        <div class="col-sm-5"> </div>
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
