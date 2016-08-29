<!DOCTYPE html>
<html>
<head>
<? include_once(DIR_FS_SITE_INCLUDE.'meta.php'); ?>
<title>School Gennie</title>
<? include_once(DIR_FS_SITE_INCLUDE.'css.php'); ?>
<? include_once(DIR_FS_SITE_INCLUDE.'javascript.php'); ?>
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
<link href="design/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="design/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
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
			$("#composeMessageForm").validate();
			});
		</script>
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="design/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
<script src="design/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script src="design/js/ui-modals.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
			jQuery(document).ready(function() {
				Index.init();
				UIModals.init();
			});
		</script>
<script>

<!--get faculty list-->
function getUserList(val)
{
   if(val && val=='students')
   {
    $("#classList").toggle();
	  $.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=message-ajax",
		data:"mode=getUserList&user_type=faculty&designation="+val,
		
		success: function(output)
		 {
		      $("#userList").html(output);
			
		}   
	});
   }
   else 
   { 
    $("#classList").hide();
  	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=message-ajax",
		data:"mode=getUserList&user_type=faculty&designation="+val,
		
		success: function(output)
		 {
		      $("#userList").html(output);
			
		}   
	});
	}
}
<!--get student list-->
function getStudentList(val)
{ 

 
  	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=message-ajax",
		data:"mode=getStudentList&user_type=student&class="+val,
		
		success: function(output)
		 {
		     $("#userList").html(output);
			
		}   
	});
	
}

function composeMessageToggle()
{
    $(".compose-msg").toggle();

}
function deleteMessagesubject(id)
{
  
  if(confirm("Are you sure? You want to  delete this subject...!"))
	{
	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=message-ajax",
		data:"mode=deleteMessagesubject&message_subject_id="+id,
		
		success: function(output)
		 { 
		   
			  location.reload();
			  
			   
			
		}   
	});
	}
}
<!--send Message-->
function sendMessage()
{

      var message=$("#message").val();
	  var message_subject_id=$("#message_subject_id").val();
	  var message_receiver_type=$("#message_receiver_type").val();
	  var message_receiver_id=$("#message_receiver_id").val();
	   if(message=="")
	   {
	   
	   $("div.alert").toggle();
	   $("div.alert").delay(2500).fadeOut();
	   return false;
	   }
	  
  	$.ajax({
	
		type: "POST",
		url: "<?=DIR_WS_SITE?>?page=message-ajax",
		data:"mode=sendMessage&message="+message+"&message_subject_id="+message_subject_id+"&message_receiver_type="+message_receiver_type+"&message_receiver_id="+message_receiver_id,
		
		success: function(output)
		 {
		      location.reload();
		}   
	});
}

<!--send Message end-->
</script>
</head>
<body>
<!-- Header Start-->
<? include_once(DIR_FS_SITE_INCLUDE.'header.php'); ?>
<!-- Header End-->
<!-- start: MAIN CONTAINER -->
<div class="main-container">
  <? include_once(DIR_FS_SITE_INCLUDE.$login_session->get_usertype().'Nav.php'); ?>
  <div class="main-content">
    <?php display_form_error();?>
    <div class="container">
      <!-- start: PAGE CONTENT -->
      <!-- start: Compose Message -->
      <div class="row">
        <div class="panel-body "> <a href="#compose" data-toggle="modal" class="btn btn-primary"><i class="fa  fa-edit "></i> &nbsp;Compose Message</a> </div>
      </div>
      <div id="compose" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h4 class="modal-title">Compose and Send New Message </h4>
        </div>
        <form name="composeMessageForm" id="composeMessageForm" action="<?=make_url('message-message')?>" method="post">
          <div class="modal-body">
            <? if($login_session->get_usertype()==$userTypeArray[2]):?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>New Message For <span class="symbol required"></span></label>
                  <select class="form-control" id="message_subject_receiver_type" name="message_subject_receiver_type" onChange="getUserList(this.value)" required>
                    <option value="">--Select Role--</option>
                    <? foreach($fcultyDesignationArray as $k=>$v):?>
                    <? if($v!='students'):?>
                    <option value="<?=$v?>">
                    <?=$v?>
                    </option>
                    <? endif;?>
                    <? endforeach;?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" id="userList">
                  <label>Name <span class="symbol required"></span></label>
                  <select class="form-control" required>
                    <option></option>
                  </select>
                </div>
              </div>
            </div>
            <? else:?>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>New Message For <span class="symbol required"></span></label>
                  <select class="form-control" id="message_subject_receiver_type" name="message_subject_receiver_type" onChange="getUserList(this.value)" required>
                    <option value="">--Select Role--</option>
                    <? foreach($fcultyDesignationArray as $k=>$v):?>
                    <option value="<?=$v?>">
                    <?=$v?>
                    </option>
                    <? endforeach;?>
                  </select>
                </div>
              </div>
              <div class="col-md-4" id="classList" style="display:none;">
                <div class="form-group">
                  <label>Class <span class="symbol required"></span></label>
                  <select class="form-control" id="class_id" name="class" onChange="getStudentList(this.value)" >
                    <option value="">--Select Class--</option>
                    <? foreach($classList as $k=>$v):?>
                    <option value="<?=$v->class_id?>">
                    <?=$v->class_name?>
                    </option>
                    <? endforeach;?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group" id="userList">
                  <label>Name <span class="symbol required"></span></label>
                  <select class="form-control" required>
                    <option></option>
                  </select>
                </div>
              </div>
            </div>
            <? endif;?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Subject <span class="symbol required"></span></label>
                  <input id="message_subject" name="message_subject"  class="form-control" type="text" placeholder="Subject" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Message <span class="symbol required"></span></label>
                  <textarea name="message"   class="form-control" placeholder="Message Content" required></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-light-grey"> Cancel </button>
            <button type="submit" name="submit" value="Send" class="btn btn-blue"> Send Message </button>
          </div>
        </form>
      </div>
      <!-- end: Compose Message -->
      <div class="row">
        <div class="col-md-12">
          <!-- start: INBOX PANEL -->
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="fa fa-envelope-o"></i> Inbox
              <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
            </div>
            <div class="panel-body messages">
              <div class="panel-scroll messages-list" style="margin:0;">
                <ul class="messages-list" style="width:250px;">
                  <? if($messageSubjectList):?>
                  <? foreach($messageSubjectList as $k=>$v):?>
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
                  <? endif;?>
                </ul>
              </div>
              <div class="messages-content">
                <div class="message-header">
                  <div class="message-time"> <i>
                    <?=date('d M Y, h:i A',strtotime($messageSubjectDeatil->message_subject_ondate))?>
                    </i>&nbsp; <a style="color:#666666; cursor:pointer;" title="Move to trash" onClick="deleteMessagesubject('<?=$messageSubjectDeatil->message_subject_id?>');"><i class="fa fa-trash-o"></i></a> </div>
                  <div class="message-from">
                    <? $getUserInfo=getUserInfo($messageSubjectDeatil->message_subject_receiver_type,$messageSubjectDeatil->message_subject_receiver_id);?>
                    <?=($messageSubjectDeatil->message_subject_receiver_id==$userId && $mesv->message_receiver_type==$userType)?'From':'To';?>
                    :
                    <?=$getUserInfo['name']?>
                  </div>
                  <div class="message-subject">
                    <?=$messageSubjectDeatil->message_subject?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="chat-form">
                      <form name="messageFrm" id="messageFrm" >
                        <? 
		 $message_receiver_type=($messageSubjectDeatil->message_subject_receiver_type==$userType && $messageSubjectDeatil->message_subject_receiver_id==$userId)?$messageSubjectDeatil->message_subject_sender_type:$messageSubjectDeatil->message_subject_receiver_type;
		 $message_receiver_id=($messageSubjectDeatil->message_subject_receiver_type==$userType && $messageSubjectDeatil->message_subject_receiver_id==$userId)?$messageSubjectDeatil->message_subject_sender_id:$messageSubjectDeatil->message_subject_receiver_id;
		 ?>
                        <div class="input-group">
                          <input type="text" id="message" name="message" class="form-control input-mask-date" placeholder="Type message for Reply ... ">
                          <input type="hidden" name="message_subject_id" id="message_subject_id" value="<?=$id?>">
                          <input type="hidden" name="message_receiver_type" id="message_receiver_type" value="<?=$message_receiver_type?>">
                          <input type="hidden" name="message_receiver_id" id="message_receiver_id" value="<?=$message_receiver_id?>">
                          <span class="input-group-btn">
                          <button class="btn btn-teal" type="button" onClick="sendMessage()"> <i class="fa fa-check"></i> </button>
                          </span> </div>
                        <div class="alert alert-danger" style="display:none">Please enter message</div>
                      </form>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="panel panel-default">
                      <div class="panel-body panel-scroll" style="height:360px">
                        <ol class="discussion">
                          <? if($messageList):?>
                          <? foreach($messageList as $mesk=>$mesv):?>
                          <? $getUserInfo=getUserInfo($mesv->message_sender_type,$mesv->message_sender_id);?>
                          <?
																if($mesv->message_receiver_id==$userId && $mesv->message_receiver_type==$userType && $mesv->message_read_status==0):
																  update_record_in_table('message',"message_id='".$mesv->message_id."'",array('message_read_status'=>1));
																endif;
																?>
                          <li class="<?=($mesv->message_sender_id==$userId && $mesv->message_sender_type==$userType)?'self':'other'?> ">
                            <div class="avatar"> <img alt="" src="<?=($getUserInfo['image'])?createImazeSize(get_small($mesv->message_sender_type),$getUserInfo['image'],40,40):"design/images/avatar-2.jpg"?>"> </div>
                            <div class="messages">
                              <p>
                                <?=html_entity_decode($mesv->message)?>
                              </p>
                              <span class="message-time">
                              <?=date('d M Y, h:i A',strtotime($mesv->message_ondate))?>
                              </span> </div>
                          </li>
                          <? endforeach;?>
                          <? endif;?>
                        </ol>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end: INBOX PANEL -->
        </div>
      </div>
      <!-- end: PAGE CONTENT-->
    </div>
  </div>
  <!-- Footer Start-->
  <? include_once(DIR_FS_SITE_INCLUDE.'footer.php'); ?>
  <!-- Footer End-->
</div>
</body>
</html>
